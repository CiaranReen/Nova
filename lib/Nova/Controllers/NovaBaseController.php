<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 12:06
 * This is the parent controller for the Nova framework */

abstract class NovaBaseController {

    /**
     * @var
     */
    protected $_request;


    /**
     * Constructor method to link the requested controller to the corresponding model.
     * By design, each model should have the same name as the controller but without anything appended
     * For example, IndexController will be linked to the model Index
     */
    public function __construct()
    {
        $this->view = new NovaBaseView();

        $class = get_class($this);
        $class = explode('Controller', $class);
        $file = 'app/models/'.$class[0].'/'.$class[0].'.php';

        if (file_exists($file))
        {
            require $file;
        }
    }

    /**
     * Get the param from a URL
     * Wherever the method is, the param will be next, so we increment the key by 1
     * The reason this does not just get the last element in the array is because there can be multiple params
     * For example http://nova.co.uk/faq/view/{PARAM}/id/{PARAM}
     * @param $method
     * @return $param
     */
    public function getParam($method)
    {
        $domain = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $url = explode('/', $domain);
        $searchedArray = array_search($method, $url);
        $paramKey = $searchedArray + 1;
        $param = $url[$paramKey];

        return $param;
    }

    /**
     * Get the request value and return
     * @param $value
     * @return bool
     */
    public function getRequest($value)
    {
        if ($this->isPost() === true)
        {
            if (isset($_POST[$value]))
            {
                $this->_request = $_POST[$value];
                return $this->_request;
            }
        }
        else if ($this->isGet() === true)
        {
            if (isset($_GET[$value]))
            {
                $this->_request = $_GET[$value];
                return $this->_request;
            }
        }

        return false;
    }

    /**
     * Redirect the user to a given URL
     * @param $url
     */
    public function goToUrl($url)
    {
        header('location: ' . $url);
    }

    /**
     * Test the request for a post value
     * @return bool
     */
    public function isPost()
    {
        if (!empty($_POST))
        {
            return true;
        }

        return false;
    }

    /**
     * Test the request for a get value
     * @return bool
     */
    public function isGet()
    {
        if (!empty($_GET))
        {
            return true;
        }

        return false;
    }

    /**
     * Return the current host address
     * @return mixed
     */
    public function getHost()
    {
        return $_SERVER['HTTP_HOST'];
    }

    /**
     * Get the HTTP response code
     * @param int $statusCode
     * @return int
     */
    public function getStatusCode($statusCode = 200)
    {
        return $statusCode;
    }
}