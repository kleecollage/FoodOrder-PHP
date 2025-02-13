<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br /> <br />
        <?php
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset ($_SESSION['upload']);
        }
        ?>
        <br /> <br />
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" id="title" placeholder="Title of the food" /></td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" id="description" cols="30" rows="10"
                                  placeholder="Description of the food"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td><input type="number" step="any" name="price" id="price" placeholder="Price of the food"></td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td><input type="file" name="image" id="image"></td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category" id="category">
                            <?php
                            // PHP to display categories form DB
                            // 1. Create SQL to get all active categories from D
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                            // Executing quey
                            $res = mysqli_query($conn, $sql);
                            // Check Rows to check categories available
                            $count = mysqli_num_rows($res);
                            // 2. Display  on Dropdown
                            if ($count > 0) {
                                // We have categories
                                while ($row = mysqli_fetch_assoc($res)) {
                                    // get category detail
                                    $id = $row['id'];
                                    $title = $row['title'];
                            ?>
                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                            <?php
                                }
                            }
                            else {
                                // we dont have categories
                            ?>
                                <option value="0">No category Found</option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="Featured" id="Featured">Yes
                        <input type="radio" name="Featured" id="Featured">No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="Active" id="Active">Yes
                        <input type="radio" name="Active" id="Active">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Add Fodd" name="submit" id="submit" class="btn-secondary" />
                    </td>
                </tr>
            </table>
        </form>
        <?php
        // Check whether the button is clicked or not
        if(isset($_POST['submit'])){
            // echo 'Clicked';
            // 1. Get the data from form
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            // Check whether the radio btn was clicked or not
            if (isset($_POST['featured'])) $featured = $_POST['featured'];
            else $featured = "No"; // Default value
            // Check whether the radio btn was clicked or not
            if (isset($_POST['active'])) $active = $_POST['active'];
            else $active = "No"; // Default value

            // 2.  Upload image (if selected)
            // Check if image is selected
            if(isset($_FILES['image']['name'])) {
                // Get the image details
                $image_name = $_FILES['image']['name'];
                // Upload only in case the image is selected
                if ( $image_name != "" ) {
                    // image is selected
                    // A. Rename the image
                    // get extension (.jpg, .png, .gif, etc.)
                    $ext_img = explode('.', $image_name);
                    $ext = end($ext_img);
                    // Create new name for image
                    $image_name = "Food-Name-".uniqid().".".$ext;
                    // B. Upload Image
                    $src = $_FILES['image']['tmp_name']; // Get source path (current location)
                    $dst = "../images/food/". $image_name; // Destination path
                    // Upload image
                    $upload = move_uploaded_file($src, $dst);
                    // Check whether is loaded or not
                    if ($upload == FALSE) {
                        // Failed to upload
                        $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                        // Redirect to add-food page
                        header('Location:'. SITE_URL .'admin/add-food.php');
                        // Stop the process
                        die();
                    }
                }
            } else {
                $image_name = ""; // Default value
            }
            // 3. Insert into Database
            // Create SQL Query to Add food in DB
            //!! Numerical values dont have single quotes !!//
            $sql2 = "INSERT INTO tbl_food( 
                     title, 
                     description, 
                     price, 
                     image_name, 
                     category_id, 
                     featured, 
                     active ) VALUES (
                          '$title',
                          '$description',
                          $price,
                          '$image_name',
                          $category,
                          '$featured',
                          '$active'); ";
            // Execute the query
            $res2 = mysqli_query($conn, $sql2);
            // 4. Redirect to manage-food.php
            // Check if data where inserted or not
            if ($res2 == TRUE) {
                // OK. Data inserted
                $_SESSION['add'] = "<div class='success'>Food Added Successfully!</div>";
                header('Location:'. SITE_URL .'admin/manage-food.php');
            } else {
                // Failed on insert data
                $_SESSION['add'] = "<div class='error'>Error Adding Food. Try Again Later</div>";
                header('Location:'. SITE_URL .'admin/manage-food.php');
            }
        }
        ?>
    </div>
</div>
<?php include('partials/footer.php'); ?>