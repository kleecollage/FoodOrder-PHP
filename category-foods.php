<?php include("partials-front/menu.php");
// Check ID
if (isset($_GET['id']))
{
    // Get ID
    $category_id = $_GET['id'];
    $sql = "SELECT title FROM tbl_category WHERE id = $category_id";
    $res = mysqli_query($conn, $sql); // Execute query
    $row = mysqli_fetch_assoc($res); // get the value from db
    $category_title = $row['title']; // get the title
}
else
{
    // Category ID not found
    header('Location:'. SITE_URL); // redirect to index
}
?>
<!-- Food Search Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title ?>"</a></h2>
    </div>
</section>
<!-- Food Search Section Ends Here -->
<!-- Food Menu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>
        <?php
        // Crete SQL Query to get foods from selected category
        $sql2 = "SELECT * FROM tbl_food WHERE category_id = $category_id";
        $res2 = mysqli_query($conn, $sql2); // Execute query
        $count2 = mysqli_num_rows($res2); // count rows
        if ($count2 > 0)
        {
            // Display foods
            while ($row2 = mysqli_fetch_assoc($res2))
            {
                // Get food details
                $id = $row2['id'];
                $title = $row2['title'];
                $description = $row2['description'];
                $price = $row2['price'];
                $image_name = $row2['image_name'];
        ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                        if ($image_name == "")
                        {
                            // Image Not Available
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
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price"><?php echo $price; ?></p>
                        <p class="food-detail"><?php echo $description; ?></p>
                        <br />
                        <a href="<?php echo SITE_URL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now!</a>
                    </div>
                </div>
        <?php
            }
        }
        else
        {
            // Food Not Available
            echo "<div class='error text-center'>Food Not Added Yet</div>";
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