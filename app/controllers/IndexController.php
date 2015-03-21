<?php

class IndexController extends Controllers_Base {

    //Call the NovaBaseController construct
    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction()
    {
        $this->view->render('index');
    }
}