<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 16:05
 */

class Courses extends GoBaseModel {

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Login function
     * @param $email
     * @param $password
     * @return bool
     */
    public function login($email, $password)
    {
        $sql = $this->db->prepare('SELECT id FROM user WHERE email = :email AND password = :password');

        $sql->execute(array (
            ':email' => $email,
            ':password' => $password,
        ));

        if ($sql->rowCount() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}