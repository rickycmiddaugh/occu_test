<?php

/**
 * @file occu.config.inc
 *
 * This file should include configuration variables that are global for the whole application. These are necessary for the application to run.
 */

global $OCCU_CONFIG;
$OCCU_CONFIG = array();
 
/**
 * homepage: Sets the default page to load for the application.
 * This should be in the format of a controller and view, such as:
 *
 * $OCCU_CONFIG['homepage'] = 'mycontroller/index';
 */
$OCCU_CONFIG['homepage'] = 'client/index';
 
/**
 * site_title: Sets the title for the application, displayed as an <h1> tag.
 *
 * $OCCU_CONFIG['site_title'] = 'My Fancy Application';
 */
$OCCU_CONFIG['site_title'] = 'OCCU Test Application';

/**
 * global_view: Sets the view that is the global layout that all views start from.
 * This should be a relative path starting from within the /views directory. The file
 * should be a .php.inc file, but the config variable should not include the extension.
 *
 * $OCCU_CONFIG['global_layout'] = 'global/layout'; // Looks for /views/global/layout.php.inc
 */
$OCCU_CONFIG['global_layout'] = 'global/layout';

/**
 * not_found_view: Sets the view to load when a 404 error occurs.
 * This should be a relative path starting from within the /views directory.
 *
 * $OCCU_CONFIG['not_found_view'] = 'global/page_not_found.php';
 */
$OCCU_CONFIG['not_found_view'] = 'global/page_not_found.php';

/**
 * db_dir: For this exercise, we're using JSON files as a database.
 * This sets the directory that we're saving the database tables to.
 *
 * $OCCU_CONFIG['db_dir'] = 'database_tables';
 */
$OCCU_CONFIG['db_dir'] = 'db';