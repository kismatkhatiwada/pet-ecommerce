<?php
session_start();
require('connection.php');

if (!empty($_SESSION['name']) && !empty($_SESSION['email']) && !empty($_SESSION['address']) && !empty($_POST['customer_id']) && !empty($_POST['dog_id'])) {
    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
    $address = $_SESSION['address'];
    $cid = $_POST['customer_id'];
    $dog_id = $_POST['dog_id'];

    $sql = "INSERT INTO orders(name,email,address,customer_id,dog_id, status) 
            VALUES ('$name','$email','$address',$cid,$dog_id, 'pending')";
   
    $dogSql = "SELECT quantity FROM dogs WHERE id=".$dog_id;
    $qtyResult = mysqli_query($conn, $dogSql);
    $qtyData = mysqli_fetch_assoc($qtyResult);
    $qtyAmt= $qtyData['quantity'];
    $qtySQL = "UPDATE dogs SET quantity = ". $qtyAmt ." - 1 WHERE id =  ".$dog_id; 
    $qResult = mysqli_query($conn, $qtySQL);
    $result = mysqli_query($conn, $sql);
    $logMessage = "Order details: Name: $name, Email: $email, Address: $address, Customer ID: $cid, Dog ID: $dog_id\n";
    if ($result) {
        $message = "Order placed successfully!";
        $logMessage .= "Database insertion successful.\n";
    } else {
        $message = "Failed to place order.";
        $logMessage .= "Database insertion failed: " . mysqli_error($conn) . "\n";
    }
    file_put_contents('payment.log', $logMessage, FILE_APPEND);

    unset($_SESSION['name']);
    unset($_SESSION['email']);
    unset($_SESSION['address']);
} else {
    $message = "No order details received.";
    file_put_contents('payment.log', "No order details received.\n", FILE_APPEND);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment Successful</title>
</head>
<body style="text-align: center;">
    <h1 style="color:green;">Payment Successful!</h1>
    <p><?php echo $message; ?></p>
    <p>Thank you for your purchase.</p>
    <p>Your order has been placed and is being processed.</p>
</body>
</html>