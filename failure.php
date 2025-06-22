<!DOCTYPE html>
<html>
<head>
    <title>Payment Failed</title>
</head>
<body style="text-align: center;">
    <h2>Your Payment Was Not Successful.</h2>
    <p>Please try again or contact support if the problem persists.</p>
</body>
</html>
<?php
$logMessage = "Payment failed. " . PHP_EOL;
file_put_contents('payment.log', date('Y-m-d H:i:s') . ' - ' . $logMessage, FILE_APPEND);
?>