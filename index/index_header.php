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
            <li><a href="../index/index_about.php">About</a></li>
            <li><a href="../index/index_contact.php">Contact</a></li>
            <li><a href="../customer/customer_login.php">Login</a></li>
            
            <a href="../customer/customer_login.php" id="cart-icon" class="icon">
                <i class="fas fa-shopping-cart"></i> 
                <span id="cart-badge" class="badge"></span>
            </a>
        </ul>
    </nav>
</div>