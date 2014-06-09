<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 11:37
 */
require 'models/stripe/lib/Stripe.php';

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

        $user = $courseModel->find(GoSession::get('user_id'), 'user');

        if ($this->isPost() === true)
        {
            // Set your secret key: remember to change this to your live secret key in production
            // See your keys here https://manage.stripe.com/account
            Stripe::setApiKey("sk_test_TzSXncFOgCe9vlZCtxTUBDuo");

            // Get the credit card details submitted by the form
            $token = $this->getRequest('stripeToken');

            // Create the charge on Stripe's servers - this will charge the user's card
            try {
                $charge = Stripe_Charge::create(array(
                        "amount" => 2500, // amount in cents, again
                        "currency" => "usd",
                        "card" => $token,
                        "description" => "payinguser@example.com")
                );
            } catch(Stripe_CardError $e) {
                // The card has been declined
                exit;
            }

            $data = array (
                'user_id' => $user['id'],
                'course_id' => $courseId

            );
            $courseModel->insertRecord($data, 'user_course');
            $this->view->render('courses/success');
        }
        else
        {
            $this->view->course = $course;
            $this->view->render('courses/view');
        }
    }
}