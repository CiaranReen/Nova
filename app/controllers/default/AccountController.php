<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 11:37
 */
require 'app/models/Index/Index.php';

class AccountController extends NovaBaseController {

    //Call the GoBaseController construct
    public function __construct()
    {
        parent::__construct();

        $indexModel = new Index();
        $categories = $indexModel->fetchAll('category');
        $user = $indexModel->find(NovaSession::get('user_id'), 'user');

        if (!empty($user))
        {
            $this->view->user = $user;
            $this->goToUrl('/');
        }

        $this->view->categories = $categories;
    }

    public function indexAction()
    {
        $accountModel = new Account();
        $account = $accountModel->find(NovaSession::get('user_id'), 'user');

        if ($this->isPost() === true && $this->getRequest('csrf') === $_COOKIE['CSRF'])
        {
            $where = $this->getRequest('id');
            $data = array (
                'first_name' => $this->getRequest('first-name'),
                'last_name' => $this->getRequest('last-name'),
                'email' => $this->getRequest('email'),
            );

            $accountModel->updateRecord($data, 'user', $where);
            $this->view->render('account/success');
        }

        $this->view->account = $account;
        $this->view->render('account/index');
    }
}