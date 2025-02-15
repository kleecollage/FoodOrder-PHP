<?php include("partials/menu.php") ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br /> <br />
        <?php
        // Check ID
        if (isset($_GET['id']))
        {
            $id = $_GET['id']; // Get order ID
            // Get the order details
            $sql = "SELECT * FROM tbl_order WHERE id = $id"; // SQL Query to get details
            $res = mysqli_query($conn, $sql); // Execute Query
            $count = mysqli_num_rows($res); // Count rows
            if ($count == 1)
            {
                // Details available
                $row = mysqli_fetch_assoc($res);
                $food = $row['food'];
                $price = $row['price'];
                $qty = $row['qty'];
                $status = $row['status'];
                $customer_name= $row['customer_name'];
                $customer_contact= $row['customer_contact'];
                $customer_email= $row['customer_email'];
                $customer_address= $row['customer_address'];
            }
            else
            {
                // No data
                header('Location:'. SITE_URL .'admin/manage-order.php'); // redirect
            }
        }
        else
        {
            // Redirect to manage-order page
            header('Location:'. SITE_URL .'admin/manage-order.php');
        }
        ?>
        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Food Name</td>
                    <td> <b> <?php echo $food ?> </b></td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td><b> $<?php echo $price ?> </b></td>
                </tr>
                <tr>
                    <td>Quantity</td>
                    <td><input type="number" name="qty" value="<?php echo $qty ?>"></td>
                </tr>
                <tr>
                    <td>Status: </td>
                    <td>
                        <select name="status">
                            <option <?php if($status == "Ordered") { echo "selected"; } ?> value="Ordered">Ordered</option>
                            <option <?php if($status == "On Delivery") { echo "selected"; } ?> value="On Delivery">On Delivery</option>
                            <option <?php if($status == "Delivered") { echo "selected"; } ?> value="Delivered">Delivered</option>
                            <option <?php if($status == "Cancelled") { echo "selected"; } ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Customer Name: </td>
                    <td><input type="text" name="customer_name" value="<?php echo $customer_name ?>"></td>
                </tr>
                <tr>
                    <td>Customer Contact: </td>
                    <td><input type="text" name="customer_contact" value="<?php echo $customer_contact ?>"></td>
                </tr>
                <tr>
                    <td>Customer Email: </td>
                    <td><input type="email" name="customer_email" value="<?php echo $customer_email ?>"></td>
                </tr>
                <tr>
                    <td>Customer Address: </td>
                    <td>
                        <textarea type="text" name="customer_address" cols="30" rows="5"><?php echo $customer_address ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php
        // Check submit btn
        if (isset($_POST['submit']))
        {
            // Get form data
            $id = $_POST['id'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];
            $total = $price * $qty;
            $status = $_POST['status'];
            $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
            $customer_contact = mysqli_real_escape_string($conn, $_POST['customer_contact']);
            $customer_email = mysqli_real_escape_string($conn, $_POST['customer_email']);
            $customer_address = mysqli_real_escape_string($conn, $_POST['customer_address']);
            // Update te values
            $sql2 = "UPDATE tbl_order SET 
                     qty = $qty, 
                     total = $total,
                     status = '$status',
                     customer_name = '$customer_name',
                     customer_contact = '$customer_contact',
                     customer_email = '$customer_email',
                     customer_address = '$customer_address' 
                 WHERE id = $id
                     ";
            // Execute query
            $res2 = mysqli_query($conn, $sql2);
            // Check update status
            if ($res2 == TRUE)
            {
                // OK. Update complete
                $_SESSION['update'] = "<div class='success'>Order Updated Successfully</div>";
                header('Location:'. SITE_URL .'admin/manage-order.php');
            }
            else
            {
                // Update failed
                $_SESSION['update'] = "<div class='error'>Failed to update the order. Try again later</div>";
                header('Location:'. SITE_URL .'admin/manage-order.php');
            }
            // Redirect to manage-order page
        }
        ?>
    </div>
</div>

<?php include("partials/footer.php") ?>