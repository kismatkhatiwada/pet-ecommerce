<?php
require_once "../connection.php";
session_start();

if(!empty($_POST)){
    $errors = []; // Initialize an array to store validation errors

    // Validate email
    if(empty($_POST['email'])) {
        $errors['email'] = "Email is required";
    } elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format";
    }

    // Validate password
    if(empty($_POST['password'])) {
        $errors['password'] = "Password is required";
    }

    // If there are no validation errors, proceed with login
    if(empty($errors)) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = md5($_POST['password']); // Not recommended, consider using stronger hashing algorithms
        
        $sql = "SELECT * FROM admin WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($conn, $sql);
        $num_of_rows = mysqli_num_rows($result);

        if($num_of_rows > 0) {
            $admin = mysqli_fetch_assoc($result);
            $_SESSION['admins_name'] = $admin['id'];
            $_SESSION['is_login'] = true;
            header("Location: admin_display.php");
            exit; // Terminate script execution after redirection
        } else {
            $_SESSION['error'] = "Invalid email or password";
        }
    } else {
        // Set session errors for displaying validation errors
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
    <link rel="stylesheet" href="../admin/css/admin_login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script>
        <?php if(isset($_SESSION['error'])): ?>
            alert("<?php echo $_SESSION['error']; ?>");
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
    </script>
</head>
<body>
    <?php if(isset($_SESSION['error'])): ?>
        <h2><?= $_SESSION['error']; ?></h2>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
    <div class="login-container">
        <h1>Login</h1>
            <form action=""method="post">
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

            <a href="index.php"><button>Login</button></a>
        </form>
        <a href="admin_register.php" class="signup">Don't have an account? Sign up here</a>
    </div>
</body>
</html>

