<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 12:15
 */

class NovaBaseView {

    function __construct() {}

    //Build the view from the given url
    public function render($name)
    {
        $domain = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        if (strpos($domain, 'admin'))
        {
            require 'app/layout/admin/header.phtml';
            require 'app/views/admin/' . $name . '.phtml';
            require 'app/layout/admin/footer.phtml';
        }
        else
        {
            require 'app/layout/default/header.phtml';
            require 'app/views/' . $name . '.phtml';
            require 'app/layout/default/footer.phtml';
        }

    }
}