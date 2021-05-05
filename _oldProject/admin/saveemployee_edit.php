<?php 
include('conectDB.php');
$id = $_GET['id'];
$name = $_POST['name'];
$lastname = $_POST['lastname'];
$gender = $_POST['gender'];
$PhoneNumber = $_POST['PhoneNumber'];
$status = $_POST['status'];
echo $name;
$sql = "UPDATE employee SET `name`='$name',`lastname`='$lastname',`gender`='$gender', `phone`='$PhoneNumber',`EMstatus`='$status' WHERE id=$id";
mysqli_query($conect,$sql);
header('location: index.php?employee=1');

?>