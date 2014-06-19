<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 16:05
 */

class Donate extends NovaBaseModel {

    public function __construct()
    {
        parent::__construct();
    }

    public function getTotalPerMonth($month)
    {
        $sql = $this->db->prepare("SELECT SUM(amount) as amount FROM donation
        WHERE month = :month");

        $sql->execute(array (
            ':month' => $month,
        ));

        $data = $sql->fetchAll();

        foreach ($data as $d)
        {
            return $d;
        }
    }
}