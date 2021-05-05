<?php
    session_start();
    include('conectDB.php');
    $errors = array();

    if(isset($_POST['userReg'])){
        $username = mysqli_real_escape_string($conect,$_POST['username']);
        $email = mysqli_real_escape_string($conect,$_POST['Email']);
        $name = mysqli_real_escape_string($conect,$_POST['name']);
        $lastname = mysqli_real_escape_string($conect,$_POST['lastname']);
        $gender = mysqli_real_escape_string($conect,$_POST['gender']);
        $PhoneNumber = mysqli_real_escape_string($conect,$_POST['PhoneNumber']);
        $address = mysqli_real_escape_string($conect,$_POST['address']);
        $password = mysqli_real_escape_string($conect,$_POST['password']);
        $password2 = mysqli_real_escape_string($conect,$_POST['password2']);

        if(empty($username)){
            array_push($errors,"username error");
        }
        if(empty($email)){
            array_push($errors,"email error");
        }
        if(empty($name)){
            array_push($errors,"name error");
        }
        if(empty($lastname)){
            array_push($errors,"last error");
        }
        if(empty($gender)){
            array_push($errors,"gender error");
        }
        if(empty($PhoneNumber)){
            array_push($errors,"phone error");
        }
        if(empty($address)){
            array_push($errors,"address error");
        }
        if(empty($password)){
            array_push($errors,"password error");
        }
        if($password != $password2){
            array_push($errors,"password not match");
        }

        $chck_user = "SELECT * FROM user_data WHERE username = '$username' OR email = '$email'";
        $query = mysqli_query($conect,$chck_user);
        $result = mysqli_fetch_assoc($query);


        if($result){
            $_SESSION['error'] = "Username หรือ e-mail นี้มีอยู่แล้ว";
            header('location: registerPage.php');
        }
        else if(count($errors) == 0){
            $pwd = md5($password);
            //$pwd = $password;

            $sql = "INSERT INTO `user_data`( `username`, `name`, `lastname`, `gender`, `address`, `email`, `PhonNumber`, `password`) VALUES ('$username','$name','$lastname','$gender','$address','$email','$PhoneNumber','$pwd')";
            mysqli_query($conect,$sql);

            $sql = "SELECT userid FROM user_data WHERE username = '$username'";
            $query = mysqli_query($conect,$sql);
            $userid = mysqli_fetch_array($query);

            $_SESSION['username'] = $username;
            $_SESSION['userid'] = $userid['userid'];
            header('location: index.php');

        }
        else{
            $_SESSION['error'] = "มีบางอย่างผิดพลาด";
            header('location: registerPage.php');
        }
        
    }

?>

