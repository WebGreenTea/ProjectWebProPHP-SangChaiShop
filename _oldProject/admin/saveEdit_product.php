<?php include('conectDB.php');
if(isset($_POST['submit'])){
    //upload picture
    $file = $_FILES['img'];
    print_r($file);
    $filename = $_FILES['img']['name'];
    $fileTmpName = $_FILES['img']['tmp_name'];
    $fileSize = $_FILES['img']['size'];
    $fileError = $_FILES['img']['error'];
    $fileType = $_FILES['img']['type'];

    $fileExt = explode('.',$filename);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg','jpeg','png');

    if(in_array($fileActualExt,$allowed)){
        if($fileError === 0){
            if($fileSize < 1000000000){
                $fileNameNew = uniqid('',true).".".$fileActualExt;
                $fileDestination = '../SHOP/productPic/'.$fileNameNew;
                move_uploaded_file($fileTmpName,$fileDestination);
                echo "upload success";
                $PDimg = $fileNameNew;//picture name for save to data base
            }
            else{
                echo "file is too big";
                $PDimg = "";
            }
        }
        else{
            echo "upload error";
            $PDimg = "";
        }
    }
    else{
        echo "cannot upload file of this type";
        $PDimg = "";
    }
    

    //upload text file
    $file = $_FILES['txt'];

    $filename = $_FILES['txt']['name'];
    $fileTmpName = $_FILES['txt']['tmp_name'];
    $fileSize = $_FILES['txt']['size'];
    $fileError = $_FILES['txt']['error'];
    $fileType = $_FILES['txt']['type'];

    $fileExt = explode('.',$filename);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('txt');

    if(in_array($fileActualExt,$allowed)){
        if($fileError === 0){
            if($fileSize < 1000000000){
                $fileNameNew = uniqid('',true).".".$fileActualExt;
                $fileDestination = '../SHOP/infoproduct/'.$fileNameNew;
                move_uploaded_file($fileTmpName,$fileDestination);
                echo "upload success";
                $PDinfo = $fileNameNew;//info name for save to data base
            }
            else{
                echo "file is too big";
                $PDinfo = "";
            }
        }
        else{
            echo "upload error";
            $PDinfo = "";
        }
    }
    else{
        echo "cannot upload file of this type";
        $PDinfo = "";
    }
    
    $PDid = $_GET['id'];
    $PDname = $_POST['name'];
    $PDbrand = $_POST['brand'];
    $PDtype = $_POST['type'];
    $PDprice = $_POST['price'];
    $PDcount = $_POST['count'];

    if($PDimg == "" && $PDinfo == ""){
        $sql = "UPDATE `product` SET `typeid`=$PDtype,`brandid`=$PDbrand,`PDname`='$PDname',`price`=$PDprice,`count`=$PDcount WHERE `productid`=$PDid";
    }
    else if($PDimg != "" && $PDinfo == "") {
        $sql = "UPDATE `product` SET `typeid`=$PDtype,`brandid`=$PDbrand,`PDname`='$PDname',`price`=$PDprice,`count`=$PDcount,`picture`='$PDimg' WHERE `productid`=$PDid";
    }
    else if($PDimg == "" && $PDinfo != ""){
        $sql = "UPDATE `product` SET `typeid`=$PDtype,`brandid`=$PDbrand,`PDname`='$PDname',`price`=$PDprice,`count`=$PDcount,`info`='$PDinfo' WHERE `productid`=$PDid";
    }
    else{
        $sql = "UPDATE `product` SET `typeid`=$PDtype,`brandid`=$PDbrand,`PDname`='$PDname',`price`=$PDprice,`count`=$PDcount,`picture`='$PDimg',`info`='$PDinfo' WHERE `productid`=$PDid";
    }
    
    mysqli_query($conect,$sql);
    header('location: index.php?product=1');
}
?>