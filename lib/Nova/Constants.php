<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 18/06/14
 * Time: 14:03
 */


/*
| -------------------------------------------------------------------------
| App-wide constants
| -------------------------------------------------------------------------
| Set your app-wide constants here. Commonly used ones are already defined.
|
|
*/

if ($_SERVER['HTTP_HOST'] == 'playground.dev')
{
    define('URL', 'http://playground.dev');
}
else
{
    define('URL', 'http://playgrounddev.netau.net');
}

define('APP_PATH', 'app/');