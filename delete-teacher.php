<?php
include 'connect.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn->query("DELETE FROM giao_vien WHERE id = $id");
}
header("Location: giao-vien.php");
exit();
?>