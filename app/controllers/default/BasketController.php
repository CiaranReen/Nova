<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 02/07/14
 * Time: 11:35
 */
require 'app/models/Index/Index.php';

class BasketController extends NovaBaseController
{
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
        $basketModel = new Nova_Basket();
        $allItems = $basketModel->getBasket();

        $this->view->items = $allItems;
        $this->view->render('basket/index');
    }
}