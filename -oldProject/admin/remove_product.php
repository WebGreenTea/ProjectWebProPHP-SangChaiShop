<?php 
include('conectDB.php');
$id = $_GET['id'];
$sql = "DELETE FROM product WHERE productid=$id";
mysqli_query($conect,$sql);
header('location: index.php?product=1');
?>