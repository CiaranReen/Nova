<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 11:37
 */
require 'models/Donate/Donate.php';
require 'models/Index/Index.php';

class AdminController extends GoBaseController {

    //Call the GoBaseController construct
    function __construct()
    {
        parent::__construct();
        $loggedIn = GoSession::get('adminLoggedIn');
        if ($loggedIn === false)
        {
            $this->goToUrl('/');
            exit;
        }
        $indexModel = new Index();
        $user = $indexModel->find(GoSession::get('user_id'), 'user');

        if (!empty($user))
        {
            $this->view->user = $user;
        }
    }

    public function indexAction()
    {
        $donationModel = new Donate();
        $monthArray = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'October', 'November', 'December');

        $donations = array();
        foreach ($monthArray as $month)
        {
            $donations[] = $donationModel->getTotalPerMonth($month);

        }
        $this->view->donations = $donations;

        $this->view->render('index');
    }
}