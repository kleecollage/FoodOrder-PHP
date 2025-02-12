<?php
// Include constants php file
include ('../config/constants.php');

// 1.  Get ID of admin to delete
$id = $_GET['id'];

// 2. Create SQL Query to Delete Admin
$sql = "DELETE FROM tbl_admin WHERE id=$id";
// Execute Query
$res = mysqli_query($conn, $sql);

// 3. Redirect to Manage Admin page with message (success/error)
// Check whether the query executed successfully or not
if ($res == TRUE) {
    // OK Admin deleted // echo "Admin Deleted"; //
    // Create Session variable to display message
    $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";
    // Redirect to manage-admin page
    header('location:'.SITE_URL.'admin/manage-admin.php');
} else {
    // Failed on delete admin // echo "Failed at delete admin"; //
    // Create Session variable to display message
    $_SESSION['delete'] = "<div class='error'>Failed To Delete Admin. Try Again Later<div>";
    // Redirect to manage-admin page
    header('location:'.SITE_URL.'admin/manage-admin.php');
}