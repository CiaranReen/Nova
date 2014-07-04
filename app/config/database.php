<?php

/**
 * Main database configuration details
 */

$database['default'] = array (
    'type' => 'mysql',
    'host' => 'localhost',
    'name' => 'playground',
    'user' => 'root',
    'pass' => '',
);

$database['production'] = array (
    'type' => 'mysql',
    'host' => 'mysql7.000webhost.com',
    'name' => 'a1584847_play',
    'user' => 'a1584847_play',
    'pass' => 'playground1',
);

return $database;