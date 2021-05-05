<?php
session_start();
include('../conectDB.php');
if (isset($_GET['logout'])) { //logout
    session_destroy();
    unset($_SESSION['username']);
    unset($_SESSION['userid']);
    header('location: index.php');
}
if (!isset($_SESSION['userid'])) { //if not in login
    header('location: ../loginPage.php');
}
$userid = $_SESSION['userid'];
$sql = "SELECT * FROM `sell` WHERE `userid`=$userid ORDER BY `sellid` DESC";
$resultsell =  mysqli_query($conect, $sql);
$rowofsell = mysqli_fetch_array($resultsell);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyOrder</title>
    <link rel="stylesheet" href="stly.css">
</head>

<body>
    <nav class="topbar">
        <ul>
            <li id="homeli"><a href="../index.php">กลับหน้าหลัก</a></li>
            <li class="topbarli2"><a class="usermenu" href="#"><?php echo $_SESSION['username'] ?></a>
                <ul class="ulsubtopbtn">
                    <li class="subtopbarli"><a href="../userinfo/myaccount.php" class="subbtnsign">บัญชีของฉัน</a></li>
                    <li class="subtopbarli"><a href="my_order.php" class="subbtnsign">ประวัติการสั่งซื้อ</a></li>
                    <li class="subtopbarli"><a href="../index.php?logout='1'" class="subbtnsign">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div class="maindiv">
        <?php if ($rowofsell) : //ถ้ามีประวัติการซื้อ
        ?>
            <?php do { ?>
                <?php $sellid = $rowofsell['sellid'] ?>
                <?php $sql = "SELECT * FROM  `sellinfo` WHERE `sellid`=$sellid";
                $resulsellinfo = mysqli_query($conect, $sql);
                ?>
                <br><br>
                <div class="roworder">
                    <table id="table">
                        <tr>
                            <td class="tdDateorder" colspan="4">วันที่สั่ง : <?php echo $rowofsell['date'] ?></td>
                        </tr>
                        <tr>
                            <th class="tdH" style="width: 400px;">
                                <p class="tablehead">สินค้า</p>
                            </th>
                            <th class="tdH" style="width: 100px;">
                                <p class="tablehead">ราคาต่อชิน</p>
                            </th>
                            <th class="tdH" style="width: 100px;">
                                <p class="tablehead">จำนวน</p>
                            </th>
                            <th class="tdH" style="width: 100px;">
                                <p class="tablehead">ราคารวม</p>
                            </th>
                        </tr>
                        <?php $sumprice = 0 ?>
                        <?php while ($rowofsellinfo = mysqli_fetch_array($resulsellinfo)) { ?>
                            <?php $pdid = $rowofsellinfo['pdid'];
                            $sql = "SELECT * FROM `product` WHERE productid=$pdid";
                            $resultpd = mysqli_query($conect, $sql);
                            $rowPD = mysqli_fetch_array($resultpd); ?>
                            <tr>
                                <td>
                                    <div class="frampicorder">
                                        <?php if (is_null($rowPD['picture']) || $rowPD['picture'] == "") {
                                            $imgurl = "ไม่มีภาพ";
                                            echo $imgurl;
                                        } else {
                                            $imgurl = '../productPic/' . $rowPD['picture'];
                                        } ?>
                                        <img src="<?php echo $imgurl; ?>" class="picinorder">
                                    </div>
                                    <div class="framnameorder">
                                        <label class="PDnameorder"><?php echo $rowPD['PDname'] ?></label>
                                    </div>
                                </td>
                                <td><label class="PDprice"><?php echo $rowofsellinfo['price'] ?></label></td>
                                <td><label>x<?php echo $rowofsellinfo['count'] ?></label></td>
                                <td><label class="pricesum"><?php echo $rowofsellinfo['count'] * $rowofsellinfo['price'] ?></label></td>
                                <?php $sumprice += ($rowofsellinfo['count'] * $rowofsellinfo['price']) ?>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>ยอดรวม : </td>
                            <td>
                                <p class="smuprice"><?php echo $sumprice ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>สถานะ : </td>
                            <td>
                                <?php if ($rowofsell['status'] == "กำลังดำเนินการ") : ?>
                                    <p class="statusP"><?php echo $rowofsell['status'] ?>...</p>
                                <?php else : ?>
                                    <p class="statusS"><?php echo $rowofsell['status'] ?></p>
                                <?php endif ?>
                            </td>
                        </tr>
                    </table>
                </div>

            <?php } while ($rowofsell = mysqli_fetch_array($resultsell)) ?>
        <?php else : //ถ้าไม่มีประวัติการซื้อ 
        ?>
            <p>คุณยังไม่มีประวัติการซื้อ</p>
        <?php endif ?>
    </div>
</body>

</html>