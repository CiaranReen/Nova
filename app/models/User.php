<?php

class User extends Models_Base {

    public function getAllUsers() {
        $sql = $this->select()
            ->from(array('user' => 'u'))
            ->orderBy('u.last_name', 'ASC');

        $query = $this->db->prepare($sql);

        $query->execute();

        return $query->fetchAll();
    }
}