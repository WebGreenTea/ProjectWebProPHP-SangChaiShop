<?php
include('../conectDB.php');
$userid = $_GET['userid'];
//$pdid = $_POST['pdid'];
//$count = $_POST['count'];


/*//find employee for this order
$sql = "SELECT * FROM employee WHERE EMstatus='พนักงานส่ง' ORDER BY countOrder";
$result = mysqli_query($conect,$sql);
$row = mysqli_fetch_array($result);
$employee = $row['id'];
$countorder = $row['countOrder'] + 1;
$sql = "UPDATE employee SET countOrder=$countorder WHERE id=$employee";
mysqli_query($conect,$sql);*/

//get current address of user
$sql = "SELECT address FROM user_data WHERE userid=$userid";
$address = mysqli_query($conect,$sql);
$address = mysqli_fetch_array($address)['address'];

//save to sell table
$date = date("d")."/".date("m")."/".date("Y");
$sql = "INSERT INTO `sell` (`userid`, `date`,`status`,`address`) VALUES ('$userid','$date','กำลังดำเนินการ','$address')";

//call back id of sell
if(mysqli_query($conect,$sql)){
    $last_id = mysqli_insert_id($conect);
}
echo $last_id;
?>