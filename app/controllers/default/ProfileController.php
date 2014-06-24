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
        //Scaling leveling
        $level = floor(pow((6000/500),((1/1.2))));
        $this->view->level = $level;
        $this->view->render('profile/view');
    }
}