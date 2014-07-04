<?php

/**
 * Main config of the app
 */
$config = array ();

//Set the debugging to true or false
$config['debug'] = false;

//Locale
$config['language'] = 'English';
$config['charset'] = 'UTF-8';

//Session and cookie settings
$config['session_expiration'] = 0;
$config['session_cookie_httponly'] = 1;
$config['use_only_cookies'] = 1;
$config['cookie_secure'] = 1;

//Default path variables
$config['dir']['root'] = dirname(dirname(__DIR__));
$config['dir']['app'] = 'app/';
$config['dir']['models'] = $config['dir']['app'].'models/';
$config['dir']['controllers'] = $config['dir']['app'].'controllers/default/';
$config['dir']['views'] = $config['dir']['app'].'views/';
$config['dir']['forms'] = $config['dir']['app'].'forms/';
$config['dir']['layout'] = $config['dir']['app'].'layout/';

//Admin paths
$config['url']['admin'] = '/admin/';
$config['dir']['admin']['controllers'] = $config['dir']['app'].'controllers/admin/';
$config['dir']['admin']['views'] = $config['dir']['app'].'views/admin/';