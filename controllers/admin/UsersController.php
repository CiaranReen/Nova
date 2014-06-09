<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 11:37
 */

class UsersController extends GoBaseController {

    //Call the GoBaseController construct
    function __construct()
    {
        parent::__construct();
        $loggedIn = GoSession::get('adminLoggedIn');
        if ($loggedIn === false)
        {
            $this->view->render('login');
            exit;
        }
    }

    public function indexAction()
    {
        $userModel = new Users();
        $users = $userModel->fetchAll('user');

        $this->view->users = $users;
        $this->view->render('users/index');
    }

    public function addAction()
    {
        $userModel = new Users();

        if ($this->isPost() === true)
        {
            $data = array (
                'first_name' => $this->getRequest('first_name'),
                'price' => $this->getRequest('last_name'),
                'email' => $this->getRequest('email'),
                'role' => $this->getRequest('role'),
                'company' => $this->getRequest('company'),
            );

            $userModel->insertRecord($data, 'user');
            $this->goToUrl('/admin/courses');
        }
        else
        {
            $this->view->render('courses/add');
        }
    }
}