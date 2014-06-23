<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 18/06/14
 * Time: 14:03
 */

//Base URL of the site eg. http://www.example.com
if ($_SERVER['HTTP_HOST'] == 'playground.dev')
{
    define('URL', 'http://playground.dev');
}
else
{
    define('URL', 'http://playgrounddev.netau.net');
}

define('APP_PATH', 'app/');