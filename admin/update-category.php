<?php include ('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br /> <br />
        <?php
        // Check ID set
        if (isset($_GET['id']))
        {
            // OK. Get details
            $id = $_GET['id'];
            // Create SQL Query to get all details
            $sql = "SELECT * FROM tbl_category WHERE id='$id'";
            // Execute query
            $res = mysqli_query($conn, $sql);
            // Count rows to check
            $count = mysqli_num_rows($res);
            if($count == 1)
            {
                // OK. Get all data
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
            }
            else
            {
                // redirect
                $_SESSION['no-category-found'] ="<div class='error'>Category Not Found</div>";
                header('Location:'.SITE_URL.'admin/manage-category.php');
            }
        }
        else header('Location:'.SITE_URL.'admin/manage-category.php'); // redirect
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" id="title" value="<?php echo $title ?>" placeholder="Enter category title">
                    </td>
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                        if ($current_image != "") {
                            // Display image
                        ?>
                            <img src="<?php echo SITE_URL; ?>/images/category/<?php echo $current_image; ?>" alt="Image Category" width="350">
                        <?php
                        } else {
                            // Display Message
                            echo "<div class='error'>Image not added</div>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image" id="image" >
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured=="Yes"){ echo "checked"; } ?> type="radio" name="featured" id="featured" value="Yes">Yes
                        <input <?php if($featured=="No"){ echo "checked"; } ?> type="radio" name="featured" id="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active=="Yes"){ echo "checked"; } ?> type="radio" name="active" id="active" value="Yes">Yes
                        <input <?php if($active=="No"){ echo "checked"; } ?> type="radio" name="active" id="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>" readonly>
                        <input type="hidden" name="id" value="<?php echo $id; ?>" readonly>
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        if (isset($_POST['submit']))
        {
            // echo 'Clicked';
            // 1. Get values from form
            $id = $_POST['id'];
            $title = mysqli_real_escape_string($conn, $_POST['title']);
            $current_image = $_POST['current_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            // 2. Updating new image (if selected)
            if (isset($_FILES['image']['name']))
            {
                // Get image details
                $image_name = $_FILES['image']['name'];
                if ($image_name != "") {
                    // Image available // A. Upload Image
                    // Rename image // Get extension
                    $img_ext = explode('.', $image_name);
                    $ext = end($img_ext);
                    $image_name = "Food_Category" . uniqid() . '.' . $ext;
                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/category/" . $image_name;
                    // Finally Upload the image
                    $upload = move_uploaded_file($source_path, $destination_path);
                    // Check whether the image is uploaded or not
                    // If not, stop the process and redirect with error message
                    if ($upload == FALSE)
                    {
                        // Set message
                        $_SESSION['upload'] = "<div class='error'>Failed on upload image</div>";
                        // Redirect to add-category page
                        header('Location:' . SITE_URL . 'admin/manage-category.php');
                        // Stop the process
                        die();
                    }
                    // B. Remove Current Image (if available)
                    if ($current_image != "")
                    {
                        $remove_path = "../images/category/" . $current_image;
                        $remove = unlink($remove_path);
                        // Check if image was removed
                        if ($remove == false)
                        {
                            // Failed to remove image
                            $_SESSION['failed-remove'] = "<div class='error'>Failed Removing The Image</div>";
                            header('Location:' . SITE_URL . 'admin/manage-category.php');
                            // Stop the process
                            die();
                        }
                    }
                }
                else $image_name = $current_image;
            }
            else $image_name = $current_image;

            // 3. Update DB
            $sql2 = "UPDATE tbl_category SET
                        title = '$title',
                        image_name = '$image_name', 
                        featured = '$featured',
                        active = '$active'
                        WHERE id = '$id'
                    ";
            // Execute Query
            $res2 = mysqli_query($conn, $sql2);

            // 4. Redirect
            // Check if query executed
            if ($res2 == TRUE)
            {
                // OK. Category updated
                $_SESSION['update'] = "<div class='success'>Category Updated Successfully</div>";
                header('Location:' . SITE_URL . 'admin/manage-category.php');
            }
            else
            {
                // Failed to update category
                $_SESSION['update'] = "<div class='error'>Failed to Update Category</div>";
                header('Location:' . SITE_URL . 'admin/manage-category.php');
            }
        }
        ?>
    </div>
</div>

<?php include ('partials/footer.php'); ?>