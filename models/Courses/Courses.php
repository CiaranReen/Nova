<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 16:05
 */

class Courses extends GoBaseModel {

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
}