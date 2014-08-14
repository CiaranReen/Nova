<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 16:05
 */

class Dashboard extends NovaBaseModel {

    public function __construct()
    {
        parent::__construct();
    }

    public function findByUsername($username)
    {
        $sql = $this->select()
            ->from(array('user' => ''))
            ->where('username = ?', $username);

        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function getPoints($userId)
    {
        $sql = $this->select('points')
            ->from(array('user' => 'u'))
            ->where('id = ?', $userId);

        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetch();
    }

    public function getBadges($userId)
    {
        $sql = $this->select()
            ->from(array('user_badge' => 'ub'))
            ->innerJoin(array('user' => 'u'), 'ub.user_id = u.id')
            ->innerJoin(array('badge' => 'b'), 'ub.badge_id = b.id')
            ->where('ub.user_id = ?', $userId);

        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function getSubscribedCourses($userId)
    {
        $sql = $this->select()
            ->from(array('user_course' => 'uc'))
            ->innerJoin(array('user' => 'u'), 'uc.user_id = u.id')
            ->innerJoin(array('course' => 'c'), 'uc.course_id = c.id')
            ->where('uc.user_id = ?', $userId);

        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
}