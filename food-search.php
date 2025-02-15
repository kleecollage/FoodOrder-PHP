<?php include("partials-front/menu.php"); ?>
<!-- Food Search Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        <?php
        // Get the Search Keyword
        $search = $_POST['search'];
        ?>
        <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search ?>"</a></h2>
    </div>
</section>
<!-- Food Search Section Ends Here -->
<!-- Food Menu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>
        <?php
        // SQL Query to get food based on search keywords
        $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
        $res = mysqli_query($conn, $sql); // Execute the query
        $count = mysqli_num_rows($res); // Count Rows
        if ($count > 0)
        {
            // Data found
            while($row = mysqli_fetch_assoc($res))
            {
                // Get food details
                $id = $row['id'];
                $title = $row['title'];
                $description = $row['description'];
                $price = $row['price'];
                $image_name = $row['image_name'];
        ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                        // Check image
                        if ($image_name == "")
                        {
                            // Not image available
                            echo "<div class='error'>No Image Found</div>";
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
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price"><?php echo $price; ?></p>
                        <p class="food-detail"><?php echo $description; ?></p>
                        <br />
                        <a href="<?php echo SITE_URL; ?>order.php?food_id=<?php echo $id ?>" class="btn btn-primary">Order Now</a>
                    </div>
                </div>
        <?php
            }
        }
        else
        {
            // Data NOT found
            echo "<div class='error'>No Results Match the Search</div>";
        }
        ?>
        <div class="clearfix"></div>
    </div>

</section>
<!-- Food Menu Section Ends Here -->
<!-- Social Section Starts Here -->
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