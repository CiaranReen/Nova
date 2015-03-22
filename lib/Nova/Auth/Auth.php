<?php

/**
 * Authentication class
 *
 *
 * @copyright  2015 Nova Framework
 * @license    http://www.novaframework.com/license/3_0.txt   PHP License 3.0
 * @version    Release: @package_version@
 * @link       http://novaframework.com/package/PackageName
 * @since      Class available since Release 0.0.1
 */

class Auth_Auth implements SplSubject {

    const UNKNOWN_USER = 1;
    const INCORRECT_PWD = 2;
    const ALREADY_LOGGED_IN = 3;
    const ALLOW = 4;

    private $status = array();
    private $storage;

    public function __construct() {
        $this->storage = new SplObjectStorage();
    }

    public function login( $username, $password, $ip ) {

        // Let's simulate different login procedures
        $this->setStatus( rand( 1, 4 ), $username, $ip);

        // Notify all the observers of a change
        $this->notify();

        if ( $this->status[0] == self::ALLOW ) {
            return true;
        }

        return false;

    }

    private function setStatus( $status, $username, $ip ) {
        $this->status = array( $status, $username, $ip );
    }

    public function getStatus() {
        return $this->status;
    }

    public function attach( SplObserver $observer ) {
        $this->storage->attach( $observer );
    }

    public function detach( SplObserver $observer ) {
        $this->storage->detach( $observer );
    }

    public function notify() {

        foreach ( $this->storage as $observer ) {
            $observer->update( $this );
        }

    }
}