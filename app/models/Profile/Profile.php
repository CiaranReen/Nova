<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 16:05
 */

class Profile extends NovaBaseModel {

    public function __construct()
    {
        parent::__construct();
    }

    public function findByUsername($username)
    {
        $sql = $this->db->prepare("SELECT * FROM user
        WHERE username = :username");

        $sql->execute(array (
            ':username' => $username
        ));

        return $sql->fetchAll();
    }
}