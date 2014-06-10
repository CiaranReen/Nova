<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 16:05
 */

class Category extends GoBaseModel {

    public function __construct()
    {
        parent::__construct();
    }

    public function getCourses($categoryId)
    {
        $sql = $this->db->prepare('SELECT * FROM category_course AS cc
        INNER JOIN course AS c ON cc.course_id = c.id
        WHERE cc.category_id = :id');

        $sql->execute(array(
            'id' => $categoryId
        ));

        return $sql->fetchAll();
    }
}