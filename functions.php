<?php
function generateEsewaSignature($total_amount, $transaction_uuid, $product_code, $secret_key) {
    $data = "total_amount={$total_amount},transaction_uuid={$transaction_uuid},product_code={$product_code}";
    $hash = hash_hmac('sha256', $data, $secret_key, true);
    return base64_encode($hash);
}