<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 11:37
 */

class AccountController extends NovaBaseController {

    //Call the GoBaseController construct
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
        $accountModel = new Account();
        $account = $accountModel->find(NovaSession::get('user_id'), 'user');

        if ($this->isPost() === true)
        {
            $where = $this->getRequest('id');
            $data = array (
                'first_name' => $this->getRequest('first-name'),
                'last_name' => $this->getRequest('last-name'),
                'company' => $this->getRequest('company'),
                'email' => $this->getRequest('email'),
            );

            $accountModel->updateRecord($data, 'user', $where);
            $this->view->render('account/success');
        }

        $this->view->account = $account;
        $this->view->render('account/index');
    }
}