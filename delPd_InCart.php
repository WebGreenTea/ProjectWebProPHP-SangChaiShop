<?php
include('conectDB.php');
$cartid = $_GET['cartid'];
$product = $_GET['productid'];

$sql = "DELETE FROM cartinfo WHERE cartid=$cartid AND productid=$product";
mysqli_query($conect,$sql);

header('location: cart.php');
?>