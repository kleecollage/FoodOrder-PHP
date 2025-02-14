<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>
        <br /> <br />
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset ($_SESSION['add']);
        }
        if (isset($_SESSION['delelte'])) {
            echo $_SESSION['delelte'];
            unset ($_SESSION['delelte']);
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset ($_SESSION['upload']);
        }
        if (isset($_SESSION['unauthorized'])) {
            echo $_SESSION['unauthorized'];
            unset ($_SESSION['unauthorized']);
        }
        ?>
        <br /> <br />
        <!--    BUTTON TO ADD ADMIN    -->
        <a href="<?php echo SITE_URL  ?>admin/add-food.php" class="btn-primary">Add Food</a>
        <br /><br /><br />
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            <tr>
                <?php
                // Create Query to get all the data from tbl_food
                $sql = "SELECT * FROM tbl_food";
                $res = mysqli_query($conn, $sql); // Execute Query
                // Count rows to check whether are records or not
                $count = mysqli_num_rows($res);
                if ($count > 0) {
                    // We have food
                    while ($row = mysqli_fetch_assoc($res)) {
                        // Get the food details
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                        ?>
                            <td><?php echo $id; ?></td>
                            <td><?php echo $title; ?></td>
                            <td><?php echo $price; ?></td>
                            <td>
                                <?php
                                // Check if we have image or not
                                if($image_name == "")
                                {
                                    // Not image provided // Display message
                                    echo "<div class='error'>Image Not Provided</div>";
                                }
                                else
                                {
                                // We have image // Display image
                                ?>
                                    <img src="<?php echo SITE_URL; ?>images/food/<?php echo $image_name; ?>"
                                         alt="Food Image" width="150px" />
                                <?php
                                }
                                ?>
                            </td>
                            <td><?php echo $featured; ?></td>
                            <td><?php echo $active; ?></td>
                            <td>
                                <a href="#" class="btn-secondary">Update</a>
                                <a href="<?php echo SITE_URL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete</a>
                            </td>
                        <?php
                    }
                } else {
                    // No food added on DB
                    echo "<tr><td colspan='7' class='error'>Food Not Added Yet</td></tr>";
                }
                ?>
            </tr>
        </table>
    </div>
</div>

<?php include('./partials/footer.php') ?>