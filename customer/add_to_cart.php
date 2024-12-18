<?php
require_once '../connection.php';

        if (!empty($_POST)) {
            $dogid= $_POST['dog_id'];
            $customer_id= $_POST['customer_id'];
            $sql = "INSERT INTO cart(dog_id,customer_id) VALUES($dogid,$customer_id)";
            $dogSql = "SELECT quantity FROM dogs WHERE id=".$dogid;
            $qtyResult = mysqli_query($conn, $dogSql);
            $qtyData = mysqli_fetch_assoc($qtyResult);
            // $qtyAmt= $qtyData['quantity'];
            // $qtySQL = "UPDATE dogs SET quantity = ". $qtyAmt ." - 1 WHERE id =  ".$dogid; 
            // $qtyDecrease = mysqli_query($conn,$qtySQL);
            $result = mysqli_query($conn,$sql);
            if ($result) {
                $response = array('status' => 'success', 'msg' => 'Added to cart');
                echo json_encode($response);
            }else{
                $response = array('status' => 'fail', 'msg' => 'Some error occured');
                echo json_encode($response);
            }
        }
    
?>