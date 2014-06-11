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
        $loggedIn = GoSession::get('adminLoggedIn');
        if ($loggedIn === false)
        {
            $this->view->render('login');
            exit;
        }
    }

    public function indexAction()
    {
        $courseModel = new Courses();
        $courses = $courseModel->fetchAll('course');

        $this->view->courses = $courses;
        $this->view->render('courses/index');
    }

    public function addAction()
    {
        $courseModel = new Courses();

        if ($this->isPost() === true)
        {
            $data = array (
                'name' => $this->getRequest('name'),
                'description' => $this->getRequest('description'),
            );

            $courseModel->insertRecord($data, 'course');
            $this->goToUrl('/admin/courses');
        }
        else
        {
            $this->view->render('courses/add');
        }
    }

    public function editAction()
    {
        $courseModel = new Courses();

        $courseId = $this->getParam('edit');

        if ($this->isPost() === true)
        {
            $data = array (
                'name' => $this->getRequest('name'),
                'description' => $this->getRequest('description'),
            );

            $courseModel->updateRecord($data, 'course', $this->getRequest('id'));
            $this->goToUrl('/admin/courses');
        }
        else
        {
            $course = $courseModel->find($courseId, 'course');
            $this->view->course = $course;
            $this->view->render('courses/edit');
        }
    }
}