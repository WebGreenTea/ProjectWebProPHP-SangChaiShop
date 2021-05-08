<?php
session_start();
include('conectDB.php');
$userid = $_POST['userid'];
$oldpass = mysqli_real_escape_string($conect, $_POST['oldpass']);
$newpass = mysqli_real_escape_string($conect, $_POST['password']);

$oldpass = md5($oldpass);
$sql = "SELECT * FROM user_data WHERE userid=$userid AND password='$oldpass'";
$res = mysqli_query($conect,$sql);
$res = mysqli_fetch_array($res);
if($res){
    echo "resday";
    $newpass = md5($newpass);
    $sql = "UPDATE user_data SET password='$newpass' WHERE userid=$userid";
    mysqli_query($conect,$sql);
    $_SESSION['success'] = 'success';
}else{
    $_SESSION['error'] = "รหัสปัจจุบันไม่ถูกต้อง";
}
header('location: changePassPage.php')


?>