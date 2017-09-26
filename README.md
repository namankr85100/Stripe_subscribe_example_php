# Stripe_subscribe_example_php
#Basic Stripe Subscribe example in php because stipe will not make one in context.

First install stripe with composter 'composer require stripe/stripe-php"

In your index.php file add a basic cherckout. Where is says 'data-key="pk_test_GET THIS FROM STRIPE"' get your api key from stripe.

```
<form action="plan.php" method="POST">
 <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="pk_test_GET THIS FROM STRIPE"
    data-amount="999"
    data-name="sarabandefoundation.org"
    data-description="Widget"
    data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
    data-locale="auto"
    data-zip-code="true"
    data-currency="gbp">
  </script>
</form>```

You can see that ourt action is plan.php. Make a file called plan.php in the same root directory. In plan.php paste the code below. 

```<?php

require_once('vendor/autoload.php');

\Stripe\Stripe::setApiKey("sk_test_ GET THIS FROM STRIPE");

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

?>```

Hope that helps.
