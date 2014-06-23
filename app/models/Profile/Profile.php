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
        $sql = $this->select()
            ->from(array('user' => ''))
            ->where('username = ?', $username);
        $query = $this->db->prepare($sql);

        $query->execute();

        return $query->fetchAll();
    }
}