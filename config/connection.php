<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 28/05/14
 * Time: 12:10
 */

/**
 * Set your database connection details here
 */

if ($_SERVER['HTTP_HOST'] == 'playground.dev')
{
    define('DB_TYPE', 'mysql');
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'playground');
    define('DB_USER', 'root');
    define('DB_PASS', '');
}
else
{
    define('DB_TYPE', 'mysql');
    define('DB_HOST', 'mysql7.000webhost.com');
    define('DB_NAME', 'a1584847_play');
    define('DB_USER', 'a1584847_play');
    define('DB_PASS', 'playground1');
}
