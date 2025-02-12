<?php include('./partials/menu.php'); ?>
<!--  MAIN CONTENT SECTION START  -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>
        <br /> <br />
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add']; // Display session msg
            unset($_SESSION['add']); // Unset session msg
        }
        ?>
        <br /> <br />
        <!--    BUTTON TO ADD ADMIN    -->
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br /><br /><br />
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>
            <?php
            // Query to Get all Admins
            $sql = "SELECT * FROM tbl_admin";
            // Execute Query
            $res = mysqli_query($conn, $sql);
            if ($res == TRUE) {
                // Count Rows to Check whether we have data or not
                $count = mysqli_num_rows($res);
                if ($count > 0) {
                    // We have data
                    while ($rows = mysqli_fetch_assoc($res)) {
                        // Iterate over the date
                        $id = $rows['id'];
                        $full_name = $rows['full_name'];
                        $username = $rows['username'];
                        // Display values on table
            ?>
             <tr>
                 <td><?php echo $id ?></td>
                 <td><?php echo $full_name ?></td>
                 <td><?php echo $username ?></td>
                 <td>
                     <a href="#" class="btn-secondary">Update Admin</a>
                     <a href="#" class="btn-danger">Remove Admin</a>
                 </td>
             </tr>
            <?php
                    }
                } else {
                    // We do not have data
                }
            }
            ?>
        </table>
    </div>
</div>
<!--  MAIN CONTENT SECTION  END -->
<?php include('./partials/footer.php') ?>