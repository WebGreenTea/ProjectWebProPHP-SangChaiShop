<?php 
include('../conectDB.php');

$userid = $_GET['userid'];

$sql = "SELECT `cartid` FROM `cart` WHERE `userid`=$userid";
$result = mysqli_query($conect,$sql);
$row = mysqli_fetch_array($result);
$cartid = $row['cartid'];

echo $cartid;

?>