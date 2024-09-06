<?php 

session_start();

require_once 'product.php';
require_once 'cart.php';

$product = new Product($conn);
$cart = new Cart($conn);

$products = $product->getAllProducts();

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

      <h1 class="mt-5 text-center">Products list</h1>
      <div class="d-flex justify-content-center mt-3">
            
        <div class="row">
              
          <?php foreach ($products as $product) { ?>
          <div class="col-lg-4 mt-2">
            <div class="card mb-5">
              <div style="flex-basis:100%">
                <img src="img/<?php echo $product['image'] ?>" width="100%" class="image">
              </div>
              <div class="card-body">
                  <h3 class="mb-3" style="color: var(--dark); font-size: 18px;"><?php echo $product["name"] ?></h3>
                  <h3 class="mb-3" style="color: var(--dark); font-size: 18px;"><?php echo "$ ". $product["price"] ?></h3>
                  <p><?php echo $product["description"] ?></p>
                  <hr style="color: var(--gray);">
                  <div class="d-flex justify-content-end">
                    <form action="user_cart.php" method="POST">
                      <input type="hidden" value="<?php echo $product['id'] ?>" name="product_id">
                      <input type="hidden" value="<?php echo $product['name'] ?>" name="product_name">
                      <input type="hidden" value="<?php echo $product['price'] ?>" name="product_price">
                      <input type="number" name="quantity" value="1" min="1" max="10">
                      <button class="btn btn-success" type="submit" name="addtocart">Add to Cart</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>
          </div>
        </div>
    </div>
  </body>
</html>  
