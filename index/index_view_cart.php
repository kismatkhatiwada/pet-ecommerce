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
function removeFromCart($id) {
    unset($_SESSION['cart'][$id]);
}

// Process removal of item from cart if "remove" parameter is set in the URL
if (isset($_GET['remove']) && isset($_SESSION['cart'][$_GET['remove']])) {
    removeFromCart($_GET['remove']);
    header("Location: customer_view_cart.php"); // Redirect to refresh the page
    exit;
}
// Check if $_SESSION['cart'] is set and not empty
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    $_SESSION['cart'] = []; // Initialize cart as an empty array
}

// Check if dogId is set in the URL
if(isset($_GET['dogId'])) {
    // Retrieve the dogId from the URL
    $dogId = $_GET['dogId'];
    
    // Check if the dogId already exists in the cart
    if(isset($_SESSION['cart'][$dogId])) {
        $_SESSION['cart'][$dogId]++;
        // If it exists, do nothing or show a message indicating that the item is already in the cart
        // You can modify this behavior as per your requirements
    } else {
        // If it doesn't exist, add it to the cart with a quantity of 1
        $_SESSION['cart'][$dogId] = 1;
    }
}

// Function to get product details by ID
function getProductById($conn, $id) {
    // Fetch data from the database
    $sql = "SELECT dogs.*, breed.breed_name 
            FROM dogs 
            LEFT JOIN breed ON dogs.breed_id = breed.id
            WHERE dogs.id = $id";
    
    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Fetch the row
    $row = mysqli_fetch_assoc($result);

    // Free the result set
    mysqli_free_result($result);

    return $row; // Return the fetched row
}



// Fetch cart items
$cartItems = [];
$totalPrice = 0;

// Check if $_SESSION['cart'] is not empty
    // Fetch data from the database for the specific dog using the ID
    $sql = "SELECT cart.*, dogs.image, dogs.price, breed.breed_name 
    FROM cart 
    JOIN dogs ON dogs.id = cart.dog_id 
    JOIN breed ON dogs.breed_id = breed.id 
    WHERE cart.customer_id = ".$_SESSION['user_id'];

    $cartresult = mysqli_query($conn, $sql);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Cart</title>
    
       
<body>
    <div id="header">
        <a href="#"><i class="fa-solid fa-paw"></i></a>
       <nav>
            <ul>
                <li><a href="customer_index.php">Home</a></li>
                <li><a href="../about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                
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
            </tr>
        </thead>
        <tbody>
        <?php while ($row = mysqli_fetch_assoc($cartresult)) {?>
                <tr>
                    <td><?= $row['breed_name'] ?></td>
                    <td><img src="../photos/<?= $row['image'] ?>" >  </td>
                    <td><?= $row['price'] ?></td> 
                </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="4">Total:</td>
                <td><?php echo $totalPrice; ?></td>
            </tr>
        </tfoot>
    </table>