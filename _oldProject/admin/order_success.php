<?php 
include('conectDB.php');
$sellid = $_GET['id'];

//ลบงานของพนักงานออก1
$sql = "SELECT idEmployee FROM sell WHERE sellid=$sellid";
$result = mysqli_query($conect,$sql);
$row = mysqli_fetch_array($result);
$employeeid = $row['idEmployee'];

$sql = "SELECT countOrder FROM employee WHERE id=$employeeid";
$result = mysqli_query($conect,$sql);
$row = mysqli_fetch_array($result);
$count = $row['countOrder'];
$count -= 1;

$sql = "UPDATE employee SET countOrder=$count WHERE id=$employeeid";
mysqli_query($conect,$sql);

//update สถานะ
$sql = "UPDATE sell SET `status`='ส่งแล้ว' WHERE sellid=$sellid";
mysqli_query($conect,$sql);

header('location: orderlist.php');

?>