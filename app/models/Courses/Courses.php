<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 16:05
 */

class Courses extends NovaBaseModel {

    public function __construct()
    {
        parent::__construct();
    }

    public function getTopics($courseId, $sort = null)
    {
        $sql = $this->select()
            ->from(array('course_topic' => 'ct'))
            ->innerJoin(array('topic' => 't'), 'ct.topic_id = t.id')
            ->where('ct.course_id = ?', $courseId)
            ->orderBy('t.difficulty', $sort);

        $query = $this->db->prepare($sql);

        $query->execute();

        return $query->fetchAll();
    }

    public function getCourses()
    {
        $sql = $this->select()
            ->from(array('category_course' => 'cc'))
            ->innerJoin(array('category' => 'c'), 'cc.category_id = c.id')
            ->innerJoin(array('course' => 'co'), 'cc.course_id = co.id');

        $query = $this->db->prepare($sql);

        $query->execute();

        return $query->fetchAll();
    }

    public function getCourseById($courseId)
    {
        $sql = $this->select()
            ->from(array('category_course' => 'cc'))
            ->innerJoin(array('category' => 'c'), 'cc.category_id = c.id')
            ->innerJoin(array('course' => 'co'), 'cc.course_id = co.id')
            ->where('cc.course_id = ?', $courseId);
        $query = $this->db->prepare($sql);

        $query->execute();

        return $query->fetchAll();
    }
}