<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 12:15
 */

class Views_Base
{

    public function __construct() {}

    //Build the view from the given url
    public function render($name)
    {
        require_once 'app/views/layout/header.phtml';
        require_once 'app/views/' . $name . '.phtml';
        require_once 'app/views/layout/footer.phtml';
    }
}