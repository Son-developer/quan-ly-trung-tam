<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quan_ly_trung_tam";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Thiết lập tiếng Việt chuẩn UTF-8
$conn->set_charset("utf8mb4");
?>