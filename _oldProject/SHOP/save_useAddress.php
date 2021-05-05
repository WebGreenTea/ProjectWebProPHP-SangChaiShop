<?php

session_start();
include('conectDB.php');
$address = mysqli_real_escape_string($conect,$_POST['address']);
$userID = $_SESSION['userid'];
$sql = "UPDATE user_data SET address='$address' WHERE userid=$userID ";
mysqli_query($conect,$sql);


?>