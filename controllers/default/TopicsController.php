<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 11:37
 */
require 'models/Index/Index.php';

class TopicsController extends GoBaseController {

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
        $topicModel = new Topics();
        $indexModel = new Index();
        $topicId = $this->getParam('view');
        $user = $indexModel->find(GoSession::get('user_id'), 'user');

        $topic = $topicModel->find($topicId, 'topic');
        $comments = $topicModel->getCommentsByTopicId($topic['id']);

        $childComments = array();
        foreach ($comments as $comment)
        {
            $childComments[] = $topicModel->getChildComments($comment[0]);
        }
        $this->view->childComments = $childComments;

        if ($this->isPost() === true)
        {
            if ($this->getRequest('comment-reply') != null)
            {
                $parent = $this->getRequest('parent');
                $comment = $this->getRequest('comment-reply');
            }
            else
            {
                $parent = '0';
                $comment = $this->getRequest('comment');
            }

            $data = array (
                'comment' => $comment,
                'topic_id' => $topicId,
                'user_id' => $user['id'],
                'parent' => $parent
            );

            $this->view->success = 'Comment Added';
            $topicModel->insertRecord($data, 'comment');
        }

        $this->view->user = $user;
        $this->view->comments = $comments;
        $this->view->topic = $topic;
        $this->view->render('topic/view');
    }
}