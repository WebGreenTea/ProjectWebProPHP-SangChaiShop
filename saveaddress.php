<?php
include('conectDB.php');
$userid = $_POST['userid'];
$address = $_POST['address'];
$sql = "UPDATE user_data SET address='$address' WHERE userid=$userid";
mysqli_query($conect,$sql);
$sql = "SELECT address FROM user_data WHERE userid=$userid";
$address = mysqli_query($conect,$sql);
$address = mysqli_fetch_array($address);
echo $address;
?>