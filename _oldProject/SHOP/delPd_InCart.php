<?php
include('conectDB.php');
$cartid = $_POST['cartid'];
$product = $_POST['productid'];

$sql = "DELETE FROM cartinfo WHERE cartid=$cartid AND productid=$product";
mysqli_query($conect,$sql);


//call totol of product in cart of this user
$sql = "SELECT * FROM cartINFO WHERE cartid=$cartid";
$result = mysqli_query($conect,$sql);
$totol = 0;
while($rowfinal = mysqli_fetch_array($result)){
    $totol += $rowfinal['count'];
}
echo $totol;
?>