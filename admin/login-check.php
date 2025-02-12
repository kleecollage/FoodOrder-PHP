<?php
// AUTHORIZATION - Access Control
// // Check if user logged or not
if (!isset($_SESSION['user'])) {
    // User not logged
    // Redirect to login page with message
    $_SESSION['no-login-msg'] = "<div class='error text-center'>Please login to access Admin Panel</div>";
    // Redirect to login page
    header('Location:'. SITE_URL .'admin/login.php');
}