<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 11:37
 */
require 'app/models/Index/Index.php';

class TopicsController extends NovaBaseController {

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
        $topicModel = new Topics();
        $topics = $topicModel->fetchAll('topic');

        //PAGINATOR
        $paginator = new Pagination();
        $paginator->setResultsPerPage(10);
        $paginator->setTotalNumberOfResults(count($topics));
        $this->view->paginator = $paginator->create($topics);

        $this->view->topics = $topics;
        $this->view->render('topics/index');
    }

    public function addAction()
    {
        $topicModel = new Topics();
        $courses = $topicModel->fetchAll('course');

        if ($this->isPost() === true)
        {
            $data = array (
                'name' => $this->getRequest('name'),
                'difficulty' => $this->getRequest('difficulty'),
                'description' => $this->getRequest('description'),
                'content' => $this->getRequest('content'),
            );

            $topicModel->insertRecord($data, 'topic');
            $lastInsertId = $topicModel->lastInsertId();

            $course = array (
                'course_id' => $this->getRequest('course'),
                'topic_id' => $lastInsertId
            );

            $topicModel->insertRecord($course, 'course_topic');

            $this->view->success = 1;
            $this->goToUrl('/admin/topics');
        }
        else
        {
            $this->view->courses = $courses;
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