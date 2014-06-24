<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 11:37
 */
require 'app/models/Index/Index.php';
require 'app/forms/Courses/CoursesForm.php';

class CoursesController extends NovaBaseController {

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
        $courseModel = new Courses();

        $courses = $courseModel->getCourses();

        //PAGINATOR
        $paginator = new Pagination();
        $paginator->setResultsPerPage(10);
        $paginator->setTotalNumberOfResults(count($courses));
        $this->view->paginator = $paginator->create($courses);

        $this->view->courses = $courses;
        $this->view->render('courses/index');
    }

    public function addAction()
    {
        $courseModel = new Courses();
        $courseForm = new CoursesForm();
        $addForm = $courseForm->addForm();

        $categories = $courseModel->fetchAll('category');

        if ($this->isPost() === true)
        {
            //Save the course into the db first
            $data = array (
                'name' => $this->getRequest('name'),
                'description' => $this->getRequest('description'),
                'image' => 'test',
            );

            $courseModel->insertRecord($data, 'course');

            //Now get the last inserted ID and save the category
            $lastInsertId = $courseModel->lastInsertId();

            $category = array (
                'category_id' => $this->getRequest('category'),
                'course_id' => $lastInsertId
            );

            $courseModel->insertRecord($category, 'category_course');
            $this->view->success= 1;
            $this->goToUrl('/admin/courses');
        }
        else
        {
            $this->view->form = $addForm;
            $this->view->categories = $categories;
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
            $course = $courseModel->getCourseById($courseId);
            $categories = $courseModel->fetchAll('category');

            $this->view->categories = $categories;
            $this->view->course = $course;
            $this->view->render('courses/edit');
        }
    }
}