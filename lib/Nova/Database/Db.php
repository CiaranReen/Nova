<?php

/**
 * Class Db
 */
class Db {

    /**
     * Connect to the database
     */
    public function connect()
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

            try
            {
                $DBH = new PDO (''.$database['production']['type'].':host='. $database['production']['host'] .';dbname='.
                    $database['production']['name'].'', ''.$database['production']['user'].'', $database['production']['pass'], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                return $DBH;
            }
            catch (PDOException $ex){
                die(json_encode(array(
                    'outcome' => false,
                    'message' => 'Unable to connect'
                )));
            }
        }
    }
}