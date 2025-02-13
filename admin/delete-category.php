<?php
include ('../config/constants.php');
// Check if ID image and image_name are set
if (isset($_GET['id']) AND isset($_GET['image_name'])) {
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];
    // Remove the physical image file if is available
    if ($image_name != "") {
        // Image available
        $path = "../images/category/".$image_name;
        // Remove the image
        $remove = unlink($path);
        if ($remove == FALSE) {
            // Removed failed // Error message
            $_SESSION['remove'] =  "<div>Failed to remove category image</div>";
            // Redirect
            header('Location:'. SITE_URL .'admin/manage-category.php');
            // Stop process
            die();
        }
    }
    // Delete data from DB
    $sql = "DELETE FROM tbl_category WHERE id='$id'";
    // Execute query
    $res = mysqli_query($conn, $sql);
    // Check Deletion OK
    if ($res == TRUE) {
        // OK Delete, redirect
        $_SESSION ['delete'] = "<div class='success'>Category Deleted Successfully</div>";
        header('Location:'. SITE_URL .'admin/manage-category.php');
    } else {
        // Faile, redirect
        $_SESSION ['delete'] = "<div class='error'>Failed To Delete Category </div>";
        header('Location:'. SITE_URL .'admin/manage-category.php');
    }
    // Redirect to manage-category page
} else {
    // Redirect to manage-category page
    header('Location:'. SITE_URL .'admin/manage-category.php');
}
