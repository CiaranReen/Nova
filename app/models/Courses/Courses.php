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
        $sql = $this->db->prepare("SELECT * FROM course_topic as ct
        INNER JOIN topic as t ON ct.topic_id = t.id
        WHERE ct.course_id = :courseId
        ORDER BY t.difficulty " . $sort);

        $sql->execute(array (
            ':courseId' => $courseId,
        ));

        return $sql->fetchAll();
    }

    public function getCourses()
    {
        $sql = $this->db->prepare("SELECT * FROM category_course as cc
        INNER JOIN category AS c ON cc.category_id = c.id
        INNER JOIN course AS co ON cc.course_id = co.id");

        $sql->execute();

        return $sql->fetchAll();
    }

    public function getCourseById($courseId)
    {
        $sql = $this->db->prepare("SELECT * FROM category_course as cc
        INNER JOIN category AS c ON cc.category_id = c.id
        INNER JOIN course AS co ON cc.course_id = co.id
        WHERE cc.course_id = :courseid");

        $sql->execute(array (
            ':courseid' => $courseId,
        ));

        return $sql->fetchAll();
    }
}