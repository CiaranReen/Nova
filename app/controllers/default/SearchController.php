<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 11:37
 */
require 'app/models/Index/Index.php';

class SearchController extends NovaBaseController {

    //Call the NovaBaseController construct
    function __construct()
    {
        parent::__construct();

        $indexModel = new Index();
        $categories = $indexModel->fetchAll('category');
        $user = $indexModel->find(NovaSession::get('user_id'), 'user');

        if (!empty($user))
        {
            $this->view->user = $user;
        }

        $this->view->categories = $categories;
    }

    public function indexAction()
    {
        if ($this->isGet() === true)
        {
            $searchModel = new Search();
            $query = $this->getRequest('query');

            $results = $searchModel->search($query);
            $this->view->results = $results;
        }
        $this->view->render('search/index');
    }
}