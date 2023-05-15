<?php
$host = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "review";

// Kết nối tới cơ sở dữ liệu
$conn = mysqli_connect($host, $username_db, $password_db, $dbname);

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}
?>