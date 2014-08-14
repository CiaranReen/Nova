<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 11:37
 */
require 'app/models/Index/Index.php';

class DashboardController extends NovaBaseController {

    //Call the NovaBaseController construct
    public function __construct()
    {
        parent::__construct();
        $indexModel = new Index();
        $categories = $indexModel->fetchAll('category');

        $user = $indexModel->find(NovaSession::get('user_id'), 'user');

        if (!empty($user))
        {
            $this->view->user = $user;
        }

        $this->view->categories = $categories;
    }

    public function indexAction()
    {
        $dashboardModel = new Dashboard();
        $userId = NovaSession::get('user_id');

        $points = $dashboardModel->getPoints($userId);
        $points = $points['points'];
        $badges = $dashboardModel->getBadges($userId);
        $subscribedCourses = $dashboardModel->getSubscribedCourses($userId);

        //Scaling leveling
        $level = floor(pow(($points/500),((1/1.1))));

        if ($level == 0)
        {
            $level = 1;
        }

        $this->view->subscribed_courses = $subscribedCourses;
        $this->view->badges = $badges;
        $this->view->level = $level;
        $this->view->render('dashboard/index');
    }
}