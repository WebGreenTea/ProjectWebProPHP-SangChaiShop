<?php 
include('conectDB.php');
$id = $_GET['id'];
$sql = "DELETE FROM employee WHERE id=$id";
mysqli_query($conect,$sql);
header('location: index.php?employee=1');
?>