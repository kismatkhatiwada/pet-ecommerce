<?php
require('../connection.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user_id']);
?>
<div id="header">
    <a href="#"><i class="fa-solid fa-paw"></i></a>
    <nav>
        <ul>
            <li><a href="">Home</a></li>
            <li><a href="../customer/customer_about.php">About</a></li>
            <li><a href="../customer/customer_contact.php">Contact</a></li>
            <?php if (!$isLoggedIn) : ?>
                <li><a href="../customer/customer_login.php">Login</a></li>
            <?php else : ?>
                <li><a href="../customer/customer_logout.php">Logout</a></li>
            <?php endif; ?>
            <a href="../customer/customer_login.php" id="cart-icon" class="icon">
                <i class="fas fa-shopping-cart"></i> 
                <span id="cart-badge" class="badge"></span>
            </a>
        </ul>
    </nav>
</div>
