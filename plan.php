
<?php
// API key here
// (switch to the live)


// Set your secret key: remember to change this to your live secret key in production
// See your keys here: https://dashboard.stripe.com/account/apikeys

require_once('vendor/autoload.php');


\Stripe\Stripe::setApiKey("sk_test_Jpa8PbjcHICSh7yZSjoVdMdN");

// Get the token from the JS script
$token = $_POST['stripeToken'];

// Create a Customer
$customer = \Stripe\Customer::create(array(
    "email" => "paying.user@example.com",
    "source" => $token,
));

// or you can fetch customer id from the database too.

// Creates a subscription plan. This can also be done through the Stripe dashboard.
// You only need to create the plan once.
$subscription = \Stripe\Plan::create(array(
    "amount" => 2000,
    "interval" => "month",
    "name" => "Gold large",
    "currency" => "cad",
    "id" => "gold"
));

// Subscribe the customer to the plan
$subscription = \Stripe\Subscription::create(array(
    "customer" => $customer->id,
    "plan" => "gold"
));


print_r($subscription);

?>






