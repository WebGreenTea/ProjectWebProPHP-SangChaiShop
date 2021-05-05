<?php
include('conectDB.php');
$count = $_POST['count'];
$PDid = $_POST['ProductID'];
$cartID = $_POST['IDcart'];

$sql = "UPDATE cartinfo SET count=$count WHERE cartid=$cartID AND productid=$PDid";
mysqli_query($conect,$sql);

//call totol of product in cart of this user
$sql = "SELECT * FROM cartINFO WHERE cartid=$cartID";
$result = mysqli_query($conect,$sql);
$totol = 0;
while($rowfinal = mysqli_fetch_array($result)){
    $totol += $rowfinal['count'];
}
echo $totol;
?>