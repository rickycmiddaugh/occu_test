<?php

class OccuTest {
   /**
    * Automatically runs when an instance of the class is created.
	*/
	function __construct() {
		// Sets the installation directory, relative to the HTTP_ROOT, of the application.
		// This is useful for loading all required PHP classes and configuration files.
		$install_dir = implode('/', array_slice(explode('/', $_SERVER['PHP_SELF']), 1, -1));
		// The three files we need loaded right away are the base config, as well as the global Model and Controller classes.
		require_once($_SERVER['DOCUMENT_ROOT'] . "/{$install_dir}/config/occu.config.inc");
		require_once($_SERVER['DOCUMENT_ROOT'] . "/{$install_dir}/models/_global.php");
		require_once($_SERVER['DOCUMENT_ROOT'] . "/{$install_dir}/controllers/_global.php");
		
		// Load all other PHP files necessary to run the application.
		$classesDir = array (
			'occu/models',
			'occu/controllers',
		);
		foreach ($classesDir as $directory) {
			foreach (glob($_SERVER['DOCUMENT_ROOT'] . '/' . $directory . "/[!_]*.php") as $filename) {
				include $filename;
			}
		}

		// Set the config variable so the rest of the application can get to it
		global $OCCU_CONFIG;
		$this->config = $OCCU_CONFIG;
		$this->config['webroot'] = $_SERVER['DOCUMENT_ROOT'] . '/' . $install_dir;
	}

   /**
	* Runs the application itself.
	*/
	function occu_run() {
		// Start an output buffer. This prevents any ouput to the screen until we're ready.
		ob_start();

		// Set a default page to load (The homepage of the application). If we have another page to load,
		// as defined by the 'v' argument, try to load that instead.
		$view_name = $this->config['homepage'];
		if (isset($_REQUEST['v'])) {
			$view_name = $_REQUEST['v'];
		}
		$this->controller = new Controller($this);
		$this->controller->render_view($view_name);

		// Now that execution of our view is complete, print our output buffer to the screen
		print ob_get_clean();
	}
}

$occu = new OccuTest();
$occu->occu_run();
?>