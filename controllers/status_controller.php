<?php

class StatusController extends Controller {
	protected $model = 'Status';

	/**
	 * Displays all statuses.
	 */
	function index() {
		$this->view_data->statuses = $this->Status->load();
	}
}