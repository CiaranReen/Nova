<?php

/**
 * Class AuthController
 */


class AuthController extends NovaBaseController {

    //Call the NovaBaseController construct
    public function __construct()
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
        $hash = new Hash();

        $email = $this->getRequest('email');
        $userPassword = $authModel->getUserPasswordByEmail($email);

        $userInput = $this->getRequest('password');
        $verifyPassword = $hash->decrypt($userInput, $userPassword);

        if ($verifyPassword === true)
        {
            $auth = $authModel->login($email);
            $hash->generateCSRFCookie();

            if ($auth['role'] === 'admin')
            {
                NovaSession::set('adminLoggedIn', true);
                NovaSession::set('loggedIn', true);
                NovaSession::set('user_id', $auth['id']);
                $this->goToUrl('/dashboard');
            }
            elseif ($auth['role'] === 'default')
            {
                NovaSession::set('loggedIn', true);
                NovaSession::set('user_id', $auth['id']);
                $this->goToUrl('/dashboard');
            }
        }
        else
        {
            // TODO Redirect to wrong login
            $this->goToUrl('/');
        }

    }

    public function logoutAction()
    {
        NovaSession::destroy();
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