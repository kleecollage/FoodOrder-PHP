<?php include ("partials-front/menu.php"); ?>
<!-- Food Search Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        <form action="<?php echo SITE_URL; ?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>
    </div>
</section>
<!-- Food Search Section Ends Here -->

<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <?php
        // Create SQL Query to display categories from DB
        $sql = "SELECT * FROM tbl_category WHERE active = 'Yes' AND featured = 'Yes' LIMIT 5";
        $res = mysqli_query($conn, $sql); // execute query
        $count = mysqli_num_rows($res); // check records
        if ($count > 0)
        {
            // Data available
            while ($row = mysqli_fetch_assoc($res))
            {
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];
        ?>
                <a href="<?php echo SITE_URL; ?>category-foods.php?id=<?php echo $id; ?>">
                    <div class="box-3 float-container">
                        <?php
                        // Check image
                        if ($image_name == "")
                        {
                            // Image NOT Available
                            echo "<div>Image Not Available</div>"; // No image
                        }
                        else {
                            // Image Available
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
        else
        {
            // No data available
            echo "<div class='error'>Categories not Added</div>";
        }
        ?>
        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->
<!-- Food Menu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>
        <?php
        // Getting food from Db (active and featured)
        // SQL Query
        $sql2 = "SELECT * FROM tbl_food WHERE active = 'Yes' && featured = 'Yes' Limit 6";
        $res2 = mysqli_query($conn, $sql2); // Execute Query
        $count = mysqli_num_rows($res2);
        if ($count > 0)
        {
            // Data available
            while ($row2 = mysqli_fetch_assoc($res2)) {
                // Get food details
                $id = $row2['id'];
                $title = $row2['title'];
                $price = $row2['price'];
                $description = $row2['description'];
                $image_name = $row2['image_name'];
        ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                        // Check image
                        if ($image_name == "")
                        {
                            // Image NOT available
                            echo "<div class='error'>Image Not Available</div>";
                        }
                        else
                        {
                            // Display Image
                        ?>
                            <img src="<?php echo SITE_URL; ?>images/food/<?php echo $image_name; ?>"
                                 alt="Food Image" class="img-responsive img-curve">
                        <?php
                        }
                        ?>
                    </div>
                    <div class="food-menu-desc">
                        <h4><?php echo $title ?></h4>
                        <p class="food-price"><?php echo $price ?></p>
                        <p class="food-detail"><?php echo $description ?></p>
                        <br />
                        <a href="<?php echo SITE_URL; ?>order.php?food_id=<?php echo $id ?>" class="btn btn-primary">Order Now!</a>
                    </div>
                </div>
        <?php
            }
        }
        else {
            // Data NOT available
            echo "<div class='error'>Food Not Available</div>";
        }

        ?>
        <div class="clearfix"></div>
    </div>

    <p class="text-center">
        <a href="<?php echo SITE_URL; ?>foods.php">See All Foods</a>
    </p>
</section>
<!-- Food Menu Section Ends Here -->

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
<?php include ("partials-front/footer.php"); ?>