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
        session_start();

        $Nova = new Nova();
        $Nova->parseUrl();
    }


}