<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 11:37
 */
require 'app/models/Index/Index.php';

class CategoriesController extends NovaBaseController {

    //Call the GoBaseController construct
    function __construct()
    {
        parent::__construct();
        $loggedIn = NovaSession::get('adminLoggedIn');
        if ($loggedIn === false)
        {
            $this->goToUrl('/');
            exit;
        }
        $indexModel = new Index();
        $user = $indexModel->find(NovaSession::get('user_id'), 'user');

        if (!empty($user))
        {
            $this->view->user = $user;
        }
    }

    public function indexAction()
    {
        $categoryModel = new Categories();
        $categories = $categoryModel->fetchAll('category');

        //PAGINATOR
        $paginator = new Pagination();
        $paginator->setResultsPerPage(10);
        $paginator->setTotalNumberOfResults(count($categories));
        $this->view->paginator = $paginator->create($categories);

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