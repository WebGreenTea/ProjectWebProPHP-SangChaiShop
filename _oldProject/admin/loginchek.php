<?php
session_start();
include('conectDB.php');


if (isset($_POST['EMlogin'])) {
    $pass = mysqli_real_escape_string($conect, $_POST['password']);

    $SQL = "SELECT * FROM `employee` WHERE `id`='$pass'";
    $result = mysqli_query($conect, $SQL);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        if($row['EMstatus'] === "พนักงานส่ง"){
            $_SESSION['accessEM'] = "access";
            $_SESSION['id'] = "$pass";
            header('location: orderlist.php');
        }
        else if($row['EMstatus'] === "ผู้จัดการ"){
            $_SESSION['accessAdmin'] = "access";
            $_SESSION['id'] = "$pass";
            header('location: index.php');
        }

        
    } else {
        $_SESSION['error'] = "รหัสพนักงานไม่ถูกต้อง";
        header('location: loginpage.php');
    }
}
