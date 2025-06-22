<?php
session_start();
require('../connection.php');

function generateEsewaSignature($total_amount, $transaction_uuid, $product_code, $secret_key)
{
    $data = "total_amount={$total_amount},transaction_uuid={$transaction_uuid},product_code={$product_code}";
    $hash = hash_hmac('sha256', $data, $secret_key, true);
    return base64_encode($hash);
}

$product_code = 'EPAYTEST';
$secret_key = '8gBm/:&EnhH.1/q';
$transaction_uuid = uniqid('TXN_');

$dog_id = $_GET['dog_id'];

$dogSql = "SELECT price FROM dogs WHERE id=" . $dog_id;
$dogResult = mysqli_query($conn, $dogSql);
$dogData = mysqli_fetch_assoc($dogResult);
$amount = $dogData['price'];
$tax_amount = 0;
$total_amount = $amount + $tax_amount;

$signature = generateEsewaSignature($total_amount, $transaction_uuid, $product_code, $secret_key);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['address'] = $_POST['address'];
    header("Location: customer/checkout.php?dog_id=$dog_id");
    exit();
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
        <form id="esewaForm" class="checkout-form" action="https://rc-epay.esewa.com.np/api/epay/main/v2/form"
            method="POST">
            <!-- Here you can add fields for the user to enter their information -->
            <!-- For example: -->
            <input type="hidden" name="amount" value="<?= $amount ?>">
            <input type="hidden" name="tax_amount" value="<?= $tax_amount ?>">
            <input type="hidden" name="total_amount" value="<?= $total_amount ?>">
            <input type="hidden" name="transaction_uuid" value="<?= $transaction_uuid ?>">
            <input type="hidden" name="product_code" value="<?= $product_code ?>">
            <input type="hidden" name="product_service_charge" value="0">
            <input type="hidden" name="product_delivery_charge" value="0">
            <input type="hidden" name="success_url"
                value="http://localhost/pet_ecommerce/success.php?dog_id=<?= $_GET['dog_id'] ?>">
            <input type="hidden" name="failure_url" value="http://localhost/pet_ecommerce/failure.php">
            <input type="hidden" name="signed_field_names" value="total_amount,transaction_uuid,product_code">
            <input type="hidden" name="signature" value="<?= $signature ?>">
            <input type="hidden" name="dog_id" value="<?php if (isset($_GET['dog_id'])) {
                echo $_GET['dog_id'];
            } ?> ">
            <input type="hidden" name="customer_id" value="<?php if (isset($_GET['cid'])) {
                echo $_GET['cid'];
            } ?>">
            <input type="hidden" name="name" value="<?php echo isset($_SESSION['name']) ? $_SESSION['name'] : ''; ?>">
            <input type="hidden" name="email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>">
            <input type="hidden" name="address"
                value="<?php echo isset($_SESSION['address']) ? $_SESSION['address'] : ''; ?>">
            <div class="order-details">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo isset($_SESSION['name']) ? $_SESSION['name'] : ''; ?>" required>
            </div>
            <div class="order-details">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>" required>
            </div>
            <div class="order-details">
                <label for="address">Address:</label>
                <textarea id="address" name="address" required><?php echo isset($_SESSION['address']) ? $_SESSION['address'] : ''; ?></textarea>
            </div>
            <!-- Add more fields as needed (e.g., for payment information) -->
            <button type="submit">Proceed to Checkout</button>


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