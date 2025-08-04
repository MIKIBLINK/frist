<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "seavlinh_shop";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error)
    die("Connection failed: " . $conn->connect_error);

$orders = [];
$user = null;

if (isset($_GET['phone_number']) && !empty($_GET['phone_number'])) {
    $phoneNumber = $conn->real_escape_string($_GET['phone_number']);
}
?>