<?php

/**
 * Class NovaSession
 */

class Session_Base {

    /**
     * Store an item in a session
     * @param $key
     * @param $value
     */
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Retrieve an item from a session
     * @param $key
     * @return mixed
     */
    public static function get($key)
    {
        if (isset($_SESSION[$key]))
        {
            return $_SESSION[$key];
        }
        return false;
    }

    /**
     * Check if an item exists in the session
     * @param $key
     * @return bool
     */
    public static function has($key)
    {
        if (isset($_SESSION[$key]))
        {
            return true;
        }
        return false;
    }

    /**
     * Destroy a session. If a param is passed in just destroy that param
     * @param null $session
     * @return bool
     */
    public static function destroy($session = null)
    {
        if (isset($session))
        {
            if (isset($_SESSION[$session]))
            {
                unset($_SESSION[$session]);
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            session_destroy();
            return true;
        }
    }

    public static function destroyKey($session, $key)
    {
        if (isset($_SESSION[$session][$key]))
        {
            unset($_SESSION[$session][$key]);
            return true;
        }
        else
        {
            echo 'The session key was not found.';
            return false;
        }
    }
}