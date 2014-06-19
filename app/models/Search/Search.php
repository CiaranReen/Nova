<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 16:05
 */

class Search extends NovaBaseModel {

    public function __construct()
    {
        parent::__construct();
    }

    public function search($query)
    {
        $sql = $this->db->prepare("SELECT * FROM course_topic AS ct
        INNER JOIN topic AS t ON ct.topic_id = t.id
        INNER JOIN course AS c ON ct.course_id = c.id
        WHERE c.name LIKE ? OR t.name LIKE ?");

        $sql->bindValue(1, "%$query%", PDO::PARAM_STR);
        $sql->bindValue(2, "%$query%", PDO::PARAM_STR);

        $sql->execute();

        return $sql->fetchAll();
    }
}