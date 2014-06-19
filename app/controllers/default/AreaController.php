<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 11:37
 */

class AreaController extends NovaBaseController {

    //Call the NovaBaseController construct
    function __construct()
    {
        parent::__construct();
        $loggedIn = NovaSession::get('loggedIn');
        if ($loggedIn === false)
        {
            NovaSession::destroy();
            $this->user = false;
        }
    }

    public function indexAction()
    {
        $areaModel = new Area();
        $user = $areaModel->find(NovaSession::get('user_id'), 'user');
        $subscribedCourses = $areaModel->getSubscribedCourses($user['id']);
        $availableCourses = $areaModel->getAvailableCourses($user['id']);

        $this->view->subscribedCourses = $subscribedCourses;
        $this->view->availableCourses = $availableCourses;
        $this->view->render('area/index');
    }
}