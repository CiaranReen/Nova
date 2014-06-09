<?php

/**
 * Class AuthController
 */

class AuthController extends GoBaseController {

    //Call the GoBaseController construct
    function __construct()
    {
        parent::__construct();
    }

    public function indexAction()
    {
        $this->view->render('auth/index');
    }

    public function loginAction()
    {
        $authModel = new Auth();
        //$authModel->test();
        $email = $this->getRequest('email');
        $password = $authModel->sha1PasswordHash($this->getRequest('password'));
        $auth = $authModel->login($email, $password);
        if ($auth[0]['role'] === 'admin')
        {
            GoSession::set('adminLoggedIn', true);
            GoSession::set('loggedIn', true);
            GoSession::set('user_id', $auth[0]['id']);
            $url = '/';
            $this->goToUrl($url);
        }
        elseif ($auth[0]['role'] === 'default')
        {
            GoSession::set('loggedIn', true);
            GoSession::set('user_id', $auth[0]['id']);
            $url = '/';
            $this->goToUrl($url);
        }
    }

    public function logoutAction()
    {
        GoSession::destroy();
        $url = '/auth/';
        $this->goToUrl($url);
    }

    public function resetAction()
    {
        $authModel = new Auth();
        if ($this->getRequest('email') != null)
        {
            //Get the security question for the user
            $securityQuestion = $authModel->getSecurityQuestionByEmail($this->getRequest('email'));
            if ($securityQuestion != null)
            {
                //Send the security question to the view
                $this->view->security_question = $securityQuestion;
                $this->view->render('auth/security-question');
            }
        }
        elseif ($this->getRequest('answer') != null)
        {
            $answerCheck = $authModel->checkAnswer($this->getRequest('answer'));

            if ($answerCheck === true)
            {
                //The answers match. Send an email with new password
                $this->view->render('index/index');
            }
        }
        else
        {
            $this->view->render('auth/forgotten-password');
        }
    }
}