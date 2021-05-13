<?php 
session_start();
include('../conectDB.php');
if (!(isset($_SESSION['identity']) && $_SESSION['identity'] == "admin")) {
    header('location: ../index.php');
}

$id = $_GET['id'];
$sql = "DELETE FROM product WHERE productid=$id";
mysqli_query($conect,$sql);
header('location: adminPage.php')
?>