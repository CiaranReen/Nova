<?php

$config = array(

    /*
	|--------------------------------------------------------------------------
	| Application Debug Mode
	|--------------------------------------------------------------------------
	|
	| Set whether debugging should be turned on or off.
	|
	*/
    'debug' => false,

    /*
	|--------------------------------------------------------------------------
	| Cookie settings
	|--------------------------------------------------------------------------
	|
	| Set app-wide cookie settings
	|
	*/

    'session_expiration' => 0,
    'session_cookie_httponly' => true,
    'use_only_cookies' => true,
    'cookie_secure' => true,

    /*
	|--------------------------------------------------------------------------
	| Application Path Settings
	|--------------------------------------------------------------------------
	|
	| Default path settings are shown. If you need custom paths for your app
    | override the ones here
	|
	*/
    'root' => dirname(dirname(__DIR__)),
    'app' => 'app/',
    'models' => 'app/models/',
    'controllers' => 'app/controllers/',
    'views' => 'app/views/',
    'forms' => 'app/forms/',
    'layout' => 'app/views/layout/'

);

return $config;