<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 11:37
 */
require 'app/models/Index/Index.php';

class CoursesController extends NovaBaseController {

    //Call the NovaBaseController construct
    function __construct()
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
        $courseModel = new Courses();
        $courses = $courseModel->fetchAll('course');

        $this->view->courses = $courses;
        $this->view->render('courses/index');
    }

    public function viewAction()
    {
        $courseModel = new Courses();

        $courseId = $this->getParam('view');
        $course = $courseModel->find($courseId, 'course');

        if ($this->getRequest('action') === null)
        {
            $topics = $courseModel->getTopics($courseId);
        }
        else
        {
            $topics = $courseModel->getTopics($courseId, $this->getRequest('action'));
        }

        $this->view->topics = $topics;
        $this->view->course = $course;
        $this->view->render('courses/view');
    }
}