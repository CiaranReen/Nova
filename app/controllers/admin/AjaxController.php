<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 11:37
 */

class AjaxController extends NovaBaseController {

    //Call the GoBaseController construct
    function __construct()
    {
        parent::__construct();
        $loggedIn = NovaSession::get('adminLoggedIn');
        if ($loggedIn === false)
        {
            $this->view->render('login');
        }
    }

    public function indexAction()
    {
        $this->view->render('index');
    }

    public function deleteAction()
    {
        $ajaxModel = new Ajax();
        $id = $this->getRequest('id');
        $table = $this->getRequest('table');
        $ajaxModel->delete($id, $table);
        return true;
    }
}