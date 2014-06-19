<?php

/**
 * Class AuthController
 */

class ProfileController extends NovaBaseController {

    //Call the NovaBaseController construct
    function __construct()
    {
        parent::__construct();
    }

    public function indexAction()
    {
        $this->view->render('profile/index');
    }

    public function viewAction()
    {
        $profileModel = new Profile();
        $username = $this->getParam('view');
        $user = $profileModel->findByUsername($username);

        $this->view->user = $user;
        $this->view->render('profile/view');
    }
}