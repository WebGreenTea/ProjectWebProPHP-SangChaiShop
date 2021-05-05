<?php 
include('conectDB.php');
$sellid = $_GET['id'];
$status = $_GET['status'];

if($status == "กำลังดำเนินการ"){
    //ลบงานของพนักงานออก1
    $sql = "SELECT idEmployee FROM sell WHERE sellid=$sellid";
    $result = mysqli_query($conect,$sql);
    $row = mysqli_fetch_array($result);
    $employeeid = $row['idEmployee'];

    $sql = "SELECT countOrder FROM employee WHERE id=$employeeid";
    $result = mysqli_query($conect,$sql);
    $row = mysqli_fetch_array($result);
    $count = $row['countOrder'];
    $count -= 1;

    $sql = "UPDATE employee SET countOrder=$count WHERE id=$employeeid";
    mysqli_query($conect,$sql);
}



//ลบ Order
$sql = "DELETE FROM sell WHERE sellid=$sellid";
mysqli_query($conect,$sql);
$sql = "DELETE FROM sellinfo WHERE sellid=$sellid";
mysqli_query($conect,$sql);

header('location: index.php?order=1');

?>