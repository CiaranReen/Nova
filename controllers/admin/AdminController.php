<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 11:37
 */

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
    }

    public function indexAction()
    {
            $this->view->render('index');
    }
}