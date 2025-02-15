<?php
include("partials-front/menu.php");
if (isset($_GET['food_id']))
{
    $food_id = $_GET['food_id']; // Get food ID
    // Query to get details from selected food
    $sql = "SELECT * FROM tbl_food WHERE id = $food_id";
    $res = mysqli_query($conn, $sql); // execute query
    $count = mysqli_num_rows($res); // count rows
    if ($count == 1)
    {
        // Food data available
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];
    }
    else
    {
        // Data not found
        $_SESSION['food'] = "<div class='error'></div>";
        header('Location:'. SITE_URL);
    }
}
else
{
    header('Location:'. SITE_URL); // redirect to index
}
?>
    <!-- Food Search Section Starts Here -->
<section class="food-search">
    <div class="container">
        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>
        <form action="" class="order" method="post">
            <fieldset>
                <legend>Selected Food</legend>
                <div class="food-menu-img">
                    <?php
                    // Check image
                    if ($image_name == "")
                    {
                        // No image (display message)
                        echo "<div class='error'>Image Not Available</div>";
                    }
                    else
                    {
                        // Display image
                    ?>
                        <img src="<?php echo SITE_URL; ?>images/food/<?php echo $image_name ?>" alt="Food Image"
                             class="img-responsive img-curve">
                    <?php
                    }
                    ?>
                </div>

                <div class="food-menu-desc">
                    <h3><?php echo $title ?></h3>
                    <input type="hidden" name="food" value="<?php echo $title ?>">

                    <p class="food-price"><?php echo $price ?></p>
                    <input type="hidden" name="price" value="<?php echo $price ?>">

                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>
                </div>
            </fieldset>

            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>
        </form>

        <?php
        // Check submit button click
        if (isset($_POST['submit']))
        {
            // Get details from Form
            $food = $_POST['food'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];
            $total = $price * $qty;
            $order_date = date("Y-m-d h:i:s");
            $status = "Ordered"; // [Ordered, On Delivery, Cancelled]
            $customer_name = $_POST['full-name'];
            $customer_contact = $_POST['contact'];
            $customer_email = $_POST['email'];
            $customer_address = $_POST['address'];

            // Save the order in DB
            $sql2 = "INSERT INTO tbl_order SET 
                          food = '$food',
                          price = $price,
                          qty = $qty,
                          total = $total,
                          order_date = '$order_date',
                          status = '$status',
                          customer_name = '$customer_name',
                          customer_contact = '$customer_contact',
                          customer_email = '$customer_email',
                          customer_address = '$customer_address'
                          ";
            // Execute Query // echo $sql2; die(); //
            $res2 = mysqli_query($conn, $sql2);
            if ($res2 == TRUE)
            {
                // Query Executed and Order Saved
                $_SESSION['order'] = "<div class='success text-center'>Food Ordered Successfully</div>";
                header('Location:'. SITE_URL);
            }
            else
            {
                // Failed Query execution
                $_SESSION['order'] = "<div class='error text-center'>Sorry. Failed to order food. Try again later</div>";
                header('Location:'. SITE_URL);
            }
        }
        ?>

    </div>
</section>
<!-- Food Search Section Ends Here -->
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