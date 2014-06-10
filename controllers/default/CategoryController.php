<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 11:37
 */
require 'models/Index/Index.php';

class CategoryController extends GoBaseController {

    //Call the GoBaseController construct
    function __construct()
    {
        parent::__construct();

        $indexModel = new Index();
        $categories = $indexModel->fetchAll('category');
        $user = $indexModel->find(GoSession::get('user_id'), 'user');

        if (!empty($user))
        {
            $this->view->user = $user;
        }

        $this->view->categories = $categories;
    }

    public function indexAction()
    {
        $this->view->render('index/index');
    }

    public function viewAction()
    {
        $categoryModel = new Category();
        $categoryId = $this->getParam('view');

        $courses = $categoryModel->getCourses($categoryId);

        $this->view->courses = $courses;
        $this->view->render('category/view');
    }
}