<?php

class IndexController extends BaseController {

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