<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 11:37
 */

class AreaController extends GoBaseController {

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
        $areaModel = new Area();
        $user = $areaModel->find(GoSession::get('user_id'), 'user');
        $subscribedCourses = $areaModel->getSubscribedCourses($user['id']);
        $availableCourses = $areaModel->getAvailableCourses($user['id']);

        $this->view->subscribedCourses = $subscribedCourses;
        $this->view->availableCourses = $availableCourses;
        $this->view->render('area/index');
    }
}