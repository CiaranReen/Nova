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
            require 'controllers/default/IndexController.php';
            $controller = new IndexController();
            $controller->indexAction();
            return false;
        }

        /**
         * Set the way methods are called. From a design perspective, methods are called after the controller in the URL,
         * followed by any parameters
         * For example, http://gophp.co.uk/{CONTROLLER}/{METHOD}/{PARAMETER}/
         */
        if ($url[0] !== 'admin')
        {
            $file = 'controllers/default/' . ucfirst($url[0]) . 'Controller.php';

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
        else
        {
            if (isset($url[1]))
            {
                $file = 'controllers/admin/' . ucfirst($url[1]) . 'Controller.php';

                if (file_exists($file))
                {
                    require $file;
                }
                else
                {
                    echo 'The file ' . $file . ' was not found.';
                }

                $object = ucfirst($url[1]) . 'Controller';
                $controller = new $object;
            }
            else
            {
                $file = 'controllers/admin/' . ucfirst($url[0]) . 'Controller.php';

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
            }

            if (isset($url[2]))
            {
                $method = $url[2] . 'Action';

                if (method_exists($controller, $method))
                {
                    $controller->$method();
                }
                else
                {

                }
            }
            else if (isset($url[3]))
            {
                if (method_exists($controller, $url[3]))
                {
                    $controller->$url[2]($url[3]);
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
}