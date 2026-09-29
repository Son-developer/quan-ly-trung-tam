<?php
include 'connect.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn->query("DELETE FROM lop_hoc WHERE id = $id");
}
header("Location: lop-hoc.php");
exit();
?>