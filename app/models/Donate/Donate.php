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
        $sql = $this->select('SUM(amount) as amount')
            ->from(array('donation' => ''))
            ->where('month = ?', $month);
        $query = $this->db->prepare($sql);

        $query->execute();

        $data = $query->fetchAll();

        foreach ($data as $d)
        {
            return $d;
        }
    }
}