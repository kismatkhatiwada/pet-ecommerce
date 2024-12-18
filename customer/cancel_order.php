<?php
session_start();
require('../connection.php'); 

if (!isset($_SESSION['user_id'])) {
    die("User is not logged in.");
}

if (isset($_GET['id'])) {
    $order_id = $_GET['id'];
    $query = "UPDATE orders SET status = 'canceled' WHERE id = $order_id";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Order cancelled successfully');</script>";
    } else {
        echo "<script>alert('Error canceling order');</script>";
    }
}

header("Location: orders.php");
exit();
?>
