<?php
/**
 * Critical low-level functions to run the app
 *
 * Front Controller for the app. Handle incoming requests, set up sessions and and get the config file for app-wide use
 *
 * @copyright  2014 Nova Framework
 * @license    http://www.novaframework.com/license/3_0.txt   PHP License 3.0
 * @version    Release: @package_version@
 * @link       http://novaframework.com/package/PackageName
 * @since      Class available since Release 0.0.1
 */

class Nova
{

    // ------------------------------------------------------------------------

    /**
     *
     * Run the app
     *
     * This essentially sets the way Controllers and methods are linked to the called URL.
     * From a design perspective, methods are called after the controller in the URL,
     * followed by any parameters
     * For example, http://novaframework.co.uk/{CONTROLLER}/{METHOD}/{PARAMETER}/ etc
     *
     * @param       $route
     * @return      bool
     */
    public function run($route)
    {
        //Start the session
        session_start();

        //Get the config
        $loadedConfig = $this->getConfig();

        $url = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $url = rtrim($url, '/');
        $url = explode('/', $url);

        /*
         * --------------------------------------------------
         * Custom routes, if any, called here
         * --------------------------------------------------
         */
        if ($route != null)
        {
            $controller = explode('/', $route);
            $controller = end($controller);
            $controller = explode('.', $controller);
            $controller = reset($controller);
            if (file_exists($route))
            {
                require $route;
                $controller = new $controller();
                $controller->indexAction();
                exit();
            }
        }

        /*
         * ------------------------------------------
         * Root URL - Get the IndexController
         * ------------------------------------------
         */
        if ($url[0] == $_SERVER['HTTP_HOST'] && !isset($url[1]))
        {
            $indexController = $loadedConfig['controllers'].'/IndexController.php';
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
            //Satisfy GET requests
            if (strpos($url[1], '?') == true)
            {
                $requestedController = $loadedConfig['controllers'] . ucfirst($url[0]) . 'Controller.php';

                //Does the controller exist?
                if (file_exists($requestedController))
                {
                    require $requestedController;
                }

                $object = ucfirst($url[0]) . 'Controller';
                $controller = new $object;
            }
            else
            {
                $requestedController = $loadedConfig['controllers'] . ucfirst($url[1]) . 'Controller.php';

                //Does the controller exist?
                if (file_exists($requestedController))
                {
                    require $requestedController;
                }

                $object = ucfirst($url[1]) . 'Controller';
                $controller = new $object;
            }

            //Call the requested method. If no method is found call the Index method.
            if (isset($url[2]))
            {
                if (strpos($url[2], '?') == true)
                {
                    $method = $url[0] . 'Action';

                    if (method_exists($controller, $method))
                    {
                        $controller->$method();
                    }
                }
                else
                {
                    $method = $url[2] . 'Action';

                    if (method_exists($controller, $method))
                    {
                        $controller->$method();
                    }
                }

            }
            else
            {
                $controller->indexAction();
            }
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

// ------------------------------------------------------------------------

    /**
     * Returns the main config.php file for the app
     *
     * Custom config files can be loaded by being passed as a param
     *
     * @param       var
     * @return      mixed
     */
    protected function getConfig($customConfig = null)
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
}