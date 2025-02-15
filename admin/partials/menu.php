<?php
    include('../config/constants.php');
    include('login-check.php');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Food Order Website - Home Page</title>
</head>
<body>
<!--  MENU SECTION START  -->
<div class="menu text-center">
    <div class="wrapper">
        <ul>
            <li><a href="<?php echo SITE_URL; ?>admin/index.php">Home</a></li>
            <li><a href="<?php echo SITE_URL; ?>admin/manage-admin.php">Admin</a></li>
            <li><a href="<?php echo SITE_URL; ?>admin/manage-category.php">Category</a></li>
            <li><a href="<?php echo SITE_URL; ?>admin/manage-food.php">Food</a></li>
            <li><a href="<?php echo SITE_URL; ?>admin/manage-order.php">Order</a></li>
            <li><a href="<?php echo SITE_URL; ?>admin/logout.php">Logout</a></li>
        </ul>
    </div>
</div>
<!--  MENU SECTION END  -->