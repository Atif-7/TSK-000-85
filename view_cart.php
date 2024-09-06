<?php
session_start();
$g_total = 0;
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
              <a class="nav-link" href="index.php">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container">
      <h1 class="mt-5 text-center">My Cart <i class="fa fa-shopping-cart" aria-hidden="true"></i></h1>
      <div class="d-flex justify-content-center mt-3">
        <div class="row">
          <div class="col-md-12 col-sm-6 mt-2">
            <table class="table table-light text-center">
              <thead>
                <th>
                  S. No
                </th>
                <th>
                  Product ID
                </th>
                <th>
                  Product Name
                </th>
                <th>
                  Price
                </th>
                <th>
                  Quantity
                </th>
                <th>
                  Total
                </th>
                <th>
                  Update
                </th>
                <th>
                  Delete
                </th>
              </thead>
              <?php 
              if (isset($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $key => $item) { 
                  $total = $item['product_price'] * $item["product_quantity"];  
                  $g_total += $total;
                  $_SESSION['total_amount']= $g_total;
              ?>
              <tbody>
                <form action="user_cart.php" method="POST">
                <tr>
                <td><h3 style="color: var(--dark); font-size: 18px;"><?php echo $key + 1 ?></h3></td>
                <td>
                  <input type="hidden" value="<?php echo $item["product_id"] ?>" name="product_id">
                  <h3 style="color: var(--dark); font-size: 18px;"><?php echo $item["product_id"] ?></h3>
                </td>
                <td>
                  <input type="hidden" value="<?php echo $item["product_name"] ?>" name="product_name"><h3 style="color: var(--dark); font-size: 18px;"><?php echo $item["product_name"] ?></h3></td>
                <td>
                  <input type="hidden" value="<?php echo $item["product_price"] ?>" name="product_price">
                  <h3 style="color: var(--dark); font-size: 18px;"><?php echo $item["product_price"] ?></h3>
                </td>
                <td>
                  <h3 style="color: var(--dark); font-size: 18px;"><input type="number" value="<?php echo $item["product_quantity"] ?>" class="text-center" max="10" min="1" name="quantity"></h3>
                </td>
                <td>
                  <h3 style="color: var(--dark); font-size: 18px;"><?php echo $total ?></h3>
                </td>
                <td><button class="btn btn-primary btn-sm" type="submit" name="update_cart">Update</button></td>
                <td>
                  <input type="hidden" name="item" value="<?php echo $item["product_id"]; ?>">
                  <button class="btn btn-danger btn-sm" type="submit" name="remove_item">Delete</button>
                </td>
                </tr>
                </form>
              </tbody>
              <?php } } ?>
            </table>
            <div class="d-flex align-items-center justify-content-between">
              <div>
              <form method="POST" action="checkout.php" class="d-flex align-items-center">
                <input type="text" disabled class="fw-bold fs-5 text-success text-center" value="Grand Total = <?php echo $g_total ?>">
                <input type="submit" class="btn btn-success mx-2 fw-bold" value="Checkout">
              </form>
              </div>
              <div>
                <a href="index.php" class="text-decoration-none mx-2 text-primary">click here to continue Shopping</a>
              </div>
            </div>
          </div>              
        </div>
      </div>
    </div>
  </body>
</html>  
