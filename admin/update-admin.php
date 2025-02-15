<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br /> <br />
        <?php
        // 1. Get the ID of admin selected
        $id=$_GET['id'];
        // 2. Create SQL Query to get details
        $sql="SELECT * FROM tbl_admin WHERE id = $id";
        // Execute Query
        $res = mysqli_query($conn, $sql);
        // Check whether the query is executed or note
        if($res==TRUE) {
            // Check whether the data is available or not
            $count = mysqli_num_rows($res);
            // We have the admin data
            if($count == 1) {
                // Get Details // echo "Admin Available"; //
                $row = mysqli_fetch_assoc($res);
                $full_name = $row['full_name'];
                $username = $row['username'];
            } else {
                // Redirect to manage-admin page
                header('location:'.SITE_URL.'admin/manage-admin.php');
            }
        }
        ?>
        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" id="full_name" value="<?php echo $full_name; ?>"></td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" id="username" value="<?php echo $username; ?>"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>" readonly>
                        <input type="submit" name="submit" id="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php include('partials/footer.php'); ?>
<?php
// Check whether the submit btn is clicked or not
if (isset($_POST['submit'])) {
    // echo 'BTN CLICKED';
    // Get all the values from form to update
    $id = $_POST['id'];
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    // Create a SQL Query to update Admin
    $sql = "UPDATE tbl_admin SET
        full_name = '$full_name',
        username = '$username'
        WHERE id = '$id'
    ";
    // Execute Query
    $res = mysqli_query($conn, $sql);

    if ($res == TRUE) {
        // OK Admin Updated
        $_SESSION['update'] = "<div class='success'>Admin Updated Successfully</div>";
        header('location:'.SITE_URL.'admin/manage-admin.php');
    } else {
        // Oops Query Failed
        $_SESSION['update'] = "<div class='error'>Error on deleting admin</div>";
        header('location:'.SITE_URL.'admin/manage-admin.php');
    }
}
?>


