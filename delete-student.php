<?php
include 'connect.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn->query("DELETE FROM hoc_vien WHERE id = $id");
}
header("Location: hoc-vien.php");
exit();
?>