<?php
require_once 'functions.php';

require_once 'connection.php';

if (!isset($_POST['product_id'])) {
    die("Invalid product selection: No product ID provided");
}

$product_id = $_POST['product_id'];

$sql = "SELECT dogs.*, breed.breed_name
        FROM dogs
        LEFT JOIN breed ON dogs.breed_id = breed.id
        WHERE dogs.id = $product_id";

$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    die("Invalid product selection: Product with ID $product_id not found");
}

$product = mysqli_fetch_assoc($result);

$amount = $product['price'];
$tax_amount = 0;
$total_amount = $amount + $tax_amount;

$product_code = 'EPAYTEST';
$secret_key = '8gBm/:&EnhH.1/q';
$transaction_uuid = uniqid('TXN_');

$signature = generateEsewaSignature($total_amount, $transaction_uuid, $product_code, $secret_key);
?>

<form id="esewaForm" action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST">
    <input type="hidden" name="amount" value="<?= $amount ?>">
    <input type="hidden" name="tax_amount" value="<?= $tax_amount ?>">
    <input type="hidden" name="total_amount" value="<?= $total_amount ?>">
    <input type="hidden" name="transaction_uuid" value="<?= $transaction_uuid ?>">
    <input type="hidden" name="product_code" value="<?= $product_code ?>">
    <input type="hidden" name="product_service_charge" value="0">
    <input type="hidden" name="product_delivery_charge" value="0">
    <input type="hidden" name="success_url" value="http://localhost/BCA%204/Ecommerce_Payment_Integration/dynamic/success.php?product_name=<?= urlencode($product['name']) ?>">
    <input type="hidden" name="failure_url" value="http://localhost/BCA%204/Ecommerce_Payment_Integration/dynamic/failure.php">
    <input type="hidden" name="signed_field_names" value="total_amount,transaction_uuid,product_code">
    <input type="hidden" name="signature" value="<?= $signature ?>">
</form>
<?php
$logMessage = "Checkout initiated for product: " . $product['name'] . ", amount: " . $amount . ", transaction UUID: " . $transaction_uuid . PHP_EOL;
file_put_contents('payment.log', date('Y-m-d H:i:s') . ' - ' . $logMessage, FILE_APPEND);
?>

<script>
    document.getElementById('esewaForm').submit();
</script>