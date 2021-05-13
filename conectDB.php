<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "shop_db";

    $conect = mysqli_connect($servername,$username,$password,$dbname);
    mysqli_set_charset($conect, "utf8");
    if(!$conect){
        die("fail".mysqli_connect_error());
    }
?>