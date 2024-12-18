
<?php
session_start();

require_once "../connection.php";

if (!empty($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password']; // Note: Don't apply md5 hashing here yet

    // Validation
    $errors = [];
    if (empty($email)) {
        $errors['email'] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format";
    }

    if (empty($password)) {
        $errors['password'] = "Password is required";
    }elseif(strlen($password)<8){
        $errors['password']="Password must be more than 8 characters";
    }

    if (empty($errors)) {
        // Sanitize input
        $email = mysqli_real_escape_string($conn, $email);

        // Hash the password
        $password = md5($password);

        // Proceed with the SQL query
        $sql = "SELECT * FROM customer WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($conn, $sql);
        $num_of_rows = mysqli_num_rows($result);

        if ($num_of_rows > 0) {
            // User authentication successful
            $user = mysqli_fetch_assoc($result);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['users_name'] = $user['name'];
            $_SESSION['is_login'] = true;
            header('Location:customer_index.php');
            exit;
        } else {
            $_SESSION['error'] = "Invalid email or password";
        }
    } else {
        // Set session errors
        $_SESSION['validation_errors'] = $errors;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="../customer/css/customer_login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        <?php if(isset($_SESSION['error'])): ?>
            <h2><?= $_SESSION['error']; ?></h2>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        <form action="" method="post">
        <div class="input-container">
        <label for="email" class="icon"><i class="fas fa-user"></i></label>
        <input type="text" id="email" name="email" placeholder="Email" value="<?php echo isset($_POST['email'])?($_POST['email']) : ''; ?>">
        <?php if(isset($_SESSION['validation_errors']['email'])): ?>
            <span class="error"><?= $_SESSION['validation_errors']['email']; ?></span>
        <?php endif; ?>
            </div>

            <div class="input-container">
                <label for="password" class="icon"><i class="fas fa-lock"></i></label>
                <input type="password" id="password" name="password" placeholder="Password" value="<?php echo isset($_POST['password'])?($_POST['password']) : ''; ?>">
                <?php if(isset($_SESSION['validation_errors']['password'])): ?>
                    <span class="error"><?= $_SESSION['validation_errors']['password'];unset($_SESSION['validation_errors']['password']); ?></span>
                <?php endif; ?>
            </div>

            <button type="submit">Login</button>
        </form>
        <a href="customer_register.php" class="signup">Don't have an account? Sign up here</a>
    </div>
</body>
</html>
