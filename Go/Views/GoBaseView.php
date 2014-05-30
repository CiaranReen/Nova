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
        require 'views/header.phtml';
        require 'views/' . $name . '.phtml';
        require 'views/footer.phtml';
    }
}