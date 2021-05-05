<?php
session_start();
include('conectDB.php');
echo "ddd";

if (isset($_POST['userlogin'])) {
    echo "ddd";
    $username = mysqli_real_escape_string($conect, $_POST['username']);
    $pass = mysqli_real_escape_string($conect, $_POST['password']);

    $pass = md5($pass);
    $SQL = "SELECT * FROM user_data WHERE username = '$username' AND password = '$pass'";
    $result = mysqli_query($conect, $SQL);

    if (mysqli_num_rows($result) == 1) {
        $sql = "SELECT userid FROM user_data WHERE username = '$username'";
        $query = mysqli_query($conect, $sql);
        $userid = mysqli_fetch_array($query);

        $_SESSION['username'] = $username;
        $_SESSION['userid'] = $userid['userid'];
        header('location: index.php');
    } else {
        $_SESSION['error'] = "Username หรือ รหัสผ่านไม่ถูกต้อง";
        header('location: loginPage.php');
    }
}
