<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 11:37
 */
require 'app/models/Index/Index.php';

class CategoriesController extends NovaBaseController {

    //Call the NovaBaseController construct
    public function __construct()
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
        $this->view->render('index/index');
    }

    public function viewAction()
    {
        $categoryModel = new Categories();
        $categoryId = $this->getParam('view');

        $category = $categoryModel->find($categoryId, 'category');
        $courses = $categoryModel->getCourses($categoryId);

        $this->view->category = $category;
        $this->view->courses = $courses;
        $this->view->render('category/view');
    }
}