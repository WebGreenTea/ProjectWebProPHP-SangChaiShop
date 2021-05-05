<?php
include('conectDB.php');
$PDid = $_POST['ID'];
$countPD = $_POST['count'];

//find price this product
$sql = "SELECT price FROM product WHERE productid=$PDid";
$query = mysqli_query($conect,$sql);
$result = mysqli_fetch_array($query);
$price = $result['price'];


//cal sum price
echo $price*$countPD;


?>