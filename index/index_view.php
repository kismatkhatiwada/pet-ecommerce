<?php
error_reporting(0);
session_start();

require_once '../connection.php';
if (isset($_GET['id'])) {
    // Retrieve the dog ID from the URL
    $dogId = $_GET['id'];

    // Fetch data from the database for the specific dog using the ID
    $sql = "SELECT dogs.*, breed.breed_name, size, color
        FROM dogs 
        JOIN breed ON dogs.breed_id = breed.id 
        WHERE dogs.id = $dogId";

    // Execute the query and check for errors
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        // Optionally log the error for debugging, but don't display it to the user
        error_log("SQL Error: " . mysqli_error($conn));
        $error = "Could not retrieve dog data at the moment. Please try again later.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/view.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>

    <div id="header">
        <a href="#"><i class="fas fa-paw"></i></a>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="index_about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <a href="../customer/customer_login.php" id="cart-icon" class="icon"><i
                        class="fas fa-shopping-cart"></i> <span id="cart-badge" class="badge"></span></a>
            </ul>
        </nav>
    </div>

    <div class="container">
        <?php if (isset($error)) { ?>
            <p><?= $error ?></p>
        <?php } else { ?>
            <?php while ($dog = mysqli_fetch_assoc($result)) { ?>
                <div class="item">
                    <div class="about">
                        <div class="image">
                            <img width="300" src="../admin/uploads/<?= htmlspecialchars($dog['image']) ?>"
                                alt="<?= htmlspecialchars($dog['breed']) ?>">
                        </div>
                        <div class="title">
                            <h1><?= htmlspecialchars($dog['breed_name']) ?></h1>
                            <p>Gender: <?= htmlspecialchars($dog['gender']) ?></p>
                            <p>Age: <?= htmlspecialchars($dog['age']) ?></p>
                            <p>Size: <?= htmlspecialchars($dog['size']) ?></p>
                            <p>Color: <?= htmlspecialchars($dog['color']) ?></p>
                            <p>Price: <?= htmlspecialchars($dog['price']) ?></p>
                            <p style="margin-top: 10px">Description: <?= htmlspecialchars($dog['description']) ?></p>
                        </div>
                    </div>
                    <div class="buttons">
                        <div class="icons">
                            <button onclick="redirectToLogin(event)">Add to Cart</button>
                        </div>
                        <div class="buy">
                            <a href=""><button>Buy Now</button></a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    </div>

    <script>
        function redirectToLogin(event) {
            event.preventDefault();
            alert('You must log in to add this pet to cart.');
            window.location.href = '../customer/customer_login.php';
        }
    </script>

</body>

</html>