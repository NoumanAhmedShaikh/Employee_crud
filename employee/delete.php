<?php
include '../components/config.php';

$id = $_GET['id'];

mysqli_query(
    $conn,
    "DELETE FROM employee WHERE id=$id"
);

header("Location:index.php");
?>