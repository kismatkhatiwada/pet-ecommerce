<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';

    // Validation (optional)
    if (empty($name) || empty($address) || empty($phone) || empty($email)) {
        echo "All fields are required.";
        exit;
    }

    // Prepare email content
    $subject = "New Contact Us Form Submission";
    $message = "
        <html>
        <head>
            <title>$subject</title>
        </head>
        <body>
            <h2>New contact form submission</h2>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Address:</strong> $address</p>
            <p><strong>Phone:</strong> $phone</p>
            <p><strong>Email:</strong> $email</p>
        </body>
        </html>
    ";

    // Set email headers
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8" . "\r\n";
    $headers .= "From: $email" . "\r\n";  // You can set the "From" address to be the user's email

    // Send the email
    if (mail("kismatkhatiwada3@gmail.com", $subject, $message, $headers)) {
        // Redirect or show success message
        echo "Thank you for contacting us. We will get back to you shortly.";
    } else {
        echo "There was an error sending your message. Please try again.";
    }
}
?>
