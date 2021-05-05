<?php include('conectDB.php');
$name = $_POST['name'];
$lastname = $_POST['lastname'];
$gender = $_POST['gender'];
$PhoneNumber = $_POST['PhoneNumber'];
$status = $_POST['status'];

$sql = "INSERT INTO employee (`name`,`lastname`,`gender`,`phone`,`EMstatus`,`countOrder`) VALUE ('$name','$lastname','$gender','$PhoneNumber','$status',0)";
mysqli_query($conect,$sql);
header('location: index.php?employee=1');

?>