<?php

class Controller {
	public $name;
	protected $view;
	public $view_data;
	protected $view_dir;
	protected $model;
	protected $post;

	public function __construct($occu) {
		$this->name = get_class($this);
		$this->occu = $occu;
		$this->view_data = new stdClass;
		if (isset($this->model)) {
			$this->{$this->model} = new $this->model();
		}
		if (!empty($_POST)) {
			$this->post = $_POST;
		}
		if (!empty($_GET)) {
			$this->get = $_GET;
		}
	}

	/**
	 * Renders the view to the screen. This shouldn't need to be overridden by sub-classes of Controller.
	 */
	public function render_view($view_name = NULL) {
		$this->view = $view_name;
		$this->view_dir = $this->occu->config['webroot'] . '/views/';
		$this->view_data->_view_path = $this->view;

		// Separate the view name into parts to determine the controller, view, and arguments, if any
		$view_parts = explode('/', $this->view);
		$controller_name = $view_parts[0] . 'Controller';
		$view_name = $view_parts[1];

		// Look to see if we have a controller and action
		if (class_exists($controller_name) && method_exists($controller_name, $view_name)) {
			$this->occu->controller = new $controller_name($this->occu);
			// Gets all arguments to the controller action into an array
			$view_func_args = array_slice($view_parts, 2);

			// The ... operator, introduced in PHP 5.6, puts all indexes of an array as arguments to a function.
			// So [$x, $y, $z] becomes func($x, $y, $z) instead of just being passed as an array
			$this->occu->controller->$view_name(...$view_func_args);

			// Load the view associated with the controller action
			$controller_view_dir = strtolower($view_parts[0]);
			$this->view = $this->view_dir . "{$controller_view_dir}/{$view_name}.php";
		} else {
			// If there isn't a controller function for that name, display a 404 page
			$this->view = $this->view_dir . $this->occu->config['not_found_view'];
		}

		// One piece of view data we'll always need is the title of the site
		$this->view_data->site_title = $this->occu->config['site_title'];
		
		// Render the global view. The individual view that should be displayed within it will be substituted by $this->view
		include($this->view_dir . $this->occu->config['global_layout'] . '.php.inc');
	}

	/**
	 * Sets view data, in case we don't want to use the -> operator in subclasses.
	 */
	public function set_view_data($key, $data) {
		$this->view_data->$key = $data;
	}
}