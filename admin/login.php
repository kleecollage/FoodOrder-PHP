<?php include('../config/constants.php'); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="../css/admin.css" />
    <title>Login - Food Order System</title>
</head>
<body>
    <div class="login">
        <h1 class="text-center">Login</h1>
        <br /> <br />
        <?php
            if(isset($_SESSION['login'])) {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            if(isset($_SESSION['no-login-msg'])) {
                echo $_SESSION['no-login-msg'];
                unset($_SESSION['no-login-msg']);
            }
        ?>
        <br /> <br />
        <!--   LOGIN FORM STARTS HERE     -->
        <form action="" method="post" class="text-center">
            Username: <br />
            <input type="text" name="username" id="username" placeholder="Enter Username">
            <br /> <br />
            Password: <br />
            <input type="password" name="password" id="password" placeholder="Enter Password">
            <br /> <br />
            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br /> <br />
        </form>
        <!--   LOGIN FORM ENDS HERE     -->
        <p class="text-center">Created By - <a href="https://www.youtube.com/watch?v=bk_5SAH7Oyk&list=PLBLPjjQlnVXXBheMQrkv3UROskC0K1ctW&index=5">Vijay Thapa</a></p>
    </div>
</body>
</html>
<?php
// Check whether the submit btn was clicked or not
if (isset($_POST['submit'])) {
    // 1. Get data from login Form
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));

    // 2. SQL to check whether credentials are ok or not
    $sql = "SELECT * FROM tbl_admin where username = '$username' AND password = '$password'";

    // 3. Execute Query
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    if($count == 1) {
        // User available
        $_SESSION['login'] = "<div class='success text-center'>Login Successful</div>";
        $_SESSION['user'] = $username; // Check if user is logged or not, logout will unset this session
        // Redirect to landing page
        header('Location:'. SITE_URL . 'admin/');
    } else {
        // User not available
        $_SESSION['login'] = "<div class='error text-center'>Invalid Credentials</div>";
        // Redirect to landing page
        header('Location:'. SITE_URL . 'admin/login.php');
    }
}
?>






