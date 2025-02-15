<?php include('partials/menu.php') ?>
<?php
if (isset($_GET['id']))
{
    // Get all details
    $id = $_GET['id'];
    // SQL Query to get the selected food
    $sql2 = "SELECT * FROM tbl_food WHERE id = $id";
    $res2 = mysqli_query($conn, $sql2); // execute query
    // Get the value based on query executed
    $row2 = mysqli_fetch_assoc($res2);
    $title = $row2['title'];
    $description =  $row2['description'];
    $price = $row2['price'];
    $current_image = $row2['image_name'];
    $current_category = $row2['category_id'];
    $featured = $row2['featured'];
    $active =  $row2['active'];
}
else
{
    // Redirect to manage-food page
    header('Location:'. SITE_URL .'admin/manage-food.php');
}
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br /> <br />
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" placeholder="Enter the Food Title" value="<?php echo $title; ?>"></td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td><textarea name="description" cols="30" rows="10"><?php echo $description ?></textarea></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><input type="number" step="any" name="price" value="<?php echo $price ?>"></td>
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                        if ($current_image == "" )
                        {
                            // Image not available
                            echo "<div class='error'>Image Not Added</div>";
                        }
                        else // Image available
                        {
                        ?>
                            <img src="<?php echo SITE_URL ?>images/food/<?php echo $current_image; ?>" alt="Food_Image" width="200">
                        <?php
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Select New Image: </td>
                    <td><input type="file" name="image" id="image"></td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category" id="category">
                            <?php
                                $sql = "SELECT * FROM tbl_category";
                                $res = mysqli_query($conn, $sql);
                                $count = (mysqli_num_rows($res));
                                if ($count > 0)
                                {
                                    while( $row = mysqli_fetch_assoc($res) ) {
                                        $category_id = $row['id'];
                                        $category_title = $row['title']
                            ?>
                                        <option <?php if($current_category == $category_id){ echo "selected"; } ?> value="<?php echo $category_id; ?>">
                                            <?php echo $category_title; ?>
                                        </option>
                            <?php
                                    }
                                }
                                else
                                {
                                    echo "<option value='0'>Category not Available</option>";
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" <?php if ($featured=='Yes') { echo 'checked'; } ?> name="featured" value="Yes">Yes
                        <input type="radio" <?php if ($featured=='No') { echo 'checked'; } ?> name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" <?php if ($active=='Yes') { echo 'checked'; } ?> name="active" value="Yes">Yes
                        <input type="radio" <?php if ($active=='No') { echo 'checked'; } ?> name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <input type="hidden" name="id" value="<?php echo $id; ?>" readonly>
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>" readonly>
                    <td><input type="submit" name="submit" value="Update Food" class="btn-secondary"></td>
                </tr>
            </table>
        </form>
        <?php
        if (isset($_POST['submit'])) {
            // 1. Get form data details
            $id = $_POST['id'];
            $title = mysqli_real_escape_string($conn, $_POST['title']);
            $description = mysqli_real_escape_string($conn, $_POST['description']);
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category = $_POST['category'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];
            // 2. Upload the image (if selected)
            // Check the upload button
            if (isset($_FILES['image']['name']))
            {
                // Upload button clicked
                $image_name = $_FILES['image']['name']; // New Image Name
                // Check whether the file is available or not
                if ($image_name != "")
                {
                    // Image available
                    // A. Uploading New Image
                    $img_ext = explode('.', $image_name);
                    $ext = end($img_ext);
                    $image_name = "Food_Name". uniqid(). '.' . $ext; // Rename image
                    $src_path = $_FILES['image']['tmp_name']; // Get the source path (current path)
                    $dest_path = "../images/food/". $image_name; // Set destination path
                    // upload the image
                    $upload = move_uploaded_file($src_path, $dest_path);
                    // Check whether the image was uploaded
                    if ($upload == FALSE)
                    {
                        // Failed to uploadimages/
                        $_SESSION['upload'] = "<div class='error'>Failed to Upload the Image</div>";
                        header('Location:'. SITE_URL .'admin/manage-food.php'); // redirect
                        die(); // stop the process
                    }
                    // 3. Remove the image if new image is uploaded and current image exists
                    // B. Remove current image (if available)
                    if ($current_image != "") {
                        // image available
                        $remove_path = "../images/food/". $current_image;
                        $remove = unlink($remove_path); // remove current image
                        // Check if current_image was removed
                        if ($remove == FALSE) {
                            // Failed to remove current image
                            $_SESSION['remove-failed'] = "<div class='error'>Oops. Failed to remove the current image. Try again later</div>";
                            header('Location:'. SITE_URL .'admin/manage-food.php'); // redirect
                            die(); // stop the process
                        }
                    }
                }
                else $image_name = $current_image;
            }
            // 4. Update food in db
            $sql3 = "UPDATE tbl_food SET
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
                    WHERE id=$id";
            // Execute the query
            $res3 = mysqli_query($conn, $sql3);
            // 5. Redirect to manage-food page
            if ($res3 == TRUE)
            {
                // OK. Query executed
                $_SESSION['update'] = "<div class='success'>Food Updated Successfully!</div>";
                header('Location:'. SITE_URL .'admin/manage-food.php');
            }
            else
            {
                // Failed to execute query
                $_SESSION['update'] = "<div class='error'>Oops. Failed to update food. Try again later</div>";
                header('Location:'. SITE_URL .'admin/manage-food.php');
            }
        }
        ?>
    </div>
</div>

<?php include('partials/footer.php') ?>
