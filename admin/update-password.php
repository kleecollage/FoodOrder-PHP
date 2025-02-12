<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br /> <br />
        <?php
        if (isset($_GET['id'])) {
            $id=$_GET['id'];
        }
        ?>
        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Current Password: </td>
                    <td><input type="password" name="current_password" id="current_password"
                               placeholder="Enter Current Password"></td>
                </tr>
                <tr>
                    <td>New Password: </td>
                    <td><input type="password" name="new_password" id="new_password"
                               placeholder="Enter You New Password"></td>
                </tr>
                <tr>
                    <td>Confirm Password: </td>
                    <td><input type="password" name="confirm_password" id="confirm_password"
                               placeholder="Confirm Password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id ?>" readonly>
                        <input type="submit" name="submit" id="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php include('partials/footer.php') ?>
<?php
// Check whether the submit btn is clicked or not
if (isset($_POST['submit'])) {
    // echo 'Clicked';
    // 1. Get the data from Form
    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);
    // 2. Check whether the user whit current ID and current password exists or not
    $sql = "SELECT * FROM tbl_admin WHERE id='$id' AND password='$current_password'";
    // Execute Query
    $res =  mysqli_query($conn, $sql);
    if ($res == TRUE) {
        // Check if data is available
        $count = mysqli_num_rows($res);
        if($count == 1) {
            // User Exists And Password can ve changed // echo "User Found"; //
            // 3. Check whether the password and confirm password matches
            if ($new_password == $confirm_password) {
                // update password // echo "Passwords match!"; //
                $sql2 = "UPDATE tbl_admin SET
                       password = '$new_password'
                       WHERE id = $id 
                     ";
                // Execute query
                $res2 = mysqli_query($conn, $sql2);
                // Check if query was executed
                if ($res2 == TRUE) {
                    // Display Success msg
                    $_SESSION['change-pwd'] = "<div class='success'>Password Updated Successfully</div>";
                    header('location:'.SITE_URL.'admin/manage-admin.php');
                } else {
                    // Display Error msg
                    $_SESSION['change-pwd'] = "<div class='error'>Password Update Failed. Try Again Later</div>";
                    header('location:'.SITE_URL.'admin/manage-admin.php');
                }
            } else {
                // Redirect with error message
                $_SESSION['pwd-not-match'] = "<div class='error'>Passwords Did Not Match</div>";
                header('location:'.SITE_URL.'admin/manage-admin.php');
            }
        } else {
            // User does not exists
            $_SESSION['user-not-found'] = "<div class='error'>User Not Found</div>";
            header('location:'.SITE_URL.'admin/manage-admin.php');
        }
    }


    // 4. Change the password if all bellows is true
}
?>










