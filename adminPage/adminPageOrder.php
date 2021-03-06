<?php
session_start();
include('../conectDB.php');
if (!(isset($_SESSION['identity']) && $_SESSION['identity'] == "admin")) {
    header('location: ../index.php');
}

if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM sell WHERE sellid=$search";
} else {
    if (isset($_GET['show'])) {
        $show = $_GET['show'];
        if ($show == 1) {
            $sql = "SELECT * FROM sell WHERE status='กำลังดำเนินการ'";
        } elseif ($show == 2) {
            $sql = "SELECT * FROM sell WHERE status='ส่งแล้ว'";
        } elseif ($show == 3) {
            $sql = "SELECT * FROM sell WHERE status='รายการนี้ถูกยกเลิก' ";
        } else {
            $sql = "SELECT * FROM sell";
        }
    } else {
        $sql = "SELECT * FROM sell";
    }
    if (isset($_GET['orderby']) && $_GET['orderby']) {
        $sql .= " ORDER BY sellid DESC";
    }
}




//echo $sql;

//get sell data
$resultsell = mysqli_query($conect, $sql);

if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $url = "https://";
else
    $url = "http://";
// Append the host(domain name, ip) to the URL.   
$url .= $_SERVER['HTTP_HOST'];

// Append the requested resource location to the URL   
$url .= $_SERVER['REQUEST_URI'];

//echo $_GET['orderby'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark justify-content-between flex-nowrap flex-row">
        <div class="container">
            <a href="../" class="navbar-brand float-left">กลับหน้าร้านค้า</a>
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="adminPage.php" class="nav-link pr-3 active">จัดการสินค้า</a>
                </li>
                <li class="nav-item">
                    <a href="adminPageOrder.php" class="nav-link pr-3 ">จัดการรายการสั่งซื้อ</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mb-5">
        <h2 class="mt-5 d-flex justify-content-center mb-4"> -- จัดการรายการสั่งซื้อ -- </h2>
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                <?php if (isset($show)) : ?>

                    <?php if ($show == 1) : ?>
                        <a href="adminPageOrder.php" class="btn btn-dark me-1">แสดงทั้งหมด</a>
                        <a href="adminPageOrder.php?show=1" class="btn btn-outline-dark ms-1">แสดงเฉพาะที่รอดำเนินการ</a>
                        <a href="adminPageOrder.php?show=2" class="btn btn-dark ms-1">แสดงเฉพาะที่ส่งแล้ว</a>
                        <a href="adminPageOrder.php?show=3" class="btn btn-dark ms-1">แสดงเฉพาะที่ยกเลิกแล้ว</a>
                    <?php elseif ($show == 2) : ?>
                        <a href="adminPageOrder.php" class="btn btn-dark me-1">แสดงทั้งหมด</a>
                        <a href="adminPageOrder.php?show=1" class="btn btn-dark ms-1">แสดงเฉพาะที่รอดำเนินการ</a>
                        <a href="adminPageOrder.php?show=2" class="btn btn-outline-dark ms-1">แสดงเฉพาะที่ส่งแล้ว</a>
                        <a href="adminPageOrder.php?show=3" class="btn btn-dark ms-1">แสดงเฉพาะที่ยกเลิกแล้ว</a>
                    <?php else : ?>
                        <a href="adminPageOrder.php" class="btn btn-dark me-1">แสดงทั้งหมด</a>
                        <a href="adminPageOrder.php?show=1" class="btn btn-dark ms-1">แสดงเฉพาะที่รอดำเนินการ</a>
                        <a href="adminPageOrder.php?show=2" class="btn btn-dark ms-1">แสดงเฉพาะที่ส่งแล้ว</a>
                        <a href="adminPageOrder.php?show=3" class="btn btn-outline-dark ms-1">แสดงเฉพาะที่ยกเลิกแล้ว</a>
                    <?php endif ?>
                <?php else : ?>
                    <?php if (isset($search)) : ?>
                        <a href="adminPageOrder.php" class="btn btn-dark me-1">แสดงทั้งหมด</a>
                        <a href="adminPageOrder.php?show=1" class="btn btn-dark ms-1">แสดงเฉพาะที่รอดำเนินการ</a>
                        <a href="adminPageOrder.php?show=2" class="btn btn-dark ms-1">แสดงเฉพาะที่ส่งแล้ว</a>
                        <a href="adminPageOrder.php?show=3" class="btn btn-dark ms-1">แสดงเฉพาะที่ยกเลิกแล้ว</a>
                    <?php else : ?>
                        <a href="adminPageOrder.php" class="btn btn-outline-dark me-1">แสดงทั้งหมด</a>
                        <a href="adminPageOrder.php?show=1" class="btn btn-dark ms-1">แสดงเฉพาะที่รอดำเนินการ</a>
                        <a href="adminPageOrder.php?show=2" class="btn btn-dark ms-1">แสดงเฉพาะที่ส่งแล้ว</a>
                        <a href="adminPageOrder.php?show=3" class="btn btn-dark ms-1">แสดงเฉพาะที่ยกเลิกแล้ว</a>
                    <?php endif ?>
                <?php endif ?>
                <form class="d-flex mb-0 ms-2" action="" method="get">
                    <input class="form-control" type="number" placeholder="รหัสการสั่งซื้อ" name="search" required>
                    <button class="btn btn-outline-success" type="submit">ค้นหา</button>
                </form>
            </div>

        </div>

        <div class="row mt-5">
            <?php if (!isset($search)) : ?>
                <div class="col-md-12">
                    เรียงจาก:

                    <?php if (isset($_GET['orderby'])) : ?>
                        <a href="<?php
                                    if (isset($show)) {
                                        echo "adminPageOrder.php?show=" . $show;
                                    } else {
                                        echo "adminPageOrder.php";
                                    }
                                    ?>" class="btn btn-primary p-1">เก่าสุด-ล่าสุด</a>
                        <a href="" class="btn btn-outline-primary p-1">ล่าสุด-เก่าสุด</a>
                    <?php else : ?>
                        <a href="" class="btn btn-outline-primary p-1">เก่าสุด-ล่าสุด</a>
                        <a href="<?php if (isset($show)) {
                                        echo $url . "&orderby=1";
                                    } else {
                                        echo $url . "?orderby=1";
                                    } ?>" class="btn btn-primary p-1">ล่าสุด-เก่าสุด</a>
                    <?php endif ?>

                </div>
            <?php endif ?>
        </div>
        <?php if (mysqli_num_rows($resultsell) > 0) : ?>
            <?php while ($rowofsell = mysqli_fetch_array($resultsell)) { ?>
                <?php $sellid = $rowofsell['sellid'] ?>
                <?php $sql = "SELECT *,price*count  AS total FROM  `sellinfo` WHERE `sellid`=$sellid";
                $resulsellinfo = mysqli_query($conect, $sql);
                ?>
                <div class="row mt-2 border">
                    <div class="col-md-12 ">
                        วันที่สั่ง : <?php echo $rowofsell['date'] ?>
                        | รหัสการสั่งซื้อ : <?php echo $rowofsell['sellid'] ?>
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
                <?php elseif ($rowofsell['status'] == "ส่งแล้ว") : ?>
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
                <?php else : ?>
                    <div class="row bg-danger text-light">
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
                        <?php elseif ($rowofsell['status'] == "ส่งแล้ว") : ?>
                            <h5 class="text-success"><?php echo $rowofsell['status'] ?></h5>
                        <?php else : ?>
                            <h5 class="text-danger"><?php echo $rowofsell['status'] ?></h5>
                        <?php endif ?>
                    </div>
                </div>
                <div class="row border">
                    <div class="col-md-12 ">
                        ผู้สั่ง : <?php
                                    $userid = $rowofsell['userid'];
                                    $sql = "SELECT username,name,lastname,PhonNumber FROM user_data WHERE userid=$userid";
                                    $userdata = mysqli_query($conect, $sql);
                                    $userdata = mysqli_fetch_array($userdata);
                                    echo $userdata['name'] . " " . $userdata['lastname'] . " (" . $userdata['username'] . ")";
                                    ?>
                    </div>
                </div>
                <div class="row border">
                    <div class="col-md-12">
                        เบอร์โทรศัพท์ : <?php
                                        echo "0" . $userdata['PhonNumber']
                                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 border">
                        ที่อยู่ในการจัดส่ง :<br>
                        <div class="ms-5 me-5 mb-2">
                            <textarea name="" id="" class="form-control" rows="3" disabled><?php echo $rowofsell['address'] ?></textarea>
                        </div>
                    </div>
                </div>
                <?php if ($rowofsell['status'] == "กำลังดำเนินการ") : ?>
                    <div class="row border ">
                        <div class="col-md-12 d-flex justify-content-center">
                            <form action="updateOrderStatus.php" method="get">
                                <input type="hidden" value="<?php echo $url ?>" name="url">
                                <input type="hidden" value="<?php echo $rowofsell['sellid'] ?>" name="success">
                                <input type="submit" name="submit" value="จัดส่งสินค้ารายการนี้แล้ว" class="btn btn-success me-1" onClick="return confirm('รายการสั่งซื้อนี้ดำเนินการเสร็จสิ้นแล้ว?')">
                            </form>
                            <form action="updateOrderStatus.php" method="get">
                                <input type="hidden" value="<?php echo $url ?>" name="url">
                                <input type="hidden" value="<?php echo $rowofsell['sellid'] ?>" name="cancel">
                                <input type="submit" name="submit" value="ยกเลิกรายการสั่งซื้อนี้" class="btn btn-danger ms-1" onClick="return confirm('ต้องการที่จะยกเลิกรายการสั่งซื้อนี้?')">
                            </form>
                        </div>
                    </div>
                <?php endif ?>
                <div class="row mb-5"></div>
            <?php }  ?>
        <?php else : ?>
            <?php if (isset($search)) : ?>
                <h1 class="text-secondary d-flex justify-content-center">ไม่พบรหัสการสั่งซื้อที่ <?php echo $search ?></h1>
            <?php else : ?>
                <?php if ($show == 1) : ?>
                    <h1 class="text-secondary d-flex justify-content-center mt-5">ขณะนี้ไม่มีรายการสั่งซื้อที่รอดำเนินการ </h1>
                <?php elseif ($show == 2) : ?>
                    <h1 class="text-secondary d-flex justify-content-center mt-5">ขณะนี้ไม่มีรายการสั่งซื้อที่ส่งแล้ว </h1>
                <?php elseif ($show == 3) : ?>
                    <h1 class="text-secondary d-flex justify-content-center mt-5">ขณะนี้ไม่มีรายการสั่งซื้อที่ยกเลิกแล้ว </h1>
                <?php endif ?>
            <?php endif ?>
        <?php endif ?>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>

</html>