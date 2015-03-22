<?php

/**
 * Logging class
 *
 *
 * @copyright  2015 Nova Framework
 * @license    http://www.novaframework.com/license/3_0.txt   PHP License 3.0
 * @version    Release: @package_version@
 * @link       http://novaframework.com/package/PackageName
 * @since      Class available since Release 0.0.1
 */

class Auth_Logging implements SplObserver {

    function update( SplSubject $SplSubject ) {

        $status = $SplSubject->getStatus();

        switch ( $status[0] ) {

            case Auth::INCORRECT_PWD:
                echo __CLASS__ . ": Logging incorrect password attempt to error file.";
                break;

            case Auth::UNKNOWN_USER:
                echo __CLASS__ . ": Logging unknown user attempt to error file.";
                break;

            case Auth::ALREADY_LOGGED_IN:
                echo __CLASS__ . ": Logging already logged in to error file.";
                break;

            case Auth::ALLOW:
                echo __CLASS__ . ": Logging to access file.";

        }

    }

}