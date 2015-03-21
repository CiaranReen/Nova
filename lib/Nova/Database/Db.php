<?php

/**
 * Class Db
 */
class Database_Db {

    private static $instance;
    private $pdoConnection;

    /**
     * Connect to the database
     */
    private function __construct() {
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
                $this->pdoConnection = new PDO (''.$database['development']['type'].':host='. $database['development']['host'] .';dbname='.
                    $database['development']['name'].'', ''.$database['development']['user'].'', $database['development']['pass'], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                //return $this->pdoConnection;
            }
            catch (PDOException $ex){
                die(json_encode(array(
                    'outcome' => false,
                    'message' => 'Unable to connect'
                )));
            }
        }
    }

    public function getDb() {
        if ($this->pdoConnection instanceof PDO) {
            return $this->pdoConnection;
        }
    }

    /**
     * @return mixed
     */
    public static function getInstance(){
        if (self::$instance == null){
            $className = __CLASS__;
            self::$instance = new $className;
        }

        return self::$instance;
    }

    /**
     * To ensure only 1 instance of object exists, disable cloning and wakeup
     */
    public function __clone()
    {
        return false;
    }

    public function __wakeup()
    {
        return false;
    }

}