<?php

/**
 * Class ProfileController
 */
require 'app/models/Index/Index.php';

class ProfileController extends NovaBaseController {

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
        $this->view->render('profile/index');
    }

    public function viewAction()
    {
        $profileModel = new Profile();
        $points = $profileModel->getPoints(NovaSession::get('user_id'));
        $points = $points['points'];
        $badges = $profileModel->getBadges(NovaSession::get('user_id'));

        //Scaling leveling
        $level = floor(pow(($points/500),((1/1.1))));

        if ($level == 0)
        {
            $level = 1;
        }

        $this->view->badges = $badges;
        $this->view->level = $level;
        $this->view->render('profile/view');
    }
}