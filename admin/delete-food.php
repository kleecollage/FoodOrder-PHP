<?php
if (isset($_GET['id']) And isset($_GET['image_name']))
{
    // Include constants
    include ('../config/constants.php');

    // Delete process
    // 1. Get ID and image name
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    // 2. Remove the image (only if exists)
    if ($image_name != "")
    {
        // Get the image path
        $path = "../images/food/".$image_name;
        // Remove image file from folder
         $remove = unlink($path);
         if ($remove == FALSE)
         {
             // Failed to remove image
             $_SESSION['upload'] = "<div class='error'>Failed to remove image</div>";
             // Redirect
             header('Location:'. SITE_URL .'admin/manage.food.php');
             // Stop the process
             die();
         }
    }
    // 3. Delete food from db
    $sql = "DELETE FROM tbl_food WHERE id=$id";
    // Execute query
    $res = mysqli_query($conn, $sql);
    if ($res == TRUE)
    {
        // OK. Food deleted
        $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully</div>";
        header('Location:'. SITE_URL .'admin/manage-food.php');

    } else {
        // Failed sql execution
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Food</div>";
        header('Location:'. SITE_URL .'admin/manage-food.php');
    }

    // 4. Redirect to manage food with session message
}
else
{
    // Redirect to manage-food page
    $_SESSION['unauthorized'] = "<div class='error'>Unauthorized Access</div>";
    header('Location: '. SITE_URL .'admin/manage-food.php');
}
