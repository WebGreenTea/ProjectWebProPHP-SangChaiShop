<?php 
include('../conectDB.php');
$cartid = $_POST['cartid'];
$pdid = $_POST['pdid'];

$sql = "DELETE FROM `cartinfo` WHERE cartid=$cartid AND productid=$pdid";
mysqli_query($conect,$sql);
?>