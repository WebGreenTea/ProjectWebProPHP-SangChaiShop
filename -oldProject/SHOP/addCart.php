<?php
include('conectDB.php');
$PDid = $_POST['PDidnew'];
$userid = $_POST['useridnew'];

$sql = "SELECT * FROM cart WHERE userid=$userid";
$result = mysqli_query($conect,$sql);
if (mysqli_num_rows($result) == 1) {//found in cart table
    $rowCart = mysqli_fetch_array($result);
    $cartid = $rowCart['cartid'];
    $sql = "SELECT * FROM cartINFO WHERE cartid=$cartid AND productid=$PDid";
    $result = mysqli_query($conect,$sql);
    if (mysqli_num_rows($result) == 1){//found this product in cartINFO table(+1 conut of this product)
       // echo "test";
        $rowCartINFO = mysqli_fetch_array($result);
        $countPD = $rowCartINFO['count']+1;
        $sql = "UPDATE `cartINFO` SET `count`=$countPD WHERE cartid=$cartid AND productid=$PDid ";
        mysqli_query($conect,$sql);
    }
    else{//not found this product in cartINFO table(add new row in cartINFO)
        $sql = "INSERT INTO `cartINFO` (`cartid`,`productid`,`count`) VALUE ($cartid,$PDid,1)";
        mysqli_query($conect,$sql);

    }

}
else{//not found in cart table
    $sql = "INSERT INTO cart (`userid`) VALUE ('$userid')"; //
    mysqli_query($conect,$sql);                             //insert cart to this user
    $sql = "SELECT * FROM cart WHERE userid=$userid";       //
    $result = mysqli_query($conect,$sql);                   //
    $rowCart = mysqli_fetch_array($result);                 //get cart id
    $cartid = $rowCart['cartid'];
    $sql = "INSERT INTO cartINFO (`cartid`,`productid`,`count`) VALUE ('$cartid','$PDid',1)";
    mysqli_query($conect,$sql);


}
//call totol of product in cart of this user
$sql = "SELECT * FROM cart WHERE userid=$userid";
$result = mysqli_query($conect,$sql);
$rowfinal = mysqli_fetch_array($result);
$cartid = $rowfinal['cartid'];
$sql = "SELECT * FROM cartINFO WHERE cartid=$cartid";
$result = mysqli_query($conect,$sql);
$totol = 0;
while($rowfinal = mysqli_fetch_array($result)){
    $totol += $rowfinal['count'];
}
echo $totol;

/*$sql = "INSERT INTO cart (`userid`,`PDid`) VALUES ('$userid','$PDid')";
mysqli_query($conect,$sql);
echo $PDid;*/
mysqli_close($conect);
?>