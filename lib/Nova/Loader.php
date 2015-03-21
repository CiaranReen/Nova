<?php

/**
 * Load all the classes for the framework
 *
 *
 * @copyright  2014 Nova Framework
 * @license    http://www.novaframework.com/license/3_0.txt   PHP License 3.0
 * @version    Release: @package_version@
 * @link       http://novaframework.com/package/PackageName
 * @since      Class available since Release 0.0.1
 */


/*
 * ------------------------------------------------------
 *  Autoload all the framework classes
 * ------------------------------------------------------
 */

function __autoload($class_name) {
    $filename = str_replace('_', DIRECTORY_SEPARATOR, strtolower($class_name)).'.php';

    $file = 'lib/Nova/'.$filename;

    if(file_exists($file)) {
        require_once($file);
    } else {
        throw new Exception("Unable to load $class_name.");
    }
}

/*
 * ------------------------------------------------------
 *  Set up custom routing
 * ------------------------------------------------------
 */

$routes = new Routes();
require '/app/config/routes.php';
require '/app/config/constants.php';
