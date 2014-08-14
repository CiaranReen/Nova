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
    'name' => 'a1584847_playgro',
    'user' => 'a1584847_playgro',
    'pass' => 'playground1',
);

return $database;