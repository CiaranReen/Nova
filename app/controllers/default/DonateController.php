<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 11:37
 */
require 'app/models/Index/Index.php';
require 'app/models/stripe/lib/Stripe.php';

class DonateController extends NovaBaseController {

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
                        "amount" => $this->getRequest('amount') . '00', // amount in cents, again
                        "currency" => "usd",
                        "card" => $token,
                        "description" => "payinguser@example.com")
                );
            } catch(Stripe_CardError $e) {
                // The card has been declined
                exit;
            }

            $this->view->render('donate/thankyou');
        }
        $this->view->render('donate/index');
    }
}