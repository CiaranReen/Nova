<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 11:37
 */
require 'app/models/Index/Index.php';

class TopicsController extends NovaBaseController {

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
        $topicModel = new Topics();
        $indexModel = new Index();
        $topicId = $this->getParam('view');
        $user = $indexModel->find(NovaSession::get('user_id'), 'user');

        $topic = $topicModel->find($topicId, 'topic');
        $comments = $topicModel->getCommentsByTopicId($topic['id']);

        //Child comments
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

    public function codepassAction()
    {
        $topicModel = new Topics();

        $topicId = $this->getParam('codepass');
        $codePass = $topicModel->getCodePassQuestionsByTopicId($topicId);

        //Validate test results
        if ($this->isPost() === true)
        {
            $results = array ();
            foreach ($_POST as $key=>$value)
            {
                $results[] = $topicModel->checkResults($key, $value);
            }

            if (in_array(false, $results))
            {
                //Calculate percentage
                $totalElements = count($results);
                $totalTrue = count(array_filter($results));
                $percentage = ($totalTrue / $totalElements) * 100;
                $this->view->codePassFail = 'You got ' . $percentage . '%. You need 100% to pass this test!';
            }
            else
            {
                //Passed. Save the corresponding badge in the db.
                $user = $topicModel->find(NovaSession::get('user_id'), 'user');
                $badge = $topicModel->getBadge($topicId);

                $data = array (
                    'user_id' => $user['id'],
                    'badge_id' => $badge[0]
                );

                $topicModel->insertRecord($data, 'user_badge');
                $this->view->codePassSuccess = 'You got 100%! Well done! You\'ve earned the ' . $badge['name'] . 'badge!' ;
            }

        }

        $this->view->codepass = $codePass;
        $this->view->render('topic/codepass');
    }

    /**
     * AJAX request for up voting a comment
     */
    public function upvoteAction()
    {
        $topicModel = new Topics();

        // Users cannot repeatedly vote on comments, so check if they have voted already
        $check = $topicModel->checkUserCanVote(NovaSession::get('user_id'), $this->getRequest('id'));
        if ($check == true)
        {
            $data = array (
                'votes_up' => 'votes_up + 1',
            );

            // Increment the db field accordingly
            $query = $topicModel->incrementRecord($data, 'comment', $this->getRequest('id'));

            // Did the query execute successfully?
            if ($query == true)
            {
                $data = array (
                    'user_id' => NovaSession::get('user_id'),
                    'comment_id' => $this->getRequest('id'),
                );

                $topicModel->insertRecord($data, 'user_comment');
                echo 'true';
                exit;
            }
            else
            {
                echo 'false';
                exit;
            }
        }
        else
        {
            echo 'false';
            exit;
        }


    }

    /**
     * AJAX request for down voting a comment
     */
    public function downvoteAction()
    {
        $topicModel = new Topics();

        // Users cannot repeatedly vote on comments, so check if they have voted already
        $check = $topicModel->checkUserCanVote(NovaSession::get('user_id'), $this->getRequest('id'));
        if ($check == true)
        {
            $data = array (
                'votes_down' => 'votes_down + 1',
            );

            // Increment the db field accordingly
            $query = $topicModel->incrementRecord($data, 'comment', $this->getRequest('id'));

            // Did the query execute successfully?
            if ($query == true)
            {
                $data = array (
                    'user_id' => NovaSession::get('user_id'),
                    'comment_id' => $this->getRequest('id'),
                );

                $topicModel->insertRecord($data, 'user_comment');
                echo 'true';
                exit;
            }
            else
            {
                echo 'false';
                exit;
            }
        }
        else
        {
            echo 'false';
            exit;
        }


    }
}