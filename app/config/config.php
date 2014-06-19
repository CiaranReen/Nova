<?php

/**
 * Main config of the app
 */
$config = array ();

//Base URL of the site eg. http://www.example.com
if ($_SERVER['HTTP_HOST'] == 'playground.dev')
{
    define('URL', 'http://playground.dev');
}
else
{
    define('URL', 'http://playgrounddev.netau.net');
}

//Set the debugging to true or false
$config['debug'] = false;

//Locale
$config['language'] = 'English';
$config['charset'] = 'UTF-8';

//Session lifetime length
$config['session_expiration'] = 2800;

//Default path variables
$config['dir']['root'] = dirname(dirname(__DIR__));
$config['dir']['app'] = 'app/';
$config['dir']['models'] = $config['dir']['app'].'models/';
$config['dir']['controllers'] = $config['dir']['app'].'controllers/default/';
$config['dir']['views'] = $config['dir']['app'].'views/';
$config['dir']['forms'] = $config['dir']['app'].'forms/';
$config['dir']['layout'] = $config['dir']['app'].'layout/';

//Admin paths
$config['dir']['admin']['controllers'] = $config['dir']['app'].'controllers/admin/';
$config['dir']['admin']['views'] = $config['dir']['app'].'views/admin/';