<?php
session_start();

require_once '../connection.php';
if (isset($_GET['id'])) {
    // Retrieve the dog ID from the URL
    $dogId = $_GET['id'];
    
    // Fetch data from the database for the specific dog using the ID
    $sql = "SELECT dogs.*, breed.breed_name, size,color
        FROM dogs 
        JOIN breed ON dogs.breed_id = breed.id 
          
        WHERE dogs.id = $dogId";


    $result = mysqli_query($conn, $sql);
}

$dsql = "SELECT quantity FROM dogs WHERE dogs.id = $dogId";
$dresult = mysqli_query($conn, $dsql);
$dquantity = mysqli_fetch_assoc($dresult);




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   <link rel="stylesheet" href="css/customer_view.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
    
<body>

<div id="header">
    <a href="#"><i class="fas fa-paw"></i></a>
       <nav>
            <ul>
                <li><a href="../customer/customer_index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="orders.php">Orders</a></li>
               
                <a href="customer_view_cart.php" id="cart-icon" class="icon"><i class="fas fa-shopping-cart"></i> <span id="cart-badge" class="badge"></span></a>
            </ul>
        </nav>
    </div>

    <div class="container">
        <?php while($dog=mysqli_fetch_assoc($result)) { ?>
            <div class="item">
                <div class="image">
                    <img src="../admin/uploads/<?= $dog['image'] ?>" alt="<?= $dog['breed'] ?>">
                </div>
                <div class="title">
                    <h1><?= $dog['breed_name'] ?></h1>
                    <p>Gender:<?= $dog['gender'] ?></p>
                    <p>Age: <?= $dog['age'] ?></p>
                    <p>Size: <?= $dog['size'] ?></p>
                    <p>Color: <?= $dog['color'] ?></p>
                    <p>Description: <?= $dog['description'] ?></p>
                    <p>Price: <?= $dog['price'] ?></p>
                    <p>Quantity: <?= $dog['quantity'] ?></p>
                </div>
            </div>
        
            <div class="icons">
            <?php if ($dog['quantity'] == 0) { ?>
                <div   class='out-of-stock'>Out of stock!!!</div>;
            <?php } else {
                 ?>
                <a href="#" class="icon add-to-cart" data-dog-id="<?= $dog['id'] ?>" data-user-id="<?= $_SESSION['user_id'] ?>">
                    <button>Add to Cart</button>
                </a>
            </div>
            <div class="buy">
                <a href="checkout.php?dog_id=<?= $dog['id'] ?>&cid=<?= $_SESSION['user_id'] ?>">
                    <button>Buy Now</button>
                </a>
            </div>
            <?php } ?>
        <?php } ?>
    </div>

</body>

</html>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var addToCartButtons = document.querySelectorAll('.add-to-cart');
    // Add click event listener to each "Add to Cart" button
    addToCartButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();

            // Get the dog ID and user ID from the data attributes
            var dogId = button.getAttribute('data-dog-id');
            var userId = button.getAttribute('data-user-id');
            

            // Check if dogId and userId are not null or undefined
            if (dogId && userId) {
                var formData = new FormData();
                formData.append('dog_id', dogId);
                formData.append('customer_id', userId);

                // Send a POST request to the PHP file
                fetch('add_to_cart.php', {
                    method: 'POST',
                    body: formData // Send form data
                })
                .then(response => {
                    // Parse response as JSON
                    return response.json();
                })
                .then(data => {
                    // Handle JSON response data
                    alert(data.msg)
                })
                .catch(error => {
                    // Handle errors
                    console.error('There was a problem with the fetch operation:', error);
                });
            } else {
                console.error('Data attributes are missing or incorrectly set.');
            }
        });
    });
});


</script>