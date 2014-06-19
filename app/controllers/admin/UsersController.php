<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 11:37
 */
require 'app/models/Register/Register.php';
require 'app/models/Index/Index.php';

class UsersController extends NovaBaseController {

    //Call the GoBaseController construct
    function __construct()
    {
        parent::__construct();
        $loggedIn = NovaSession::get('adminLoggedIn');
        if ($loggedIn === false)
        {
            $this->goToUrl('/');
            exit;
        }
        $indexModel = new Index();
        $user = $indexModel->find(NovaSession::get('user_id'), 'user');

        if (!empty($user))
        {
            $this->view->user = $user;
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
        $registerModel = new Register();

        if ($this->isPost() === true && $this->passwordMatch($this->getRequest('password'), $this->getRequest('conf-password')) === true)
        {
            $newPass = $registerModel->sha1PasswordHash($this->getRequest('password'));

            if ($registerModel->checkEmailExists($this->getRequest('email')) === false)
            {
                $userData = array (
                    'first_name' => $this->getRequest('first-name'),
                    'last_name' => $this->getRequest('last-name'),
                    'role' => $this->getRequest('role'),
                    'is_over_13' => $this->getRequest('age'),
                    'company' => $this->getRequest('company'),
                    'email' => $this->getRequest('email'),
                    'password' => $newPass,
                    'security_question_id' => $this->getRequest('security-question'),
                    'security_question_answer' => $this->getRequest('answer'),
                );

                $userModel->insertRecord($userData, 'user');
                $this->goToUrl('/admin/users');
            }
        }
        else
        {
            $securityQuestions = $registerModel->getSecurityQuestions();
            $this->view->security_questions = $securityQuestions;
            $this->view->render('users/add');
        }
    }

    public function editAction()
    {
        $userModel = new Users();

        $userId = $this->getParam('edit');

        if ($this->isPost() === true)
        {
            $data = array (
                'first_name' => $this->getRequest('first-name'),
                'last_name' => $this->getRequest('last-name'),
                'is_over_13' => $this->getRequest('last-age'),
                'email' => $this->getRequest('email'),
                'role' => $this->getRequest('role'),
            );

            $userModel->updateRecord($data, 'user', $this->getRequest('id'));
            $this->goToUrl('/admin/users');
        }
        else
        {
            $user = $userModel->find($userId, 'user');
            $this->view->user = $user;
            $this->view->render('users/edit');
        }
    }
}