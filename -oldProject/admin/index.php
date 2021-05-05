<?php include('conectDB.php');
session_start();


if (isset($_GET['logout'])) { //logout
    session_destroy();
    unset($_SESSION['accessAdmin']);
    unset($_SESSION['id']);
    header('location: loginpage.php');
}

if (!isset($_SESSION['accessAdmin'])) {
    if (isset($_SESSION['accessEM'])) {
        header('location: orderlist.php');
    }
    header('location: loginpage.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="stly.css">
    <title>Admin</title>
    <script>
        function colorbtn(x) {
            if (x == 3) {
                document.getElementById("btn3").style.color = "gray";
                document.getElementById("btn3").style.backgroundColor = "#CCE5FF";
            } else if (x == 2) {
                document.getElementById("btn2").style.color = "gray";
                document.getElementById("btn2").style.backgroundColor = "#CCE5FF";
            } else {
                document.getElementById("btn1").style.color = "gray";
                document.getElementById("btn1").style.backgroundColor = "#CCE5FF";
            }

        }
    </script>
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: wheat;">
            <a class="navbar-brand">Admin</a>



        </nav>
    </header>
    <div class="" style="margin: 0px">
        <div class="row" style="margin-top: 20px;">
            <div class="col-md-2">
                <div class="list-group">
                    <a href="index.php?product=1" class="list-group-item list-group-item-action list-group-item-primary">จัดการสิ้นค้า</a>
                    <a href="index.php?employee=1" class="list-group-item list-group-item-action list-group-item-secondary">จัดการพนักงาน</a>
                    <a href="index.php?order=1" class="list-group-item list-group-item-action list-group-item-success">จัดการการขาย</a>
                    <a href="index.php?logout=1" class="logoutbtnAdmin">ออกจากระบบ</a>

                </div>
            </div>
            <div class="col-md-8">
                <?php if (isset($_GET['product'])) : ?>
                    <div style="margin: 10px;">
                        <a href="addproduct.php" class="addPD">เพิ่มสินค้าใหม่ +</a>
                    </div>
                    <div class="orderby">
                        <p>
                            เรียงตาม:
                            <a class="orderbybtn" href="index.php?product=1&orderby=name" id="btn1">ชื่อ</a>
                            <a class="orderbybtn" href="index.php?product=1&orderby=count" id="btn2">จำนวน</a>
                            <a class="orderbybtn" href="index.php?product=1&orderby=id" id="btn3">ID</a>
                        </p>

                    </div>
                    <table>
                        <tr>
                            <th class="tdH" style="width: 50px;">
                                <p class="tablehead">ID</p>
                            </th>
                            <th class="tdH" style="width: 400px;">
                                <p class="tablehead">สินค้า</p>
                            </th>
                            <th class="tdH" style="width: 100px;">
                                <p class="tablehead">ยี่ห้อ</p>
                            </th>
                            <th class="tdH" style="width: 200px;">
                                <p class="tablehead">ประเภท</p>
                            </th>
                            <th class="tdH" style="width: 100px; text-align:center;">
                                <p class="tablehead">ราคาต่อชิน</p>
                            </th>
                            <th class="tdH" style="width: 100px;text-align:center;">
                                <p class="tablehead">จำนวน</p>
                            </th>
                            <th class="tdH" style="width: 80px;text-align:center;">
                                <p class="tablehead">ภาพ</p>
                            </th>
                            <th class="tdH" style="width: 180px;text-align:center;">
                                <p class="tablehead">ข้อมูลหน้าร้านค้า</p>
                            </th>
                        </tr>
                        <?php
                        if (isset($_GET['orderby']) && $_GET['orderby'] == "name") {
                            $sql = "SELECT * FROM product ORDER BY PDname";
                            echo '<script type="text/javascript">',
                                'colorbtn(1);',
                                '</script>';
                        } elseif (isset($_GET['orderby']) && $_GET['orderby'] == "count") {
                            $sql = "SELECT * FROM product ORDER BY `count`";
                            echo '<script type="text/javascript">',
                                'colorbtn(2);',
                                '</script>';
                        } elseif (isset($_GET['orderby']) && $_GET['orderby'] == "id") {
                            $sql = "SELECT * FROM product ORDER BY `productid`";
                            echo '<script type="text/javascript">',
                                'colorbtn(3);',
                                '</script>';
                        } else {
                            $sql = "SELECT * FROM product";
                            echo '<script type="text/javascript">',
                                'colorbtn(3);',
                                '</script>';
                        }
                        $result = mysqli_query($conect, $sql);

                        ?>
                        <?php while ($rowPD = mysqli_fetch_array($result)) { ?>
                            <tr>
                                <td>
                                    <!-- ID-->
                                    <div class="rowproduct">
                                        <?php echo $rowPD['productid'] ?>
                                    </div>
                                </td>
                                <td>
                                    <!-- ชื่อสินค้า-->
                                    <div class="rowproduct">
                                        <?php echo $rowPD['PDname'] ?>
                                    </div>
                                </td>
                                <td>
                                    <!--ยี่ห้อ-->
                                    <div class="rowproduct">
                                        <?php $brandid = $rowPD['brandid'] ?>
                                        <?php $sql = "SELECT pdbrand FROM product_brand WHERE brandid=$brandid";
                                        $result2 = mysqli_query($conect, $sql);
                                        $rowbrand = mysqli_fetch_array($result2);
                                        ?>

                                        <?php echo $rowbrand['pdbrand'] ?>
                                    </div>
                                </td>
                                <td>
                                    <!--ประเภท-->
                                    <div class="rowproduct">
                                        <?php $typeid = $rowPD['typeid'];
                                        $sql = "SELECT pdtype FROM product_type WHERE typeid=$typeid";
                                        $result2 = mysqli_query($conect, $sql);
                                        $rowtype = mysqli_fetch_array($result2);
                                        ?>

                                        <?php echo $rowtype['pdtype'] ?>
                                    </div>
                                </td>
                                <td>
                                    <!-- ราคา-->
                                    <div class="rowproduct" style="text-align: center;">
                                        <?php echo $rowPD['price'] ?>
                                    </div>
                                </td>
                                <td>
                                    <!--จำนวน-->
                                    <div class="rowproduct" style="text-align: center;">
                                        <?php echo $rowPD['count'] ?>
                                    </div>
                                </td>
                                <td>
                                    <!--ภาพ-->
                                    <div class="rowproduct" style="text-align: center;">
                                        <?php if (is_null($rowPD['picture']) || $rowPD['picture'] == "") : ?>
                                            <img src="img/cross.jpg" style="width: 20px; height:auto;">
                                        <?php else : ?>
                                            <img src="img/cheack.png" style="width: 20px; height:auto;">
                                        <?php endif ?>
                                    </div>
                                </td>
                                <td>
                                    <!--ข้อมูลในหน้าร้านค้า-->
                                    <div class="rowproduct" style="text-align: center;">
                                        <?php if (is_null($rowPD['info']) || $rowPD['info'] == "") : ?>
                                            <img src="img/cross.jpg" style="width: 20px; height:auto;">
                                        <?php else : ?>
                                            <img src="img/cheack.png" style="width: 20px; height:auto;">
                                        <?php endif ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="rowproduct">
                                        <!--ปุ่มแก้ไข-->
                                        <button class="editbtn" onclick="window.location.href='editproduct.php?id=<?php echo $rowPD['productid'] ?>';">แก้ไข</button>
                                    </div>
                                </td>
                                <td>
                                    <div class="rowproduct">
                                        <!--ปุ่มลบ-->
                                        <button type="button" class="editbtn" onclick="window.location.href='remove_product.php?id=<?php echo $rowPD['productid'] ?>';">ลบ</button>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                <?php elseif (isset($_GET['employee'])) : ?>
                    <div style="margin: 10px;">
                        <a href="addemployee.php" class="addPD">เพิ่มข้อมูลพนักงาน +</a>
                    </div>
                    <div class="orderby">
                        <p>
                            เรียงตาม:
                            <a class="orderbybtn" href="index.php?employee=1&orderby=name" id="btn1">ชื่อ</a>
                            <a class="orderbybtn" href="index.php?employee=1&orderby=count" id="btn2">จำนวนงาน</a>
                            <a class="orderbybtn" href="index.php?employee=1&orderby=id" id="btn3">ID</a>
                        </p>

                    </div>
                    <table>
                        <tr>
                            <th class="tdH" style="width: 50px;">
                                <p class="tablehead">ID</p>
                            </th>
                            <th class="tdH" style="width: 300px;">
                                <p class="tablehead">ชื่อ</p>
                            </th>
                            <th class="tdH" style="width: 300px;">
                                <p class="tablehead">นามสกุล</p>
                            </th>
                            <th class="tdH" style="width: 100px;text-align:center;">
                                <p class="tablehead">เพศ</p>
                            </th>
                            <th class="tdH" style="width: 200px;text-align:center;">
                                <p class="tablehead">ตำแหน่ง</p>
                            </th>
                            <th class="tdH" style="width: 200px;text-align:center;">
                                <p class="tablehead">เบอร์โทร</p>
                            </th>
                            <th class="tdH" style="width: 100px;text-align:center;">
                                <p class="tablehead">จำนวนงาน</p>
                            </th>

                        </tr>
                        <?php
                        if (isset($_GET['orderby']) && $_GET['orderby'] == "name") {
                            $sql = "SELECT * FROM employee ORDER BY `name`";
                            echo '<script type="text/javascript">',
                                'colorbtn(1);',
                                '</script>';
                        } elseif (isset($_GET['orderby']) && $_GET['orderby'] == "count") {
                            $sql = "SELECT * FROM employee ORDER BY `countOrder`";
                            echo '<script type="text/javascript">',
                                'colorbtn(2);',
                                '</script>';
                        } elseif (isset($_GET['orderby']) && $_GET['orderby'] == "id") {
                            $sql = "SELECT * FROM employee ORDER BY `id`";
                            echo '<script type="text/javascript">',
                                'colorbtn(3);',
                                '</script>';
                        } else {
                            $sql = "SELECT * FROM employee";
                            echo '<script type="text/javascript">',
                                'colorbtn(3);',
                                '</script>';
                        }
                        $result = mysqli_query($conect, $sql);

                        ?>
                        <?php while ($rowEM = mysqli_fetch_array($result)) { ?>
                            <tr>
                                <td>
                                    <!-- ID-->
                                    <div class="rowproduct">
                                        <?php echo $rowEM['id'] ?>
                                    </div>
                                </td>
                                <td>
                                    <!-- ชื่อ-->
                                    <div class="rowproduct">
                                        <?php echo $rowEM['name'] ?>
                                    </div>
                                </td>
                                <td>
                                    <!--นามสกุล-->
                                    <div class="rowproduct">
                                        <?php echo $rowEM['lastname'] ?>
                                    </div>
                                </td>
                                <td>
                                    <!--เพศ-->
                                    <div class="rowproduct" style="text-align: center;">
                                        <?php echo $rowEM['gender'] ?>
                                    </div>
                                </td>
                                <td>
                                    <!--ตำแหน่ง-->
                                    <div class="rowproduct" style="text-align: center;">
                                        <?php echo $rowEM['EMstatus'] ?>
                                    </div>
                                </td>
                                <td>
                                    <!--Phone-->
                                    <div class="rowproduct" style="text-align: center;">
                                        <?php echo $rowEM['phone'] ?>
                                    </div>
                                </td>
                                <td>
                                    <!--จำนวนงาน-->
                                    <div class="rowproduct" style="text-align: center;">
                                        <?php echo $rowEM['countOrder'] ?>
                                    </div>
                                </td>

                                <td>
                                    <div class="rowproduct">
                                        <!--ปุ่มแก้ไข-->
                                        <button type="button" class="editbtn" onclick="window.location.href='editemployee.php?id=<?php echo $rowEM['id'] ?>';">แก้ไข</button>
                                    </div>
                                </td>
                                <td>
                                    <div class="rowproduct">
                                        <!--ปุ่มลบ-->
                                        <button type="button" class="editbtn" onclick="window.location.href='remove_employee.php?id=<?php echo $rowEM['id'] ?>';">ลบ</button>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                <?php elseif (isset($_GET['order'])) : ?>
                    <div class="orderby">
                    <p>
                        สถานะ:
                        <a class="orderbybtn" href="index.php?order=1&show=all" id="btn1">ทั้งหมด</a>
                        <a class="orderbybtn" href="index.php?order=1&show=inprocess" id="btn2">กำลังดำเนินการ</a>
                        <a class="orderbybtn" href="index.php?order=1&show=complete" id="btn3">ส่งแล้ว</a>
                    </p>
                    <?php
                    if (isset($_GET['show']) && $_GET['show'] == "all") {
                        $sql = "SELECT * FROM sell ORDER BY sellid DESC";
                        echo '<script type="text/javascript">',
                            'colorbtn(1);',
                            '</script>';
                    } elseif (isset($_GET['show']) && $_GET['show'] == "inprocess") {
                        $sql = "SELECT * FROM sell WHERE `status`='กำลังดำเนินการ' ORDER BY sellid DESC";
                        echo '<script type="text/javascript">',
                            'colorbtn(2);',
                            '</script>';
                    } elseif (isset($_GET['show']) && $_GET['show'] == "complete") {
                        $sql = "SELECT * FROM sell WHERE `status`='ส่งแล้ว' ORDER BY sellid DESC";
                        echo '<script type="text/javascript">',
                            'colorbtn(3);',
                            '</script>';
                    } else {
                        $sql = "SELECT * FROM sell ORDER BY sellid DESC";
                        echo '<script type="text/javascript">',
                            'colorbtn(1);',
                            '</script>';
                    }

                    ?>

                </div>
                    <?php
                    
                    $resultsell = mysqli_query($conect, $sql);
                    ?>
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
                                    <tr>
                                        <td class="tdnonborder"></td>
                                        <td class="tdnonborder"></td>
                                        <td class="tdnonborder"></td>
                                        <td class="tdnonborder"></td>
                                        <td class="tdnonborder"></td>
                                        <td class="tdnonborder"></td>
                                        <td class="tdnonborder"></td>
                                        <td class="tdnonborder" style="text-align: right;font-weight: bold; font-size: 12px">พนักงานผู้รับผิดชอบ:</td>
                                        <?php $emid =  $rowsell['idEmployee'];
                                        $sql = "SELECT * FROM employee WHERE id=$emid";
                                        $resultem = mysqli_query($conect, $sql);
                                        $emrow = mysqli_fetch_array($resultem);

                                        ?>
                                        <td class="tdnonborder" style="text-align:center;"><?php echo $emrow['name'] ?> <?php echo $emrow['lastname'] ?></td>

                                    </tr>
                                </table>

                            </div>
                            <div class="btndiv">
                                <a class="delbtn" href="removeOrder.php?id=<?php echo $rowsell['sellid'] ?>&status=<?php echo $rowsell['status'] ?>">ลบ</a>
                            </div>
                        </div>
                    <?php } ?>


                <?php endif ?>
            </div>
        </div>
    </div>
    <script src="js/jquery-3.5.1.slim.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

</body>

</html>