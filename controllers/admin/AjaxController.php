<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 11:37
 */

class AjaxController extends GoBaseController {

    //Call the GoBaseController construct
    function __construct()
    {
        parent::__construct();
        $loggedIn = GoSession::get('adminLoggedIn');
        if ($loggedIn === false)
        {
            $this->view->render('login');
        }
    }

    public function indexAction()
    {
        $this->view->render('index');
    }

    public function deletecourseAction()
    {
        $ajaxModel = new Ajax();
        $courseId = $this->getRequest('courseid');
        $ajaxModel->delete($courseId, 'course');
        return true;
    }

    public function deleteuserAction()
    {
        $ajaxModel = new Ajax();
        $userId = $this->getRequest('userid');
        $ajaxModel->delete($userId, 'user');
        return true;
    }
}