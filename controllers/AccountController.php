<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 11:37
 */

class AccountController extends GoBaseController {

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
        $accountModel = new Account();
        $account = $accountModel->fetchAll('user');

        if ($this->isPost() === true)
        {
            $data = array (
                'first_name' => $this->getRequest('first-name'),
                'last_name' => $this->getRequest('last-name'),
                'company' => $this->getRequest('company'),
                'email' => $this->getRequest('email'),
            );

            $accountModel->save($data, 'user');
            $this->;
        }

        $this->view->account = $account;
        $this->view->render('account/index');
    }
}