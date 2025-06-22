<?php
session_start();

require_once '../connection.php';

// Fetch data from the database
$sql = "SELECT dogs.*, breed.breed_name 
        FROM dogs 
        LEFT JOIN breed ON dogs.breed_id = breed.id";
$result=mysqli_query($conn,$sql);

$dogsData = [];
while ($row = mysqli_fetch_assoc($result)) {
    $dogsData[] = $row;
}

// // Function to get product details by ID
// function getProductById($conn, $id) {
//     // Fetch data from the database
//     $sql = "SELECT dogs.*, breed.breed_name 
//             FROM dogs 
//             LEFT JOIN breed ON dogs.breed_id = breed.id
//             WHERE dogs.id = $id";
    
//     // Execute the query
//     $result = mysqli_query($conn, $sql);

//     // Fetch the row
//     $row = mysqli_fetch_assoc($result);

//     // Free the result set
//     mysqli_free_result($result);

//     return $row; // Return the fetched row
// }



// Fetch cart items
$cartItems = [];
$totalPrice = 0;

// Check if $_SESSION['cart'] is not empty
    // Fetch data from the database for the specific dog using the ID
        $sql = " SELECT cart.cart_id,cart.dog_id as did, cart.customer_id as cid, dogs.image, dogs.price, breed.breed_name 
        FROM cart 
        JOIN dogs 
        ON      dogs.id = cart.dog_id 
        JOIN breed 
        ON      dogs.breed_id = breed.id 
        WHERE   cart.customer_id = " . $_SESSION['user_id'] ;

    // echo $sql;
    // die;

    $cartresult = mysqli_query($conn, $sql);
    // while ($row = mysqli_fetch_assoc($cartresult)){
    //     $cartItems[] = $row;
    // }
    // echo "<pre>";
    // print_r($cartItems);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Cart</title>
    <link rel="stylesheet" href="css/customer_view_cart.css">
       
<body>
    <div id="header">
        <a href="#"><i class="fa-solid fa-paw"></i></a>
       <nav>
            <ul>
                <li><a href="customer_index.php">Home</a></li>
                <li><a href="../about.php">About</a></li>
                <li><a href="customer_contact.php">Contact</a></li>
                <li><a href="orders.php">Orders</a></li>
                
                <a href="#" id="cart-icon" class="icon"><i class="fas fa-shopping-cart"></i> <span id="cart-badge" class="badge"></span></a>
            </ul>
        </nav>
    </div>
    <h1>Shopping Cart</h1>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Image</th>
                <th>Price</th>
                
                <th>Action</th>
                <!-- <th>Place order</th> -->
            </tr>
        </thead>
        <tbody>
        <?php while ($row = mysqli_fetch_assoc($cartresult)) {
                
            ?>
                <tr>
                    <td><?= $row['breed_name']?></td>
                    <td><img src="../photos/<?= $row['image'] ?>" >  </td>
                    <td><?= $row['price'] ?></td> 
                    
                    <td><a href="./cart_item_delete.php?cid=<?=$row['cart_id']?>">Delete</a></td>
                    <td><a href="../customer/checkout.php?dog_id=<?=$row['did']?>&cid=<?=$_SESSION['user_id']?>"><button>Place order</button></a></td>
                </tr>
            <?php } ?>
        </tbody>
       
    </table>
    <style>
        
    </style>
    <!-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get the cart icon and badge
            var cartIcon = document.getElementById('cart-icon');
            var cartBadge = document.getElementById('cart-badge');
           
            // Add click event listener to the cart icon in the navbar
            cartIcon.addEventListener('click', function(event) {
                window.location.href = 'customer_view_cart.php';
            });
        });
    </script> -->
