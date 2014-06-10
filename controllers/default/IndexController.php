<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 11:37
 */

class IndexController extends GoBaseController {

    //Call the GoBaseController construct
    function __construct()
    {
        parent::__construct();
        $loggedIn = GoSession::get('loggedIn');
        if ($loggedIn === false)
        {
            GoSession::destroy();
            $this->user = false;
        }
    }

    public function indexAction()
    {
        $indexModel = new Index();
        $categories = $indexModel->fetchAll('category');
        $user = $indexModel->find(GoSession::get('user_id'), 'user');

        if (!empty($user))
        {
            $this->view->user = $user;
        }

        $this->view->categories = $categories;
        $this->view->render('index/index');
    }
}