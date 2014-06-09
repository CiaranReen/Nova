<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 16:05
 */

class Area extends GoBaseModel {

    public function __construct()
    {
        parent::__construct();
    }

    public function getSubscribedCourses($userId)
    {
        $sql = $this->db->prepare('SELECT * FROM user_course AS uc
        INNER JOIN course AS c ON uc.course_id = c.id
        INNER JOIN user AS u ON uc.user_id = u.id
        WHERE uc.user_id = :userid');

        $sql->execute(array(
            'userid' => $userId
        ));

        $data = $sql->fetchAll();
        return $data;
    }

    public function getAvailableCourses()
    {
        $sql = $this->db->prepare('SELECT * FROM course AS c');

        $sql->execute();

        $data = $sql->fetchAll();
        return $data;
    }
}