<?php

class ClientController extends Controller {
	protected $model = 'Client';

	/**
	 * Displays all clients, and allows for searching of clients.
	 */
	function index() {
		$clients = $this->Client->load();
		$search_field = '';
		$search_value = '';

		if (isset($this->get) && count($this->get) > 1) {
			$search_field = $this->get['search_name'];
			$search_value = $this->get['search_value'];
			if (!empty($search_field) && !empty($search_value)) {
				foreach ($clients as $index => $client) {
					if (stristr($client->$search_field, $search_value) === FALSE) {
						unset($clients->$index);
					}
				}
			}
		}

		$this->view_data->clients = $clients;
		$this->view_data->search_field = $search_field;
		$this->view_data->search_value = $search_value;
	}

	/**
	 * Commpares two clients together.
	 */
	function compare() {
		$clients = array();
		if (empty($this->post)) {
			$protocol = $_SERVER['REQUEST_SCHEME'];
			$host = $_SERVER['HTTP_HOST'];
			$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
			header("Location: {$protocol}://{$host}/{$uri}/index.php?v=client/index");
		}
		if (count($this->post['CompareClients']) == 2) {
			$client_names = $this->post['CompareClients'];
			$clients = $this->Client->load('name', $client_names);
		}

		$this->view_data->clients = $clients;
	}

	/**
	 * Creates a new client. The $id variable allows us to duplicate an already existing client,
	 * starting the create form with the values from it.
	 */
	function create($name = NULL) {
		if (!empty($this->post)) {
			$name = $this->post['name'];
			$address = $this->post['address'];
			$phone = $this->post['phone'];
			$email = $this->post['email'];
			$updated = time();
			$success = $this->Client->save(array(
				'name' => $name,
				'address' => $address,
				'phone' => $phone,
				'email' => $email,
				'updated' => $updated
			), TRUE);
			if ($success) {
				$this->view_data->success = TRUE;
			} else {
				$this->view_data->validation_errors = array('name');
			}
		}
		if (!empty($name)) {
			$this->view_data->client = $this->Client->load('name', $name);
		}
	}

	/**
	 * Edits a client that is already in our system.
	 */
	function edit($name) {
		if (!empty($this->post)) {
			$name = $this->post['name'];
			$address = $this->post['address'];
			$phone = $this->post['phone'];
			$email = $this->post['email'];
			$updated = time();
			$success = $this->Client->save(array(
				'name' => $name,
				'address' => $address,
				'phone' => $phone,
				'email' => $email,
				'updated' => $updated
			), FALSE);
			if ($success) {
				$this->view_data->success = TRUE;
			} else {
				$this->view_data->validation_errors = array('name');
			}
		}
		$this->view_data->client = $this->Client->load('name', $name);
	}

	/**
	 * Delete a client from our system.
	 */
	function delete($name) {
		if (!empty($this->post)) {
			$protocol = $_SERVER['REQUEST_SCHEME'];
			$host = $_SERVER['HTTP_HOST'];
			$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
			$this->Client->delete('name', $name);
			header("Location: {$protocol}://{$host}/{$uri}/index.php?v=client/index");
		}
		$this->view_data->client = $this->Client->load('name', $name);
	}

}