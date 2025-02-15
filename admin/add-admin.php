<?php include('./partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add New Admin</h1>
        <br /> <br />
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add']; // Display session msg
            unset($_SESSION['add']); // Unset session msg
        }
        ?>
        <br /> <br />
        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" id="full_name" placeholder="Enter your name" /></td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" id="username" placeholder="Your username"></td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" id="password" placeholder="Your password"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" id="submit" value="Add Admin" class="btn-secondary" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php include('./partials/footer.php') ?>
<?php
if (isset($_POST['submit'])) { // Button clicked // echo "Button Clicked"; //
    // 1. Get data from form
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, (md5($_POST['password']))); //Password encrypted with md5
    // 2. SQL Query to save the data
    $sql = "INSERT INTO tbl_admin (full_name, username, password) VALUES ('$full_name', '$username', '$password')";
    // 3. Execute Query and save data in DB
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    // 4. Check whether the data is executed or not and dsplay message
    if ($res == TRUE) {
        // OK Data inserted // echo "New record created successfully"; //
        // Create a session variable to display message
        $_SESSION['add'] = "Admin Added Successfully";
        // Redirect to manage-admin
        header('location:'.SITE_URL.'admin/manage-admin.php');
    } else {
        // Failed to insert data // echo "Error: " . $sql . "<br>" . $conn->error; //
        // Create a session variable to display message
        $_SESSION['add'] = "Failed to Add Admin, Try Again";
        // Redirect to add-admin
        header('location:'.SITE_URL.'admin/add-admin.php');
    }
}
?>
