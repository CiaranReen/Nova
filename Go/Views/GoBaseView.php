<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 12:15
 */

class GoBaseView {

    function __construct() {}

    //Build the view from the given url
    public function render($name)
    {
        $domain = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        if (strpos($domain, 'admin'))
        {
            require 'layout/admin/header.phtml';
            require 'views/admin/' . $name . '.phtml';
            require 'layout/admin/footer.phtml';
        }
        else
        {
            require 'layout/default/header.phtml';
            require 'views/' . $name . '.phtml';
            require 'layout/default/footer.phtml';
        }

    }
}