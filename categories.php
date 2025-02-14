<?php include("partials-front/menu.php"); ?>
<!-- Categories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>
        <?php
        // Display all the active categories
        $sql = "SELECT * FROM tbl_category WHERE active = 'Yes' "; // SQL Query
        $res = mysqli_query($conn, $sql); // execute query
        $count = mysqli_num_rows($res); // records available
        if ($count > 0)
        {
            // Data available
            while ($row = mysqli_fetch_assoc($res)) {
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];
        ?>
                <a href="<?php echo SITE_URL; ?>category-foods.php/<?php echo $id; ?>" >
                    <div class="box-3 float-container">
                        <?php
                        if ($image_name == "")
                        {
                            // Image not available
                            echo "<div class='error'>Image Not Found</div>";
                        }
                        else {
                            // Image available
                        ?>
                            <img src="<?php echo SITE_URL; ?>images/category/<?php echo $image_name; ?>"
                                 alt="Food Category" class="img-responsive img-curve" />
                        <?php
                        }
                        ?>
                        <h3 class="float-text text-white"><?php echo $title; ?></h3>
                    </div>
                </a>
        <?php
            }
        }
        else {
            // Data not available
            echo "<div class='error'>Categories Not Available</div>";
        }
        ?>
        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->
<!-- social Section Starts Here -->
<section class="social">
    <div class="container text-center">
        <ul>
            <li>
                <a href="#"><img src="https://img.icons8.com/fluent/50/000000/facebook-new.png"/></a>
            </li>
            <li>
                <a href="#"><img src="https://img.icons8.com/fluent/48/000000/instagram-new.png"/></a>
            </li>
            <li>
                <a href="#"><img src="https://img.icons8.com/fluent/48/000000/twitter.png"/></a>
            </li>
        </ul>
    </div>
</section>
<!-- social Section Ends Here -->
<?php include("partials-front/footer.php"); ?>