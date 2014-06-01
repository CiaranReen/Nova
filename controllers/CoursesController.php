<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 11:37
 */

class CoursesController extends GoBaseController {

    //Call the GoBaseController construct
    function __construct()
    {
        parent::__construct();
        if (GoSession::get('loggedIn') === false)
        {
            header('location: ../index');
        }
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

        $this->view->course = $course;
        $this->view->render('courses/view');

    }
}