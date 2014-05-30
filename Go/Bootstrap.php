<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 11:54
 */

class Bootstrap {

    function __construct()
    {
        define('URL', 'http://playground.dev');
        session_start();

        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/');
        $url = explode('/', $url);

        if (empty($url[0]))
        {
            require 'controllers/IndexController.php';
            $controller = new IndexController();
            $controller->indexAction();
            return false;
        }

        $file = 'controllers/' . ucfirst($url[0]) . 'Controller.php';

        if (file_exists($file))
        {
            require $file;
        }
        else
        {
            echo 'The file ' . $file . ' was not found.';
        }

        $object = ucfirst($url[0]) . 'Controller';
        $controller = new $object;

        /**
         * Set the way methods are called. From a design perspective, methods are called after the controller in the URL,
         * followed by any parameters
         * For example, http://gophp.co.uk/{CONTROLLER}/{METHOD}/{PARAMETER}/
         */
        if (isset($url[1]))
        {
            $method = $url[1] . 'Action';

            if (method_exists($controller, $method))
            {
                $controller->$method();
            }
            else
            {

            }
        }
        else if (isset($url[2]))
        {
            if (method_exists($controller, $url[2]))
            {
                $controller->$url[1]($url[2]);
            }
            else
            {

            }
        }
        else
        {
            $controller->indexAction();
        }
    }
}
