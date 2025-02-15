<?php include ('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br /> <br />
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <br /> <br />
        <!--   Add Category Form Starts     -->
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" id="title" value="" placeholder="Title" required></td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image" id="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" id="featured" value="Yes"> Yes
                        <input type="radio" name="featured" id="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active</td>
                    <td>
                        <input type="radio" name="active" id="active" value="Yes">Yes
                        <input type="radio" name="active" id="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <!--   Add Category Form Ends     -->
        <?php
        // Check if submit btn was clicked
        if (isset($_POST['submit'])) {
            // 1. Get the value from Category form
            $title = mysqli_real_escape_string($conn, $_POST['title']);
            // For Radio input, we need to check if is selected or not
            if (isset($_POST['featured'])) $featured = $_POST['featured']; // Get the value from form
            else $featured = "No"; // Set default value

            if (isset($_POST['active'])) $active = $_POST['active'];
            else $active = "No";
            // Check selected image and set the value for image name
            if (isset($_FILES['image']['name'])) {
                // Upload the image
                // To upload we need: image name, source path and destination path
                $image_name = $_FILES['image']['name'];
                // Upload image only if image is selected
                if ($image_name != "") {
                    // Auto rename our image
                    // Get the extention (.jpg, .png, .gif, etc)
                    $img_ext = explode('.', $image_name);
                    $ext = end($img_ext);
                    // $image_name = "Food_Category".rand(000, 999).'.'.$ext;
                    $image_name = "Food_Category".uniqid().'.'.$ext;
                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/category/". $image_name;
                    // Finally Upload the image
                    $upload = move_uploaded_file($source_path, $destination_path);
                    // Check whether the image is uploaded or not
                    // If not, stop the process and redirect with error message
                    if ($upload == FALSE) {
                        // Set message
                        $_SESSION['upload'] = "<div class='error'>Failed on upload image</div>";
                        // Redirect to add-category page
                        header('Location:'. SITE_URL .'admin/add-category.php');
                        // Stop the process
                        die();
                    }
                }
            } else {
                // Set the image value as blank
                $image_name = "";
            }

            // 2. Create SQL Query to insert Category in Db
            $sql = "INSERT INTO tbl_category (
                          title, 
                          image_name, 
                          featured, 
                          active
                          ) VALUES (
                            '$title', 
                            '$image_name', 
                            '$featured', 
                            '$active'
                    )";
            // 3. Execute the Query and save it on Db
            $res = mysqli_query($conn, $sql);
            // 4. Check if Query executed OK
            if ($res == TRUE) {
                // OK. Query Executed
                $_SESSION['add'] = "<div class='success'>Category Added Success</div>";
                // Redirect to manage-category page
                header('Location:'. SITE_URL .'admin/manage-category.php');
            } else {
                // Query Failed Execution
                $_SESSION['add'] = "<div class='error'>Failed to Add Category</div>";
                // Redirect to manage-category page
                header('Location:'. SITE_URL .'admin/add-category.php');
            }
        }
        ?>
    </div>
</div>

<?php include ('partials/footer.php'); ?>
