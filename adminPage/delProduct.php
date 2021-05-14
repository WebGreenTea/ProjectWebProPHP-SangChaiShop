<?php 
session_start();
include('../conectDB.php');
if (!(isset($_SESSION['identity']) && $_SESSION['identity'] == "admin")) {
    header('location: ../index.php');
}

$id = $_GET['id'];
//del picture file
$sql = "SELECT picture FROM product WHERE productid=$id";
$pic = mysqli_query($conect,$sql);
$pic = mysqli_fetch_array($pic)['picture'];
$piclocation = "../productPic/".$pic;
unlink($piclocation);

$sql = "DELETE FROM product WHERE productid=$id";
mysqli_query($conect,$sql);
header('location: adminPage.php')
?>