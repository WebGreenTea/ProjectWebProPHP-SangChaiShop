<?php 
include('../conectDB.php');
$sellid = $_POST['idsell'];                                 //sellID
$pdid = $_POST['pdid'];                                     //productID
$count = $_POST['count'];                                   //count

$sql = "SELECT price FROM product WHERE productid=$pdid";
$result = mysqli_query($conect,$sql);
$resultrow = mysqli_fetch_array($result);
$price = $resultrow['price'];                               //price

$sql = "INSERT INTO `sellinfo`(`sellid`,`pdid`,`price`,`count`) VALUES ($sellid,$pdid,$price,$count) ";
mysqli_query($conect,$sql);


$sql = "SELECT `count` FROM product WHERE productid=$pdid";
$result = mysqli_query($conect,$sql);
$rowcount = mysqli_fetch_array($result);
$countintable = $rowcount['count'];
$countintable -= $count;
$sql = "UPDATE `product` SET `count`=$countintable WHERE productid=$pdid";
mysqli_query($conect,$sql);

?>