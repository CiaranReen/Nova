<?php

/**
 * Main database configuration details
 */

$database['development'] = array (
    'type' => 'mysql',
    'host' => 'localhost',
    'name' => 'playground',
    'user' => 'root',
    'pass' => '',
);

$database['production'] = array (
    'type' => 'mysql',
    'host' => 'codedab.com.mysql',
    'name' => 'codedab_com',
    'user' => 'codedab_com',
    'pass' => 'bW6ivbGE',
);

return $database;