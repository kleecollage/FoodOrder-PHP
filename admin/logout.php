<?php
// Include constants.php
include ('../config/constants.php');
// 1. DESTROY THE SESSION
session_destroy(); // Unsets $_SESSION['user']
// 2.  REDIRECT TO LOGIN
header('Location:'. SITE_URL . 'admin/login.php');