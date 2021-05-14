<?php
session_start();
include('../conectDB.php');
if (!(isset($_SESSION['identity']) && $_SESSION['identity'] == "admin")) {
    header('location: ../index.php');
}
if (isset($_POST['submit'])) {
    $PDid = $_POST['id'];
    $PDname = $_POST['productname'];
    $brandid = $_POST['brand'];
    $typeid = $_POST['type'];
    $price = $_POST['price'];
    $count = $_POST['count'];
    $info = $_POST['info'];
    //get old img file name
    $sql = "SELECT picture FROM product WHERE productid=$PDid";
    $oldFileName = mysqli_query($conect,$sql);
    $oldFileName = mysqli_fetch_array($oldFileName)['picture'];
    $delFlag = false;
    if(is_null($oldFileName) || $oldFileName == ""){
        $delFlag = false;
    }else{
        $delFlag = true;
    }


    if (strlen($_FILES['img']['name']) > 0) {
        $filename = $_FILES['img']['name'];
        $fileTmpName = $_FILES['img']['tmp_name'];
        $fileSize = $_FILES['img']['size'];
        $fileError = $_FILES['img']['error'];
        $fileType = $_FILES['img']['type'];

        //get .* of file
        $fileExt = explode('.', $filename);
        $fileActualExt = strtolower(end($fileExt));

        //set file type to be approved
        $allowed = array('jpg', 'jpeg', 'png');

        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) { //check error of file
                if ($fileSize < 50000000) {
                    $fileNameNew = uniqid('', true) . "." . $fileActualExt; //create new file name
                    $fileDestination = '../productPic/' . $fileNameNew; //create file destination
                    copy($fileTmpName, $fileDestination);
                    unlink($fileTmpName);
                    //delete old file
                    if($delFlag){
                        $OldfileDestination = '../productPic/'.$oldFileName;
                        unlink($OldfileDestination);
                    }
                    
                    echo "upload success";
                    $PDimg = $fileNameNew; //picture name for save to data base
                } else {
                    echo "file is too big";
                    $PDimg = "";
                }
            } else {
                echo "upload error";
                $PDimg = "";
            }
        } else {
            echo "cannot upload file of this type";
            $PDimg = "";
        }
        $sql = "UPDATE `product` SET `typeid`=$typeid, `brandid`=$brandid, `PDname`='$PDname',`price`=$price, `count`=$count, `picture`='$PDimg', `info`='$info' WHERE productid=$PDid";
    }else{
        $sql = "UPDATE `product` SET `typeid`=$typeid, `brandid`=$brandid, `PDname`='$PDname',`price`=$price, `count`=$count, `info`='$info' WHERE productid=$PDid";
    }
    
    //$sql = "INSERT INTO `product` (,,,,,,) VALUE (,,,,)";
    mysqli_query($conect, $sql);
    header('location: adminPage.php');
}
