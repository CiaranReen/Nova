<?php

class WelcomeController extends BaseController {

    public function indexAction()
    {
        $this->view->render('index.phtml');
    }
}