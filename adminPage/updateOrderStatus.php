<?php
session_start();
include('../conectDB.php');
if (!(isset($_SESSION['identity']) && $_SESSION['identity'] == "admin")) {
    header('location: ../index.php');
}

if (isset($_GET['submit'])) {
    $url = $_GET['url'];
    if (isset($_GET['success'])) {
        $sellid = $_GET['success'];
        $sql = "UPDATE `sell` SET `status`='ส่งแล้ว' WHERE sellid=$sellid";
        mysqli_query($conect, $sql);
    } elseif (isset($_GET['cancel'])) {
        $sellid = $_GET['cancel'];
        $sql = "UPDATE `sell` SET `status`='รายการนี้ถูกยกเลิก' WHERE sellid=$sellid";
        mysqli_query($conect, $sql);
    }
    if (isset($_GET['show'])) {
        $show = $_GET['show'];
        $location = "location: $url";
        header($location);
    }else{
        $location = "location: $url";
        header($location);
    }
}else{
    header('location: adminPageOrder.php?');
}
