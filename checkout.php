<?php

session_start();

require __DIR__ . "/vendor/autoload.php";
require_once 'vendor/stripe/stripe-php/init.php';

$items = [
    [
        'price_data' => [
            'currency' => 'usd',
            'unit_amount' => $_SESSION['total_amount']*100,
            'product_data' => [
                'name' => 'Total Amount',
            ],
        ],
        'quantity' => 1,
    ],
];

$stripe_secret_key = "sk_test_51PvPYWRpzyYQGm0lqT2IPMXDJvqRGI8J1jmHQmD4JGWmq6iXy891pUkcEITZTTMCRnOKM7oqP9mJ0rUPVQL2c4fh000dRwi4sP";
\Stripe\Stripe::setApiKey($stripe_secret_key);

$checkout_session = \Stripe\Checkout\Session::create([
    "mode" => "payment",
    "success_url" => "http://localhost/TSK-000-85/success.php",
    "cancel_url" => "http://localhost/TSK-000-85/view_cart.php",
    "line_items" => $items
]);

http_response_code(303);
header("Location: " . $checkout_session->url);

?>

<!-- <form action="success.php" method="POST">
    <script src="https://chekout.stripe.com/checkout.js" class="stripe-button"
     data-key="<?php $publishableKey ?>" 
     data-amount="<?php $_SESSION['total_amount'] ?>" 
     data-name="Shopping with AR"
     data-description="payment process of shopping"
     data-image=""
     data-currency="usd"
     data-email="Atifurehman176@gmail.com">
    </script>
</form> -->