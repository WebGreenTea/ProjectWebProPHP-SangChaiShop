<?php
session_start();
include('../conectDB.php');
if (!(isset($_SESSION['identity']) && $_SESSION['identity'] == "admin")) {
    header('location: ../index.php');
}
if (isset($_POST['submit'])) {
    $PDname = $_POST['productname'];
    $brandid = $_POST['brand'];
    $typeid = $_POST['type'];
    $price = $_POST['price'];
    $count = $_POST['count'];
    $info = $_POST['info'];
    //$file = $_FILES['img'];
    if (strlen($_FILES['img']['name']) > 0) {//check have file data
        $filename = $_FILES['img']['name'];
        $fileTmpName = $_FILES['img']['tmp_name'];
        $fileSize = $_FILES['img']['size'];
        $fileError = $_FILES['img']['error'];
        $fileType = $_FILES['img']['type'];

        //echo $fileSize;

        //get .* of file
        $fileExt = explode('.', $filename);
        $fileActualExt = strtolower(end($fileExt));

        //set file type to be approved
        $allowed = array('jpg', 'jpeg', 'png');

        if (in_array($fileActualExt, $allowed)) { //check file type
            if ($fileError === 0) { //check error of file
                if ($fileSize < 50000000) {
                    $fileNameNew = uniqid('', true) . "." . $fileActualExt; //create new file name
                    $fileDestination = '../productPic/' . $fileNameNew; //create file destination
                    copy($fileTmpName, $fileDestination);
                    unlink($fileTmpName);
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
    }else{
        $PDimg = "";
    }

    $sql = "INSERT INTO `product` (`typeid`,`brandid`,`PDname`,`price`,`count`,`picture`,`info`) VALUE ($typeid,$brandid,'$PDname',$price,$count,'$PDimg','$info')";
    mysqli_query($conect, $sql);
    header('location: adminPage.php');
}
