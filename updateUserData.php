<?php
    session_start();
    include('conectDB.php');
    $errors = array();

    if(isset($_POST['submit'])){
        $username = mysqli_real_escape_string($conect,$_POST['username']);
        $email = mysqli_real_escape_string($conect,$_POST['Email']);
        $name = mysqli_real_escape_string($conect,$_POST['name']);
        $lastname = mysqli_real_escape_string($conect,$_POST['lastname']);
        $gender = mysqli_real_escape_string($conect,$_POST['gender']);
        $PhoneNumber = mysqli_real_escape_string($conect,$_POST['PhoneNumber']);
        $address = mysqli_real_escape_string($conect,$_POST['address']);
        $userid = $_POST['userid'];

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
        
        //get old username and email
        $olddata = mysqli_query($conect,"SELECT username,email FROM user_data WHERE userid=$userid");
        $olddata =  mysqli_fetch_array($olddata);
        $oldusername = $olddata['username'];
        $oldemail = $olddata['email'];
        if(!($username == $oldusername)){
            $duplicateUsername =  mysqli_query($conect,"SELECT * FROM user_data WHERE username = '$username' AND NOT userid=$userid");
            $duplicateUsername = mysqli_fetch_array($duplicateUsername);
        }else{
            $duplicateUsername = false;
        }
        if(!($email == $oldemail)){
            $duplicateEmail = mysqli_query($conect,"SELECT * FROM user_data WHERE email = '$email' AND NOT userid=$userid");
            $duplicateEmail = mysqli_fetch_array($duplicateEmail);
        }else{
            $duplicateEmail = false;
        }

        if($duplicateEmail || $duplicateUsername){
            $_SESSION['status'] = "!บันทึกข้อมูลไม่สำเร็จ: Username หรือ e-mail นี้มีอยู่แล้ว";
            header('location: myaccountinfo.php');
        }
        else if(count($errors) == 0){ 
            $sql = "UPDATE user_data SET username='$username',name='$name',lastname='$lastname',gender='$gender',address='$address',email='$email',PhonNumber=$PhoneNumber WHERE userid=$userid";
            mysqli_query($conect,$sql);
            $_SESSION['status'] = " -- บันทึกข้อมูลเสร็จสิ้น -- ";
            header('location: myaccountinfo.php');

        }
        else{
            $_SESSION['error'] = "มีบางอย่างผิดพลาด";
            header('location: myaccountinfo.php');
        }
        
    }else{
        header('location: index.php');
    }

?>

