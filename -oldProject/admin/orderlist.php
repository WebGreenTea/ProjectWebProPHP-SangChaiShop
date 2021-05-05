<?php include('conectDB.php');
session_start();

if (isset($_GET['logout'])) { //logout
    session_destroy();
    unset($_SESSION['accessEM']);
    unset($_SESSION['id']);
    header('location: loginpage.php');
}
if (!isset($_SESSION['accessEM'])) {
    header('location: loginpage.php');
}
$id = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="stly.css">
    <title>OrderList</title>
    <script>
        function colorbtn(x) {
            if (x == 1) {
                document.getElementById("btn1").style.color = "gray";
                document.getElementById("btn1").style.backgroundColor = "#CCE5FF";
            } else {
                document.getElementById("btn2").style.color = "gray";
                document.getElementById("btn2").style.backgroundColor = "#CCE5FF";
            }

        }
    </script>
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: wheat;">
            <a class="navbar-brand">OrderList</a>
        </nav>
    </header>
    <div class="" style="margin: 0px">
        <div class="row" style="margin-top: 20px;">
            <div class="col-md-2">
                <a href="orderlist.php?logout=1" class="logoutbtn">ออกจากระบบ</a>
            </div>
            <div class="col-md-8">
                <div class="orderby">
                    <p>
                        สถานะ:
                        <a class="orderbybtn" href="orderlist.php?show=inprocess" id="btn1">กำลังดำเนินการ</a>
                        <a class="orderbybtn" href="orderlist.php?show=complete" id="btn2">ส่งแล้ว</a>
                    </p>
                    <?php
                    if (isset($_GET['show']) && $_GET['show'] == "inprocess") {
                        $sql = "SELECT * FROM sell WHERE `idEmployee`=$id AND `status`='กำลังดำเนินการ'";
                        echo '<script type="text/javascript">',
                            'colorbtn(1);',
                            '</script>';
                    } elseif (isset($_GET['show']) && $_GET['show'] == "complete") {
                        $sql = "SELECT * FROM sell WHERE `idEmployee`=$id AND `status`='ส่งแล้ว'";
                        echo '<script type="text/javascript">',
                            'colorbtn(2);',
                            '</script>';
                    } else {
                        $sql = "SELECT * FROM sell WHERE `idEmployee`=$id AND `status`='กำลังดำเนินการ'";
                        echo '<script type="text/javascript">',
                            'colorbtn(1);',
                            '</script>';
                    }

                    ?>

                </div>
                <?php

                $resultsell = mysqli_query($conect, $sql);
                ?>
                <?php if (mysqli_num_rows($resultsell) >= 1) : ?>
                    <?php while ($rowsell = mysqli_fetch_array($resultsell)) { ?>
                        <div class="orderout">
                            <div style="margin-bottom: 10px;">

                                <table style="background-color: white;">
                                    <tr>
                                        <th class="tdH" style="width: 100px;">
                                            <p class="tablehead">Order ID</p>
                                        </th>
                                        <th class="tdH" style="width: 400px;">
                                            <p class="tablehead">ผู้สั่ง</p>
                                        </th>
                                        <th class="tdH" style="width: 300px;">
                                            <p class="tablehead">ที่อยู่จัดส่ง</p>
                                        </th>
                                        <th class="tdH" style="width: 200px;text-align:center;">
                                            <p class="tablehead">เบอร์โทร</p>
                                        </th>
                                        <th class="tdH" style="width: 100px;text-align:center;">
                                            <p class="tablehead">วันที่</p>
                                        </th>
                                        <th class="tdH" style="width: 300px;text-align:center;">
                                            <p class="tablehead">สินค้า</p>
                                        </th>
                                        <th class="tdH" style="width: 200px;text-align:center;">
                                            <p class="tablehead">ราคา</p>
                                        </th>
                                        <th class="tdH" style="width: 200px;text-align:center;">
                                            <p class="tablehead">จำนวน</p>
                                        </th>
                                        <th class="tdH" style="width: 200px;text-align:center;">
                                            <p class="tablehead">ราคารวม</p>
                                        </th>
                                    </tr>


                                    <tr>
                                        <td class="tdnonborder">
                                            <!-- Order ID-->
                                            <div class="rowproduct">
                                                <?php echo $rowsell['sellid'] ?>
                                            </div>
                                        </td>
                                        <td class="tdnonborder">
                                            <!-- ผู้สั่ง-->
                                            <?php $userid = $rowsell['userid'];
                                            $sql = "SELECT * FROM user_data WHERE userid=$userid";
                                            $resultuser = mysqli_query($conect, $sql);
                                            $rowuser = mysqli_fetch_array($resultuser);
                                            ?>
                                            <div class="rowproduct">
                                                <?php echo $rowuser['name'] ?> <?php echo $rowuser['lastname'] ?> <br>(<?php echo $rowuser['username'] ?>)
                                            </div>
                                        </td>
                                        <td class="tdnonborder">
                                            <!-- ที่อยู่-->
                                            <div class="rowproduct">
                                                <?php echo $rowuser['address'] ?>
                                            </div>
                                        </td>
                                        <td class="tdnonborder">
                                            <!--เบอร์-->
                                            <div class="rowproduct" style="text-align:center;">
                                                0<?php echo $rowuser['PhonNumber'] ?>
                                            </div>
                                        </td>
                                        <td class="tdnonborder">
                                            <!--วันที่-->
                                            <div class="rowproduct">
                                                <?php echo $rowsell['date'] ?>
                                            </div>
                                        </td>
                                        <?php $sumorder = 0; ?>
                                        <!--row 1 of sellinfo-->
                                        <?php $sellid = $rowsell['sellid'];
                                        $sql = "SELECT * FROM sellinfo WHERE sellid=$sellid";
                                        $resultsellinfo = mysqli_query($conect, $sql);
                                        $rowsellinfo = mysqli_fetch_array($resultsellinfo);
                                        $pdid = $rowsellinfo['pdid'];
                                        $sql = "SELECT * FROM product WHERE productid=$pdid";
                                        $resultPD = mysqli_query($conect, $sql);
                                        $rowPD = mysqli_fetch_array($resultPD);
                                        ?>
                                        <td>
                                            <div class="rowproduct" style="text-align:center;">
                                                <?php echo $rowPD['PDname'] ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="rowproduct" style="text-align:center;">
                                                <?php echo $rowsellinfo['price'] ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="rowproduct" style="text-align:center;">
                                                <?php echo $rowsellinfo['count'] ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="rowproduct" style="text-align:center;">
                                                <?php echo $rowsellinfo['count'] * $rowsellinfo['price'] ?>
                                                <?php $sumorder += ($rowsellinfo['count'] * $rowsellinfo['price']); ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <!--row 2++ of sellinfo-->
                                    <?php while ($rowsellinfo = mysqli_fetch_array($resultsellinfo)) { ?>
                                        <?php $pdid = $rowsellinfo['pdid'];
                                        $sql = "SELECT * FROM product WHERE productid=$pdid";
                                        $resultPD = mysqli_query($conect, $sql);
                                        $rowPD = mysqli_fetch_array($resultPD); ?>
                                        <tr>
                                            <td class="tdnonborder"></td>
                                            <td class="tdnonborder"></td>
                                            <td class="tdnonborder"></td>
                                            <td class="tdnonborder"></td>
                                            <td class="tdnonborder"></td>
                                            <td>
                                                <div class="rowproduct" style="text-align:center;">
                                                    <?php echo $rowPD['PDname'] ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="rowproduct" style="text-align:center;">
                                                    <?php echo $rowsellinfo['price'] ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="rowproduct" style="text-align:center;">
                                                    <?php echo $rowsellinfo['count'] ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="rowproduct" style="text-align:center;">
                                                    <?php echo $rowsellinfo['count'] * $rowsellinfo['price'] ?>
                                                    <?php $sumorder += ($rowsellinfo['count'] * $rowsellinfo['price']); ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td class="tdnonborder"></td>
                                        <td class="tdnonborder"></td>
                                        <td class="tdnonborder"></td>
                                        <td class="tdnonborder"></td>
                                        <td class="tdnonborder"></td>
                                        <td class="tdnonborder"></td>
                                        <td class="tdnonborder"></td>
                                        <td class="tdnonborder" style="text-align: right;font-weight: bold;">ยอดรววม:</td>
                                        <td class="tdnonborder" style="text-align:center;"><?php echo $sumorder ?></td>
                                    </tr>
                                    <tr>
                                        <td class="tdnonborder"></td>
                                        <td class="tdnonborder"></td>
                                        <td class="tdnonborder"></td>
                                        <td class="tdnonborder"></td>
                                        <td class="tdnonborder"></td>
                                        <td class="tdnonborder"></td>
                                        <td class="tdnonborder"></td>
                                        <td class="tdnonborder" style="text-align: right;font-weight: bold;">สถานะ:</td>
                                        <?php if ($rowsell['status'] == "กำลังดำเนินการ") : ?>
                                            <td class="tdnonborder" style="text-align:center;color: #ff8000;"><?php echo $rowsell['status'] ?></td>
                                        <?php else : ?>
                                            <td class="tdnonborder" style="text-align:center;color: #28a745;"><?php echo $rowsell['status'] ?></td>
                                        <?php endif ?>
                                    </tr>
                                </table>
                            </div>
                            <?php if ($rowsell['status'] == "กำลังดำเนินการ") : ?>
                            <div class="btndiv">
                                <a class="combtn" href="order_success.php?id=<?php echo $rowsell['sellid'] ?>">ส่งแล้ว</a>
                            </div>
                            <?php endif?>
                        </div>
                    <?php } ?>
                <?php else : ?>
                    <p class="emcartP">ไม่มีรายการ </p>
                <?php endif ?>
            </div>
        </div>
    </div>
    <script src="js/jquery-3.5.1.slim.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

</body>

</html>