<?php
require_once "../connection.php";

$successMessage = ''; // Initialize a variable to hold success messages

if (!empty($_POST)) { 
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $phonenumber = $_POST['phonenumber'];

    // Validation
    $errors = [];
    if (empty($name)) {
        $errors['name'] = "Name is required";
    }

    if (empty($email)) {
        $errors['email'] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format";
    }

    if (empty($password)) {
        $errors['password'] = "Password is required";
    } elseif (strlen($password) < 8) {
        $errors['password'] = "Password must be more than 8 characters";
    }

    if (empty($address)) {
        $errors['address'] = "Address is required";
    }

    if (empty($phonenumber)) {
        $errors['phonenumber'] = "Phone number is required";
    } elseif (!preg_match("/^[0-9]{10}$/", $phonenumber)) {
        $errors['phonenumber'] = "Invalid phone number format";
    }

    if (empty($errors)) {
        // Proceed with insertion
        $password = md5($password); // MD5 hash the password
        $sql = "INSERT INTO customer (name, email, password, address, phonenumber) VALUES ('$name', '$email', '$password', '$address', '$phonenumber')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $successMessage = "Registration successful"; // Set success message
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/customer_register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .success {
            color: green;
            margin-top: 10px;
        }
        .error {
            color: red;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Register</h1>
        <form action="" method="post">
            <div class="input-container">
                <label for="name" class="icon"><i class="fas fa-user"></i></label>
                <input type="text" id="name" name="name" placeholder="Name" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
                <?php if (isset($errors['name'])): ?>
                    <span class="error"><?= $errors['name']; ?></span>
                <?php endif; ?>
            </div>
            <div class="input-container">
                <label for="email" class="icon"><i class="fas fa-envelope"></i></label>
                <input type="text" id="email" name="email" placeholder="Email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                <?php if (isset($errors['email'])): ?>
                    <span class="error"><?= $errors['email']; ?></span>
                <?php endif; ?>
            </div>
            <div class="input-container">
                <label for="password" class="icon"><i class="fas fa-lock"></i></label>
                <input type="password" id="password" name="password" placeholder="Password">
                <?php if (isset($errors['password'])): ?>
                    <span class="error"><?= $errors['password']; ?></span>
                <?php endif; ?>
            </div>
            <div class="input-container">
                <label for="address" class="icon"><i class="fa-sharp fa-solid fa-location-dot"></i></label>
                <input type="address" id="address" name="address" placeholder="Address" value="<?= htmlspecialchars($_POST['address'] ?? '') ?>">
                <?php if (isset($errors['address'])): ?>
                    <span class="error"><?= $errors['address']; ?></span>
                <?php endif; ?>
            </div>
            <div class="input-container">
                <label for="phonenumber" class="icon"><i class="fa-solid fa-phone"></i></label>
                <input type="tel" id="phonenumber" name="phonenumber" placeholder="Phonenumber" value="<?= htmlspecialchars($_POST['phonenumber'] ?? '') ?>">
                <?php if (isset($errors['phonenumber'])): ?>
                    <span class="error"><?= $errors['phonenumber']; ?></span>
                <?php endif; ?>
            </div>
            <button type="submit">Register</button>
            <?php if ($successMessage): ?>
                <p class="success"><?= $successMessage; ?></p>
            <?php endif; ?>
            <div class="link-container">
                <span>Already have an account?</span>
                <a href="customer_login.php">Login here</a>
            </div>
        </form>
    </div>
</body>
</html>
