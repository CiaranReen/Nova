<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 28/05/14
 * Time: 09:41
 */

class GoSession {

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
     * Destroy a session
     */
    public static function destroy()
    {
        session_destroy();
    }
}