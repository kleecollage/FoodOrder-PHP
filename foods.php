<?php include("partials-front/menu.php"); ?>
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
    <!-- Food Menu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
            // Display active foods
            $sql = "SELECT * FROM tbl_food WHERE active = 'Yes'";
            $res = mysqli_query($conn, $sql); // Execute query
            $count = mysqli_num_rows($res); // count rows
            if ($count > 0)
            {
                // Food available
                while ($row = mysqli_fetch_assoc($res))
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
                            <img src="<?php echo SITE_URL; ?>images/food/<?php echo $image_name; ?>"
                                 alt="Food Image" class="img-responsive img-curve">
                        </div>
                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price"><?php echo $price; ?></p>
                            <p class="food-detail"><?php echo $description; ?></p>
                            <br />
                            <a href="<?php echo SITE_URL; ?>order.php/<?php echo $id; ?>" class="btn btn-primary">Order Now!</a>
                        </div>
                    </div>
            <?php
                }
            }
            else
            {
                // Food NOT available
                echo "<div class='error'>Food Not Available</div>";
            }
            ?>
            <div class="clearfix"></div>
        </div>
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
<?php include("partials-front/footer.php"); ?>