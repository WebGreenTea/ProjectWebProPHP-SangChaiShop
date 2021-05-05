<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "shop_db";

    $conect = mysqli_connect($servername,$username,$password,$dbname);

    if(!$conect){
        die("fail".mysqli_connect_error());
    }
?>