<?php

/**
 * Class GoDatabase
 * Connection to the database through the PDO abstraction layer. Constants are set in /config/connection.php
 */
class GoDatabase extends PDO {

    public function __construct()
    {
        parent::__construct(''.DB_TYPE.':host='. DB_HOST .';dbname='.DB_NAME.'', ''.DB_USER.'', DB_PASS);
    }
}