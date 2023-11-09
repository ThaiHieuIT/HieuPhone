<?php
$servername = "localhost:3306";
$database = "hieuphone";
$username = "root";
$password = "180803";
$charset = "utf8mb4";

$conn = mysqli_connect($servername,$username,$password,$database);
mysqli_set_charset($conn, $charset);

if ($conn->connect_error) {
    die("Connect ERROR!" .  $conn->connect_error);
}
?>