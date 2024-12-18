<?php
require_once '../connection.php';
    // if ($_SERVER['REQUEST_METHOD']== "POST") {
        if (!empty($_POST)) {
            $dogid= $_POST['dog_id'];
            $customer_id= $_POST['customer_id'];
            $sql = "INSERT INTO cart(dog_id,customer_id) VALUES($dogid,$customer_id)";
            $result = mysqli_query($conn,$sql);
            
            }
        // }
    
?>
 