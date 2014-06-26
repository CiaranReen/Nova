<?php

/**
 * Password Hashing functions
 * By default this function does support md5, sha-1, or sha-256 due to security reasons
 *
 *
 * @copyright  2014 Nova Framework
 * @license    http://www.novaframework.com/license/3_0.txt   PHP License 3.0
 * @version    Release: @package_version@
 * @link       http://novaframework.com/package/PackageName
 * @since      Class available since Release 0.0.1
 */

class Hash
{

    /**
     * Hash a string
     * @param       $password
     * @return      string
     */
    public function encrypt($password)
    {
        $hash = crypt($password);
        return $hash;
    }

    /**
     * Verify a given hashed string
     *
     * @param $userInput
     * @param $hash
     * @return bool
     */
    public function decrypt($userInput, $hash)
    {
        if (crypt($userInput, $hash) == $hash)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * bCrypt password hash. PHP has to be >= 5.3.7
     *
     * @param       $password
     * @return      bool|false|string
     */
    public function bCryptPasswordHash($password)
    {
        if(version_compare(PHP_VERSION, '5.5', '>=') == '1')
        {
            // We specify PASSWORD_DEFAULT instead of PASSWORD_BCRYPT due to possible future compatibility issues
            $hash = password_hash($password, PASSWORD_DEFAULT);
            return $hash;
        }
        else if (version_compare(PHP_VERSION, '5.3.7', '>=') == '1')
        {
            $compat = 'vendor/compat/lib/password.php';
            if (file_exists($compat))
            {
                require $compat;

                $hash = password_hash($password, PASSWORD_DEFAULT);
                return $hash;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    /**
     * Verify a given bCrypt password
     *
     * @param $password
     * @param $hash
     * @return bool
     */
    public function bCryptVerify($password, $hash)
    {
        if (password_verify($password, $hash))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Function to check two passwords for a match
     *
     * @param $password
     * @param $confPassword
     * @return bool
     */
    public function passwordMatch($password, $confPassword)
    {
        if ($password === $confPassword)
        {
            return true;
        }

        return false;
    }

    /**
     * Generate a csrf cookie for use with forms
     */
    public function generateCSRFCookie()
    {
        $sessionId = $_COOKIE['PHPSESSID'];
        $rand = (string) (mt_rand());
        setcookie('CSRF',$sessionId . $rand, 0, '/', '', '', true);
    }
}