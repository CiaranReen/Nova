<?php

/**
 * Class Db
 */
class Db extends PDO {

    /**
     * Connect to the database
     */
    public function __construct()
    {
        //Does the db connection file exist?
        $databasePath = 'app/config/database.php';
        if (! file_exists($databasePath))
        {
            die('The database file does not exist.');
        }
        else
        {
            include($databasePath);

            if (!is_array($database))
            {
                die('The database file needs to be an array. See the documentation for more information.');
            }
            elseif (count($database) == 0)
            {
                die('No database configuration details were found in the config file.');
            }

            parent::__construct(''.$database['default']['type'].':host='. $database['default']['host'] .';dbname='.
                $database['default']['name'].'', ''.$database['default']['user'].'', $database['default']['pass']);
        }
    }
}