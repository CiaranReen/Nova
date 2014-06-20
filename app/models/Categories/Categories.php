<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 16:05
 */

class Categories extends NovaBaseModel {

    public function __construct()
    {
        parent::__construct();
    }

    public function getCourses($categoryId)
    {
        $sql = $this->select()
            ->from(array('category_course' => 'cc'))
            ->innerJoin(array('course' => 'c'), 'cc.course_id = c.id')
            ->where('cc.category_id = ?', $categoryId);
        $query = $this->prepare($sql);

        $query->execute();

        return $query->fetchAll();
    }
}