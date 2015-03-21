<?php

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
    define('URL', 'http://codedab.com');
}

define('APP_PATH', 'app/');