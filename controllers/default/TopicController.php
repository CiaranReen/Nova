<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 11:37
 */
require 'models/Index/Index.php';

class TopicController extends GoBaseController {

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
        $topicModel = new Topic();
        $topicId = $this->getParam('view');

        $topic = $topicModel->find($topicId, 'topic');

        $this->view->topic = $topic;
        $this->view->render('topic/view');
    }
}