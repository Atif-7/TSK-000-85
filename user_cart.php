<?php
    session_start();
    require_once 'cart.php';
            
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $product_price = $_POST['product_price'];
    $product_name = $_POST['product_name'];
    
    if (isset($_POST['addtocart'])) { 

        if (isset($_SESSION['cart'])) {
            $check_product = array_column($_SESSION['cart'],'product_name');
            if (in_array($product_name,$check_product)) {
                echo "<script>
                alert('This product has already added')
                window.location.href = 'index.php'
                </script>";
            }else{
                // $cart->addProduct($product_name, 1, $product_id, $quantity);
                $_SESSION['cart'][] = array('product_id' => $product_id, 'product_name' => $product_name, 'product_quantity' => $quantity, 'product_price' => $product_price);
                echo "<script>
                    alert('$quantity  $product_name has been added to your cart successfully!')
                    window.location.href = 'view_cart.php'
                    </script>";
            }

        }
        else{
            // $cart->addProduct($product_name, 1, $product_id, $quantity);
            $_SESSION['cart'][] = array('product_id' => $product_id, 'product_name' => $product_name, 'product_quantity' => $quantity, 'product_price' => $product_price);
            echo "<script>
                alert('$quantity  $product_name has been added to your cart successfully!')
                window.location.href = 'view_cart.php'
                </script>";  
        }
    }
    
    if (isset($_POST['remove_item'])) {
        foreach ($_SESSION['cart'] as $key => $value) { 
            if ($value['product_id'] === $_POST['item']) {
                unset($_SESSION['cart'][$key]);
                $_SESSION['cart'] = array_values($_SESSION['cart']);
                header('location:view_cart.php');
            }
        } 
    }    

    if (isset($_POST['update_cart'])) {
        foreach ($_SESSION['cart'] as $key => $value) { 
            if ($value['product_id'] === $_POST['item']) {
                $_SESSION['cart'][$key] = array('product_id' => $product_id, 'product_name' => $product_name, 'product_quantity' => $quantity, 'product_price' => $product_price);
                header('location:view_cart.php');
            }
        }
    }
?>;