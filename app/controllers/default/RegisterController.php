<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 11:37
 */

class RegisterController extends NovaBaseController {

    //Call the NovaBaseController construct
    function __construct()
    {
        parent::__construct();
    }

    public function indexAction()
    {
        $registerModel = new Register();

        if ($this->isPost() === true && $this->passwordMatch($this->getRequest('password'), $this->getRequest('conf-password')) === true)
        {
            $newPass = $registerModel->sha1PasswordHash($this->getRequest('password'));

            if ($registerModel->checkEmailExists($this->getRequest('email')) === false)
            {
                $userData = array (
                    'first_name' => $this->getRequest('first-name'),
                    'last_name' => $this->getRequest('last-name'),
                    'role' => 'default',
                    'is_over_13' => $this->getRequest('age'),
                    'company' => $this->getRequest('company'),
                    'email' => $this->getRequest('email'),
                    'password' => $newPass,
                    'security_question_id' => $this->getRequest('security-question'),
                    'security_question_answer' => $this->getRequest('answer'),
                );

                $save = $registerModel->insertRecord($userData, 'user');
                $this->view->render('register/success');
            }
            else
            {
                $this->view->render('register/email');
            }

        }
        else
        {
            $securityQuestions = $registerModel->getSecurityQuestions();
            $this->view->security_questions = $securityQuestions;
            $this->view->render('register/index');
        }
    }
}