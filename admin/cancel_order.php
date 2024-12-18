<?php
session_start();
require('../connection.php'); 

if (!isset($_SESSION['user_id'])) {
    die("User is not logged in.");
}

if (isset($_POST['id'])) {
    $order_id = $_POST['id'];
    
    // Retrieve the dog_id from the order before deleting it
    $order_query = "SELECT dog_id FROM orders WHERE id = $order_id";
    $order_result = mysqli_query($conn, $order_query);
    $order_data = mysqli_fetch_assoc($order_result);

    if ($order_data) {
        $dog_id = $order_data['dog_id'];
        
        // Delete the order
        $cancel_sql = "DELETE FROM orders WHERE id = $order_id";
        $cancel_res = mysqli_query($conn, $cancel_sql);

        if ($cancel_res) {
            // Restore the quantity of the pet
            $restore_sql = "UPDATE dogs SET quantity = quantity + 1 WHERE id = $dog_id";
            $restore_res = mysqli_query($conn, $restore_sql);

            if ($restore_res) {
                echo "<script>alert('Order canceled and pet quantity restored successfully.'); window.location.href='pending_orderr.php';</script>";
            } else {
                echo "<script>alert('Failed to restore the pet quantity.'); window.location.href='pending_orderr.php';</script>";
            }
        } else {
            echo "<script>alert('Failed to cancel the order.'); window.location.href='pending_orderr.php';</script>";
        }
    } else {
        echo "<script>alert('Order not found.'); window.location.href='pending_orderr.php';</script>";
    }
} else {
    echo "<script>alert('Order ID is not set.'); window.location.href='pending_orderr.php';</script>";
}
?>
