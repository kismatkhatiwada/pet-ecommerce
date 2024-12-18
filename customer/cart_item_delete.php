<?php
if (isset($_GET['cid'])) {
    require_once '../connection.php';
    $cid = $_GET['cid'];

    $sql = "DELETE FROM cart where cart_id =  $cid";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location: customer_view_cart.php");
    }
    echo "Data deletion failed!";
} else {
    echo "Erorr!";
}