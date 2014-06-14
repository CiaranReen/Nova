<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 11:37
 */

class CategoriesController extends GoBaseController {

    //Call the GoBaseController construct
    function __construct()
    {
        parent::__construct();
        $loggedIn = GoSession::get('adminLoggedIn');
        if ($loggedIn === false)
        {
            $this->goToUrl('/');
            exit;
        }
        $indexModel = new Index();
        $user = $indexModel->find(GoSession::get('user_id'), 'user');

        if (!empty($user))
        {
            $this->view->user = $user;
        }
    }

    public function indexAction()
    {
        $categoryModel = new Categories();
        $categories = $categoryModel->fetchAll('category');

        $this->view->categories = $categories;
        $this->view->render('categories/index');
    }

    public function addAction()
    {
        $categoryModel = new Categories();

        if ($this->isPost() === true)
        {
            $data = array (
                'name' => $this->getRequest('name'),
                'parent' => '0'
            );

            $categoryModel->insertRecord($data, 'category');
            $this->goToUrl('/admin/categories');
        }
        else
        {
            $this->view->render('categories/add');
        }
    }

    public function editAction()
    {
        $categoryModel = new Categories();

        $categoryId = $this->getParam('edit');

        if ($this->isPost() === true)
        {
            $data = array (
                'name' => $this->getRequest('name'),
            );

            $categoryModel->updateRecord($data, 'category', $this->getRequest('id'));
            $this->goToUrl('/admin/categories');
        }
        else
        {
            $category = $categoryModel->find($categoryId, 'category');
            $this->view->category = $category;
            $this->view->render('categories/edit');
        }
    }
}