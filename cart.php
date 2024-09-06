<?php

include_once 'db.php';

class Cart{
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function addProduct($product_name, $user_id, $product_id, $quantity){
        $query = "INSERT INTO cart (product_name, user_id, product_id, quantity) VALUES(?,?,?,?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("iiii", $product_name, $user_id, $product_id, $quantity);
        $stmt->execute();
    }

    public function getCartitems($user_id){
        $query = "SELECT * FROM cart WHERE user_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i",$user_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function updateQuantity($user_id,$product_id,$quantity) {
        $query = "UPDATE cart SET quantity = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("iii",$quantity,$user_id, $product_id);
        $stmt->execute();
    }

    public function removeProduct($user_id,$product_id) {
        $query = "DELETE FROM cart WHERE user_id = ? AND product_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii",$user_id, $product_id);
        $stmt->execute();
    }
}

?>