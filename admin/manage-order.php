<?php include('./partials/menu.php'); ?>
<!--  MAIN CONTENT SECTION START  -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>
        <br /><br />
        <?php
        if (isset($_SESSION['update']))
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Food</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>Customer Contact</th>
                <th>Customer Email</th>
                <th>Customer Address</th>
                <th>Actions</th>
            </tr>
            <?php
            $sql = "SELECT * FROM tbl_order ORDER BY id DESC";
            $res = mysqli_query($conn, $sql); // Execute query
            $count = mysqli_num_rows($res); // count rows
            if ($count > 0)
            {
                // Data available
                while ($row = mysqli_fetch_assoc($res))
                {
                    $id = $row['id'];
                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $total = $row['total'];
                    $order_date = $row['order_date'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];
            ?>
                <tr>
                    <td><?php echo $id ?></td>
                    <td><?php echo $food ?></td>
                    <td><?php echo $price ?></td>
                    <td><?php echo $qty ?></td>
                    <td><?php echo $total ?></td>
                    <td><?php echo $order_date ?></td>
                    <td>
                        <?php
                        // Ordered | On Delivery | Delivered | Cancelled
                        if ($status == "Ordered")
                        {
                            echo "<label>$status</label>";
                        }
                        elseif ($status == "On Delivery")
                        {
                            echo "<label style='color: orange'>$status</label>";
                        }
                        elseif ($status == "Delivered")
                        {
                            echo "<label style='color: green'>$status</label>";
                        }
                        elseif ($status == "Cancelled")
                        {
                            echo "<label style='color: darkred'>$status</label>";
                        }
                        ?>
                    </td>
                    <td><?php echo $customer_name ?></td>
                    <td><?php echo $customer_contact ?></td>
                    <td><?php echo $customer_email ?></td>
                    <td><?php echo $customer_address ?></td>
                    <td>
                        <a href="<?php echo SITE_URL; ?>admin/update-order.php?id=<?php echo $id ?>" class="btn-secondary">Update</a>
                        <a href="#" class="btn-danger">Delete</a>
                    </td>
                </tr>
            <?php
                }
            }
            else
            {
                // No data to show
                echo "<tr><td colspan='12' class='error'>Take a breath. No orders at the moment</td></tr>";
            }
            ?>
        </table>
    </div>
</div>
<!--  MAIN CONTENT SECTION  END -->
<?php include('./partials/footer.php') ?>
