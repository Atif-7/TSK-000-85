<?php 

require_once 'db.php';

class Product{
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function getAllProducts(){
        $query = "SELECT * FROM products";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getProductById($id){
        $query = "SELECT * FROM products WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

}

?>