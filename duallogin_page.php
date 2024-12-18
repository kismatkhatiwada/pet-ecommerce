<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Pet Pal</title>
    <style>
        body {
            background-image: url('photos/background.webp'); 
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: flex-start; 
            justify-content: flex-start; 
            height: 100vh;
            padding-top: 50px; 
            padding-left: 50px; 
        }

        .container {
            position: relative;
            top: 150px;
            left: -430px;
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            background-color: white;
        }

        h1 {
            font-size: 50px;
            color:white;
        }

        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }

        .login-button {
            padding: 10px 20px;
            margin: 0 10px;
            font-size: 16px;
            text-decoration: none;
            color: #fff;
            background-color: #4caf50;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .login-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Welcome to Pet Pal</h1>
    <div class="container">
        <div class="button-container">
            <a href="customer/customer_login.php" class="login-button">Login as Customer</a>
        </div>
    </div>
</body>
</html>
