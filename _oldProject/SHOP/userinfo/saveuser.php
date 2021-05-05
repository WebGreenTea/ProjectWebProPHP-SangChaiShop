<?php
session_start();
include('../conectDB.php');
if(isset($_POST['userEdit'])){
    $email = mysqli_real_escape_string($conect,$_POST['Email']);
    $name = mysqli_real_escape_string($conect,$_POST['name']);
    $lastname = mysqli_real_escape_string($conect,$_POST['lastname']);
    $gender = mysqli_real_escape_string($conect,$_POST['gender']);
    $PhoneNumber = mysqli_real_escape_string($conect,$_POST['PhoneNumber']);
    $address = mysqli_real_escape_string($conect,$_POST['address']);
    $userid = $_SESSION['userid'];
    //$sql = "INSERT INTO `user_data`(`name`, `lastname`, `gender`, `address`,`PhonNumber`) VALUES ('$name','$lastname','$gender','$address',$PhoneNumber) WHERE=";
    $sql = "UPDATE `user_data` SET `name`='$name',`lastname`='$lastname',`gender`='$gender',`address`='$address',`PhonNumber`=$PhoneNumber WHERE userid=$userid";
    mysqli_query($conect,$sql);

    $sql = "SELECT * FROM `user_data` WHERE email='$email'";
    $result = mysqli_query($conect,$sql);
    $rowdata = mysqli_fetch_array($result);
    if($rowdata){//เจอที emailซ้ำ
        $sql = "SELECT `email` FROM `user_data` WHERE userid=$userid";
        $result = mysqli_query($conect,$sql);
        $rowdata2 = mysqli_fetch_array($result);
        $DBemali = $rowdata2['email'];
        if($DBemali == $email){//ซ้ำกับตัวเอง
            
            header('location: myaccount.php?complete=1');
        }
        else{//ซ้ำกับคนอื่น
            $_SESSION['error'] = "e-mail นี้มีอยู่แล้ว";
            header('location: myaccount.php');
        }
        
    }
    else{//email ไม่ซ้ำ
        $sql = "UPDATE `user_data` SET `email`='$email' WHERE userid=$userid";
        mysqli_query($conect,$sql);
        header('location: myaccount.php?complete=1');
    }

    

    
}

?>
