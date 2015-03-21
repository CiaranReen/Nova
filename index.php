<?php

/**
 * Nova Framework - Open source framework written in PHP for the web
 *
 * Main entry point of the app. Set up core functionality then pass off to Front Controller
 *
 * @copyright  2014 Nova Framework
 * @license    http://www.novaframework.com/license/3_0.txt   PHP License 3.0
 * @version    Release: @package_version@
 * @link       http://novaframework.com/package/PackageName
 * @since      Class available since Release 0.0.1
 */

/*
 * ------------------------------------------------------
 *  Set Error Reporting level
 * ------------------------------------------------------
 */
error_reporting(E_ALL);


/*
 * ------------------------------------------------------
 *  Call the loader to load all classes
 * ------------------------------------------------------
 */

require 'lib/Nova/Loader.php';

/*
 * ------------------------------------------------------
 *  Run the app!
 * ------------------------------------------------------
 */
$app = new Nova();
$app->run($routes->getRoutes());