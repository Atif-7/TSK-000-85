<?php

include_once 'db.php';

class User{
    private $db;

    public function _construct($db){
        $this->db = $db;
    }

    public function getUserById($id){
        $query = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i",$id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}

?>