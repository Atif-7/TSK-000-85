<?php
session_start();
require_once 'vendor/stripe/stripe-php/init.php';
if (isset($_POST['stripeToken'])) {
  \Stripe\Stripe::setVerifySslCerts(false);

  $token = $_POST['stripeToken'];

  $data = \Stripe\Charge::create([
    'amount' => $_POST['unit_amount'],
    'currency' => 'usd',
    'description'=> '',
    'source' => $token, 
  ]);
}else {
  echo "<script> alert('the process has not completed, try again later or contact website's email for help');
  window.location.href = 'vew_cart.php'; </script>";
}
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shopping With AR</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <div class="logo">
          <a class="navbar-brand fs-2" href="index.php">AR Shop <i class="fa fa-shopping-bag" aria-hidden="true"></i></a>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto text-center">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="view_cart.php">Cart</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login.php">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="signup.php">Signup</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container">

      <h3 class="mt-5 text-center">Thanks for the Payment of <?php echo $_SESSION['total_amount'].'$'?> you will get your product within 2 days.</h3>
      <div class="d-flex justify-content-center mt-3">
        <a href="index.php" class="btn btn-primary">Back to Home </a>
      </div>
    </div>
  </body>
</html>  
