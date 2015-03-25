<?php

/**
 * Overwrite default routes with custom ones
 * This file interlinks with routes.php where the user defines custom routes
 *
 *
 * @author      Ciaran Reen
 * @copyright   2014 Nova Framework
 * @license     http://www.novaframework.com/license/3_0.txt   PHP License 3.0
 * @version     Release: @package_version@
 * @link        http://novaframework.com/package/PackageName
 * @since       Class available since Release 0.0.1
 */

class Routes
{
    public $routes = array();

    /**
     * @param array $routes
     * @return $this
     */
    public function setRoutes($routes)
    {
        $this->routes = $routes;
        return $this;
    }

    /**
     * @return array
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * Sets the requested custom route
     * @param $url
     * @param $controller
     */
    public function set($url, $controller)
    {
        global $error;
        $fullUrl = "$_SERVER[REQUEST_URI]";

        //Trim the trailing slash off
        $fullUrl = rtrim($fullUrl, '/');
        $url = rtrim($url, '/');

        if ($fullUrl == $url)
        {
            $requestedController = $controller . '.php';

            if (file_exists($requestedController))
            {
                $this->setRoutes($requestedController);
            }
            else
            {
                $error->display_error('The requested controller could not be found. Check your routes.php file and make sure the controller name entered exists.');
            }

        }
    }
}