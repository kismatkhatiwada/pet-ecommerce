<?php
$products = [
    ['id' => 1, 'name' => 'Laptop', 'price' => 20],
    ['id' => 2, 'name' => 'Smartphone', 'price' => 18],
    ['id' => 3, 'name' => 'Headphones', 'price' => 16],
    ['id' => 4, 'name' => 'Smartwatch', 'price' => 12],
    ['id' => 5, 'name' => 'Tablet', 'price' => 15],
    ['id' => 6, 'name' => 'Charger', 'price' => 5],
    ['id' => 7, 'name' => 'USB Cable', 'price' => 3],
    ['id' => 8, 'name' => 'Bluetooth Speaker', 'price' => 25],
    ['id' => 9, 'name' => 'Wireless Mouse', 'price' => 10],
    ['id' => 10, 'name' => 'Webcam', 'price' => 30],
];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Select Product</title>
</head>
<body>
    <h2>Select a product to purchase</h2>
    <form action="checkout.php" method="POST">
        <select name="product_id" required>
            <option value="">-- Select Product --</option>
            <?php foreach ($products as $product): ?>
                <option value="<?= $product['id'] ?>">
                    <?= $product['name'] ?> (NPR <?= number_format($product['price']) ?>)
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Proceed to Checkout</button>
    </form>
</body>
</html>