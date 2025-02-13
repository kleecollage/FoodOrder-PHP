<?php include('./partials/menu.php'); ?>
<!--  MAIN CONTENT SECTION START  -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>
        <br /> <br />
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>
        <br /> <br />
        <!--    BUTTON TO ADD ADMIN    -->
        <a href="<?php echo SITE_URL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
        <br /> <br /> <br />
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            <?php
            // Query to fetch all data
            $sql = "SELECT * FROM tbl_category";
            // Execute Query
            $res = mysqli_query($conn, $sql);
            // Count Rows
            $count = mysqli_num_rows($res);
            if ($count > 0) {
                // Display data
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
            ?>
                <tr>
                    <td><?php echo $id; ?></td>
                    <td><?php echo $title; ?></td>
                    <td>
                        <?php
                        // Check if is a name image available
                        if ($image_name!="") {
                            // Display Image
                        ?>
                            <img src="<?php echo SITE_URL; ?>images/category/<?php echo $image_name; ?>"
                                 alt="Image" width="150" />
                        <?php
                        } else {
                            // Display message
                            echo "<div class='error'>No Image Provided</div>";
                        }
                        ?>
                    </td>
                    <td><?php echo $featured; ?></td>
                    <td><?php echo $active; ?></td>
                    <td>
                        <a href="#" class="btn-secondary">Update Category</a>
                        <a href="#" class="btn-danger">Delete Category</a>
                    </td>
                </tr>
            <?php
                }
            } else { // Display no data message ?>
                <tr>
                    <td colspan="6"><div class="error">No Category Added</div></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>
<!--  MAIN CONTENT SECTION  END -->
<?php include('partials/footer.php') ?>
