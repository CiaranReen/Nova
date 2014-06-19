<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 18/06/14
 * Time: 14:03
 */

/**
 * Critical functions to run the app
 * Class Nova
 */
class Nova
{

// ------------------------------------------------------------------------

    /**
     * Returns the main config.php file for the app
     *
     * Custom config files can be loaded by being passed as a param
     *
     * @param       var
     * @return      mixed
     */
    function getConfig($customConfig = null)
    {
        static $config;

        //Load the default config file
        if (!isset($config))
        {
            $configFile = APP_PATH . 'config/config.php';

            if (file_exists($configFile))
            {
                //Config file is present
                require $configFile;
            }
            else
            {
                $configFile = APP_PATH . 'config/' . $customConfig;

                if (file_exists($configFile))
                {
                    //Config file is present
                    require $configFile;
                }
                //No config file is present
                else
                {
                    die('No config file is present in your config directory.');
                }
            }

            if (empty($config))
            {
                //The loaded config file has nothing in it!
                die('The loaded config file is empty in your config directory.');
            }

            return $config;
        }
    }

// ------------------------------------------------------------------------


    /**
     *
     * Set the way methods are called. From a design perspective, methods are called after the controller in the URL,
     * followed by any parameters
     * For example, http://novaframework.co.uk/{CONTROLLER}/{METHOD}/{PARAMETER}/
     *
     * @return      bool
     */
    function parseUrl()
    {
        $loadedConfig = $this->getConfig();

        $url = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $url = rtrim($url, '/');
        $url = explode('/', $url);

        /*
         * ------------------------------------------
         * Root URL - Get the IndexController
         * ------------------------------------------
         */
        if ($url[0] == $_SERVER['HTTP_HOST'] && !isset($url[1]))
        {
            $indexController = $loadedConfig['dir']['controllers'].'/IndexController.php';
            if (file_exists($indexController))
            {
                require $indexController;
                $controller = new IndexController();
                $controller->indexAction();
                exit();
            }
        }

        /*
         * --------------------------------------------------------
         * First URL node called - Load the corresponding Controller
         * --------------------------------------------------------
         */
        if ($url[1] !== 'admin')
        {
            $requestedController = $loadedConfig['dir']['controllers'] . ucfirst($url[1]) . 'Controller.php';

            //Does the controller exist?
            if (file_exists($requestedController))
            {
                require $requestedController;
            }

            $object = ucfirst($url[1]) . 'Controller';
            $controller = new $object;

            //Call the requested method. If no method is found call the Index method.
            if (isset($url[2]))
            {
                $method = $url[2] . 'Action';

                if (method_exists($controller, $method))
                {
                    $controller->$method();
                }
            }
            else
            {
                $controller->indexAction();
            }
        }
        /*
         * --------------------------------------------------------
         * Admin area - Load the requested admin controller
         * --------------------------------------------------------
         */
        elseif (isset($url[1]) && !isset($url[2]))
        {
            $adminController = $loadedConfig['dir']['admin']['controllers'] . ucfirst($url[1]) . 'Controller.php';

            if (file_exists($adminController))
            {
                require $adminController;
            }

            $object = ucfirst($url[1]) . 'Controller';
            $controller = new $object;
        }
        else
        {
            $file = $loadedConfig['dir']['admin']['controllers'] . ucfirst($url[2]) . 'Controller.php';

            if (file_exists($file))
            {
                require $file;
            }

            $object = ucfirst($url[2]) . 'Controller';
            $controller = new $object;
        }

        if (isset($url[3]))
        {
            $method = $url[3] . 'Action';

            if (method_exists($controller, $method))
            {
                $controller->$method();
            }
        }
        else
        {
            $controller->indexAction();
        }
    }
}