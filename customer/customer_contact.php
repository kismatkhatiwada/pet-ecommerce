<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #222;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            max-width: 900px;
            width: 100%;
            padding: 20px;
            background-color: #333;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            display: flex;
        }
        .left-side {
            width: 70%;
            padding: 20px;
        }
        .contact-info {
            width: 30%;
            padding: 20px;
            border-left: 2px solid #4CAF50;
        }
        h1 {
            color: #4CAF50;
            margin-bottom: 20px;
        }
        .contact-info h2 {
            color: #4CAF50;
            margin-bottom: 15px;
        }
        .contact-info p {
            color: #ddd;
            margin: 10px 0;
            font-size: 16px;
        }
        .contact-info p:hover {
            color: #fff;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            color: #4CAF50;
            margin-bottom: 5px;
        }
        .form-group input[type="text"],
        .form-group input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #4CAF50;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
            background-color: #444;
            color: #fff;
        }
        .form-group button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
            width: 100%;
        }
        .form-group button:hover {
            background-color: #45a049;
        }
        .back-to-home {
            position: absolute;
            top: 20px;
            left: 20px;
        }
        .back-to-home button {
            position: relative;
            right: 14px;
            padding: 10px 15px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        .back-to-home button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>


<div class="container">
    <div class="left-side">
        <h1>Contact Us</h1>
        <form id="contactForm" action="submit_contact.php" method="POST">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>
    <div class="contact-info">
        <h2>Contact Information</h2>
        <p><i class="fa fa-phone"></i> Phone 1: 9845919784</p>
        <p><i class="fa fa-phone"></i> Phone 2: 9865519046</p>
        <p><i class="fa fa-envelope"></i> Email: petpal@gmail.com</p>
    </div>
    <div class="back-to-home">
        <button onclick="window.location.href = 'customer_index.php';">Back to Home</button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get the contact form
        var contactForm = document.getElementById('contactForm');
        
        // Add submit event listener to the form
        contactForm.addEventListener('submit', function(event) {
            // Prevent the default form submission
            event.preventDefault();
            
            // Show the alert message
            alert('Thank you for contacting us.');
            
            // Reset the form fields
            contactForm.reset();
            
            // Redirect to homepage
            window.location.href = 'customer_index.php';
        });
    });
</script>

</body>
</html>
