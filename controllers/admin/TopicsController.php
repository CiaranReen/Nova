<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 11:37
 */

class TopicsController extends GoBaseController {

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
        $topicModel = new Topics();
        $topics = $topicModel->fetchAll('topic');

        $this->view->topics = $topics;
        $this->view->render('topics/index');
    }

    public function addAction()
    {
        $topicModel = new Topics();

        if ($this->isPost() === true)
        {
            $data = array (
                'name' => $this->getRequest('name'),
                'difficulty' => $this->getRequest('difficulty'),
                'description' => $this->getRequest('description'),
                'content' => $this->getRequest('content'),
            );

            $topicModel->insertRecord($data, 'topic');
            $this->goToUrl('/admin/topics');
        }
        else
        {
            $this->view->render('topics/add');
        }
    }

    public function editAction()
    {
        $topicModel = new Topics();

        $topicId = $this->getParam('edit');

        if ($this->isPost() === true)
        {
            $data = array (
                'name' => $this->getRequest('name'),
                'difficulty' => $this->getRequest('difficulty'),
                'description' => $this->getRequest('description'),
                'content' => $this->getRequest('content'),
            );

            $topicModel->updateRecord($data, 'topic', $this->getRequest('id'));
            $this->goToUrl('/admin/topics');
        }
        else
        {
            $topic = $topicModel->find($topicId, 'topic');
            $this->view->topic = $topic;
            $this->view->render('topics/edit');
        }
    }
}