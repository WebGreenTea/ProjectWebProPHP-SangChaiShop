<?php
session_start();
include('conectDB.php');
if (!isset($_SESSION['userid'])) {
    header('location: index.php');
}
$userid = $_SESSION['userid'];
 if (isset($_GET['oldFirst'])) {
    $sql = "SELECT * FROM `sell` WHERE `userid`=$userid ORDER BY `sellid`";
 }
else{
    $sql = "SELECT * FROM `sell` WHERE `userid`=$userid ORDER BY `sellid` DESC";
}

$resultsell =  mysqli_query($conect, $sql);
$rowofsell = mysqli_fetch_array($resultsell);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyOrder</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark justify-content-between flex-nowrap flex-row">
        <div class="container">
            <a href="index.php" class="navbar-brand float-left">Sangchai SHOP</a>
            <!--<div class="collapse navbar-collapse nav justify-content-end" id="navbarDropdown">-->

            <div class="row">
                <div class=" col-lg-6 d-flex justify-content-end p-0">
                    <?php if (isset($_SESSION['userid'])) {  //get count in cart
                        $usid = $_SESSION['userid'];
                        $sqlcart = "SELECT * FROM cart WHERE userid=$usid";
                        $re = mysqli_query($conect, $sqlcart);
                        if (mysqli_num_rows($re) == 1) {
                            $rowcart = mysqli_fetch_array($re);
                            $cartid = $rowcart['cartid'];

                            $sqlcart = "SELECT * FROM cartINFO WHERE cartid=$cartid";
                            $re = mysqli_query($conect, $sqlcart);
                            $countcart = 0;
                            while ($rowcart = mysqli_fetch_array($re)) {
                                $countcart += $rowcart['count'];
                            }
                        } else {
                            $countcart = 0;
                        }
                    } else {
                        $countcart = 0;
                    }
                    ?>
                    <a href="cart.php" class="nav-link text-light"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                        </svg>(<label id="cart"><?php echo $countcart; ?></label>)</a>
                </div>
                <div class="dropdown col-lg-6 d-flex justify-content-start p-0">
                    <a class="nav-link text-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $_SESSION['username'] ?>
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <li><a class="dropdown-item" href="myaccountinfo.php">ตั้งค่าข้อมูลส่วนตัว</a></li>
                        <li><a class="dropdown-item" href="index.php?logout='1'">Logout</a></li>
                    </ul>
                </div>

            </div>

            <!--</div>-->
        </div>
    </nav>
    <div class="container mt-5">
        <div class="d-flex justify-content-center mb-3">
            <h2>ประวัติการสั่งซื้อของฉัน</h2>
        </div>
        เรียงจาก: 
        <?php if (isset($_GET['oldFirst'])) : ?>
            <a href="order_history.php" class="btn btn-dark">ล่าสุด-เก่าสุด</a>
            <a href="order_history.php?oldFirst=1" class="btn btn-secondary">เก่าสุด-ล่าสุด</a>
        <?php else : ?>
            <a href="order_history.php" class="btn btn-secondary">ล่าสุด-เก่าสุด</a>
            <a href="order_history.php?oldFirst=1" class="btn btn-dark">เก่าสุด-ล่าสุด</a>
        <?php endif ?>
        <div>
            <?php if ($rowofsell) : //ถ้ามีประวัติการซื้อ
            ?>
                <?php do { ?>
                    <?php $sellid = $rowofsell['sellid'] ?>
                    <?php $sql = "SELECT *,price*count  AS total FROM  `sellinfo` WHERE `sellid`=$sellid";
                    $resulsellinfo = mysqli_query($conect, $sql);
                    ?>
                    <div class="row">
                        <div class="col-md-12 mt-5">
                            วันที่สั่ง : <?php echo $rowofsell['date'] ?>
                        </div>
                    </div>
                    <?php if ($rowofsell['status'] == "กำลังดำเนินการ") : ?>
                        <div class="row bg-warning">
                            <div class="col-md-5 d-flex justify-content-center border">
                                ชื่อสินค้า
                            </div>
                            <div class="col-md-2 d-flex justify-content-center border">
                                ราคาต่อชิ้น
                            </div>
                            <div class="col-md-2 d-flex justify-content-center border">
                                จำนวนที่สั่งซื้อ
                            </div>
                            <div class="col-md-3 d-flex justify-content-center border">
                                ราคารวม
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="row bg-success text-light">
                            <div class="col-md-5 d-flex justify-content-center border">
                                ชื่อสินค้า
                            </div>
                            <div class="col-md-2 d-flex justify-content-center border">
                                ราคาต่อชิ้น
                            </div>
                            <div class="col-md-2 d-flex justify-content-center border">
                                จำนวนที่สั่งซื้อ
                            </div>
                            <div class="col-md-3 d-flex justify-content-center border">
                                ราคารวม
                            </div>
                        </div>
                    <?php endif ?>
                    <?php $total = 0; ?>
                    <?php while ($rowsellinfo = mysqli_fetch_array($resulsellinfo)) {
                    ?>
                        <?php
                        $PDID = $rowsellinfo['pdid'];
                        $sql = "SELECT PDname FROM `product` WHERE productid=$PDID";
                        $productName = mysqli_query($conect, $sql);
                        $productName = mysqli_fetch_array($productName)['PDname'];
                        ?>
                        <div class="row">
                            <div class="col-md-5 d-flex justify-content-center border">
                                <?php echo $productName; ?>
                            </div>
                            <div class="col-md-2 d-flex justify-content-center border">
                                <?php echo number_format($rowsellinfo['price']); ?>
                            </div>
                            <div class="col-md-2 d-flex justify-content-center border">
                                <?php echo $rowsellinfo['count'] ?>
                            </div>
                            <div class="col-md-3 d-flex justify-content-center border">
                                <?php echo number_format($rowsellinfo['total']); ?>
                                <?php $total += $rowsellinfo['total']; ?>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="row">
                        <div class="col-md-9 d-flex justify-content-end p-1 border">
                            <h6>ราคารวมทั้งสิ้น:</h6>
                        </div>
                        <div class="col-md-3 d-flex justify-content-center border align-items-center">
                            <?php echo number_format($total) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9 d-flex justify-content-end p-1 border">
                            <h6>สถานะ:</h6>
                        </div>
                        <div class="col-md-3 d-flex justify-content-center border align-items-center">
                            <?php if ($rowofsell['status'] == "กำลังดำเนินการ") : ?>
                                <h5 class="text-warning"><?php echo $rowofsell['status'] ?></h5>
                            <?php else : ?>
                                <h5 class="text-success"><?php echo $rowofsell['status'] ?></h5>
                            <?php endif ?>
                        </div>
                    </div>
                <?php } while ($rowofsell = mysqli_fetch_array($resultsell)) ?>
            <?php else : //ถ้าไม่มีประวัติการซื้อ 
            ?>
                <div class="p-5 mt-5">
                    <h3 class="d-flex justify-content-center text-secondary">-- คุณยังไม่มีประวัติการซื้อ --</h3>
                </div>

            <?php endif ?>
        </div>

    </div>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

</html>