<?php
session_start();
include('conectDB.php');


if (isset($_POST['userlogin'])) {
    
    $username = mysqli_real_escape_string($conect, $_POST['username']);
    $pass = mysqli_real_escape_string($conect, $_POST['password']);

    $pass = md5($pass);
    $SQL = "SELECT * FROM user_data WHERE username = '$username' AND password = '$pass'";
    $result = mysqli_query($conect, $SQL);

    if (mysqli_num_rows($result) == 1) {
        $sql = "SELECT userid,identity FROM user_data WHERE username = '$username'";
        $query = mysqli_query($conect, $sql);
        $userdata = mysqli_fetch_array($query);

        $_SESSION['username'] = $username;
        $_SESSION['userid'] = $userdata['userid'];
        $_SESSION['identity'] = $userdata['identity'];
        header('location: index.php');
    } else {
        $_SESSION['error'] = "Username หรือ รหัสผ่านไม่ถูกต้อง";
        header('location: loginPage.php');
    }
}
