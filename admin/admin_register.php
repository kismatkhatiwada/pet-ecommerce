<?php
require_once "../connection.php";

if (!empty($_POST)) { 
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Server-side validation for password length
    if (strlen($password) < 8) {
        echo "Password must be at least 8 characters long.";
    } else {
        // Encrypt password
        $password = md5($password);

        $sql = "INSERT INTO admin (email, password) VALUES ('$email', '$password')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "Registration successful";
        } else {
            echo "Error in registration: " . mysqli_error($conn);
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
    <link rel="stylesheet" href="../admin/css/admin_register.css">
</head>
<body>
    <div class="register-container">
        <h2>Register</h2>
        <form action="" method="post">
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <!-- HTML validation for password length -->
                <input type="password" name="password" minlength="8" required>
                <small>Password must be at least 8 characters long.</small>
            </div>
            <button type="submit">Register</button>
            <div class="link-container">
                <span>Already have an account?</span>
                <a href="index.php">Login here</a>
            </div>
        </form>
    </div>
</body>
</html>
