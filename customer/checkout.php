<?php 
require('../connection.php');
if (!empty($_POST)) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $cid = $_POST['customer_id'];
    $dog_id = $_POST['dog_id'];

    $sql = "INSERT INTO orders(name,email,address,customer_id,dog_id) 
            VALUES ('$name','$email','$address',$cid,$dog_id)";
   
    $dogSql = "SELECT quantity FROM dogs WHERE id=".$dog_id;
    $qtyResult = mysqli_query($conn, $dogSql);
    $qtyData = mysqli_fetch_assoc($qtyResult);
    $qtyAmt= $qtyData['quantity'];
    $qtySQL = "UPDATE dogs SET quantity = ". $qtyAmt ." - 1 WHERE id =  ".$dog_id; 
    $qResult = mysqli_query($conn, $qtySQL);
    $result = mysqli_query($conn, $sql);
    if ($result) { 
        // echo "Success";
        header('Location:customer_index.php');
    }else{
        echo "Failed to add";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Order</title>
    
</head>
<body>
    <div class="container">
        <h1>Order Details</h1>
        <h2>Checkout</h2>
        <form class="checkout-form" action="checkout.php" method="POST">
            <!-- Here you can add fields for the user to enter their information -->
            <!-- For example: -->
            <input type="hidden" name="dog_id" value="<?php if (isset($_GET['dog_id'])) {
                echo $_GET['dog_id'];
            }?> ">
            <input type="hidden" name="customer_id" value="<?php if (isset($_GET['cid'])) {
                echo $_GET['cid'];
            }?>">
            <div class="order-details">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="order-details">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="order-details">
                <label for="address">Address:</label>
                <textarea id="address" name="address" required></textarea>
            </div>
            <!-- Add more fields as needed (e.g., for payment information) -->
            <button onclick="alert('Ordered successfully');" type="submit">Proceed to Checkout</button>



        </form>
    </div>


    <style>
        /* Example CSS styles for the ordering box */
        body {
            font-family: Arial, sans-serif;
            background-color: #141313;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .order-details {
            margin-bottom: 30px;
        }

        .order-box {
            border: 1px solid #ccc;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .checkout-form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .checkout-form input[type="text"],
        .checkout-form input[type="email"],
        .checkout-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .checkout-form textarea {
            height: 100px;
        }

        .checkout-form button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .checkout-form button:hover {
            background-color: #0056b3;
        }
    </style>



</body>
</html>
