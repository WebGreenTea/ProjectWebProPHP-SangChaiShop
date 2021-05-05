<?php 
session_start();
include('../conectDB.php');


if(isset($_POST['userPass'])){
    $oldpass = mysqli_real_escape_string($conect,$_POST['passwordold']);
    $oldpass = md5($oldpass);
    $newpass = mysqli_real_escape_string($conect,$_POST['password']);
    $newpass = md5($newpass);
    $userid = $_SESSION['userid'];

    $sql = "SELECT `password` FROM `user_data` WHERE userid=$userid";
    $result =  mysqli_query($conect,$sql);
    $rowdata = mysqli_fetch_array($result);
    $pwdinTable = $rowdata['password'];

    if($pwdinTable == $oldpass){
        $sql = "UPDATE `user_data` SET `password`='$newpass' WHERE userid=$userid";
        mysqli_query($conect,$sql);
        header('location: pass.php?complete=1');
    }
    else{
        $_SESSION['error'] = "รหัสผ่านเดิมไม่ถูกต้อง";
        header('location: pass.php?');
    }

    

}

?>