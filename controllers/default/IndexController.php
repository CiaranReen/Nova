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
        $this->view->js = array();
        $this->view->render('index/index');
    }
}