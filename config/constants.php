<?php
// Start Session
session_start();

// Create Constants to Store Non Repeating Values
const SITE_URL = 'http://localhost/food-order/';
const LOCALHOST = 'localhost';
const HOST = 'http://localhost';
const DB_USERNAME = 'root';
const DB_PASSWORD = '';
const DB_NAME = 'php-food-order';

$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); // DB Connection
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); // Select Database
