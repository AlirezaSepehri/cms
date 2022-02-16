<?php
include '../../database/db.php';
if ($_SESSION["role"] != 2) {
    header("location:../index.php");
}
$id = $_GET['id'];
$result = $conn->prepare("DELETE FROM post WHERE id=?");
$result->bindValue(1, $id);
$result->execute();
header('location:blog.php');
