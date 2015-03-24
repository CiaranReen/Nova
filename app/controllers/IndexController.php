<?php

class IndexController extends BaseController {

    public function indexAction()
    {
        $this->view->render('index.phtml');
    }
}