<?php session_start();
include('conectDB.php');

if (isset($_GET['logout'])) { //logout
    session_destroy();
    unset($_SESSION['username']);
    unset($_SESSION['userid']);
    header('location: index.php');
}
$sql = "SELECT `productid`, `PDname`, `price`, `count`,`picture` FROM `product`";
if (isset($_GET['infoPD'])) {
    $sql = "SELECT * FROM `product` WHERE productid=" . $_GET['infoPD'];
}
if ((isset($_GET['type'])) && (isset($_GET['brand']))) {
    $sql = "SELECT `productid`, `PDname`, `price`, `count`,`picture` FROM `product` WHERE typeid=" . $_GET['type'] . " AND brandid=" . $_GET['brand'];
} else if (isset($_GET['type'])) {
    $sql = "SELECT `productid`, `PDname`, `price`, `count`,`picture` FROM `product` WHERE typeid=" . $_GET['type'];
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop - Sangchi</title>
    <script src="js/jquery-3.5.1.min.js" ></script>
    <link rel="stylesheet" href="stly.css">
</head>

<body>
    <nav class="topbar">
        <ul>
            <li id="logo">SHOP</li>
            <?php if (isset($_SESSION['username'])) : ?>

                <li class="topbarli2"><a class="usermenu" href="#"><?php echo $_SESSION['username'] ?></a>
                    <ul class="ulsubtopbtn">
                        <li class="subtopbarli"><a href="userinfo/myaccount.php" class="subbtnsign">บัญชีของฉัน</a></li>
                        <li class="subtopbarli"><a href="vieworder/my_order.php" class="subbtnsign">ประวัติการสั่งซื้อ</a></li>
                        <li class="subtopbarli"><a href="index.php?logout='1'" class="subbtnsign">Logout</a></li>
                    </ul>
                </li>

            <?php else : ?>
                <li class="topbarli"><a href="registerPage.php" class="btnsign">Register</a></li>
                <li class="topbarli"><a href="loginpage.php" class="btnsign">Login</a></li>
            <?php endif ?>
        </ul>
    </nav>

    <div class="mainDiv">
        <div class="coverfram" align="center">
            <img src="cover4.png" alt="coverPage" height="280" width="auto" class="coverpic">
        </div>
        <div>
            <div class="topmenu">
                <div class="topmenuin" align="center">
                    <nav>
                        <ul>
                            <li class="topmenuli"><a href="index.php" class="btnmenu">หน้าแรก</a></li>
                            <li class="topmenuli"><a href="index.php?about='1'" class="btnmenu">ติดต่อร้าน</a></li>
                            <li class="topmenuli"><a href="index.php?howtobuy='1'" class="btnmenu">วิธีการสั่งซื้อ</a></li>
                            <?php if (isset($_SESSION['userid'])) : ?>
                                <li class="topmenuli"><a href="index.php?cart=1" class="btnmenu">รถเข็นของคุณ<img src="cart.png" width="17" height="17"></a></li>
                            <?php else : ?>
                                <li class="topmenuli"><a href="loginPage.php" class="btnmenu">รถเข็นของคุณ<img src="cart.png" width="17" height="17"></a></li>
                            <?php endif ?>

                        </ul>
                    </nav>
                    <?php if (isset($_SESSION['userid'])) {
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
                    <div class="countcart">
                        <p id="cart"><?php echo $countcart ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="menuleftDiv">
            <nav class="category">
                <center>หมวดหมู่สินค้า</center>
                <ul>
                    <li class="typeproduct"><a href="index.php?type=7"> ทีวี</a></li>
                    <li class="brandproduct"><a href="index.php?type=7&brand=1">LG</a></li>
                    <li class="brandproduct"><a href="index.php?type=7&brand=2">Samsung</a></li>
                    <li class="brandproduct"><a href="index.php?type=7&brand=3">Sony</a></li>
                    <li class="brandproduct"><a href="index.php?type=7&brand=4">Shap</a></li>
                    <li class="brandproduct"><a href="index.php?type=7&brand=5">Toshiba</a></li>
                    <li class="brandproduct"><a href="index.php?type=7&brand=6">Panasonic</a></li>
                    <li class="brandproduct"><a href="index.php?type=7&brand=7">Philips</a></li>

                    <li class="typeproduct"><a href="index.php?type=1">ตู้เย็น</a></li>
                    <li class="brandproduct"><a href="index.php?type=1&brand=8">Misubishi</a></li>
                    <li class="brandproduct"><a href="index.php?type=1&brand=9">Hitachi</a></li>
                    <li class="brandproduct"><a href="index.php?type=1&brand=4">Shap</a></li>
                    <li class="brandproduct"><a href="index.php?type=1&brand=5">Toshiba</a></li>
                    <li class="brandproduct"><a href="index.php?type=1&brand=6">Panasonic</a></li>

                    <li class="typeproduct"><a href="index.php?type=2">เครื่องซักผ้า</a></li>
                    <li class="brandproduct"><a href="index.php?type=2&brand=1">LG</a></li>
                    <li class="brandproduct"><a href="index.php?type=2&brand=9">Hitachi</a></li>
                    <li class="brandproduct"><a href="index.php?type=2&brand=5">Toshiba</a></li>
                    <li class="brandproduct"><a href="index.php?type=2&brand=6">Panasonic</a></li>
                    <li class="brandproduct"><a href="index.php?type=2&brand=4">Shap</a></li>

                    <li class="typeproduct"><a href="index.php?type=3">พัดลม</a></li>
                    <li class="brandproduct"><a href="index.php?type=3&brand=10">Hatari</a></li>
                    <li class="brandproduct"><a href="index.php?type=3&brand=4">Shap</a></li>

                    <li class="typeproduct"><a href="index.php?type=4">เครื่องปรับอากาศ</a></li>
                    <li class="brandproduct"><a href="index.php?type=4&brand=9">Hitachi</a></li>
                    <li class="brandproduct"><a href="index.php?type=4&brand=8">Misubishi</a></li>
                    <li class="brandproduct"><a href="index.php?type=4&brand=6">Panasonic</a></li>
                    <li class="brandproduct"><a href="index.php?type=4&brand=4">Shap</a></li>
                    <li class="brandproduct"><a href="index.php?type=4&brand=2">Samsung</a></li>
                    <li class="brandproduct"><a href="index.php?type=4&brand=5">Toshiba</a></li>

                    <li class="typeproduct"><a href="index.php?type=5">เตารีด</a></li>
                    <li class="brandproduct"><a href="index.php?type=5&brand=6">Panasonic</a></li>
                    <li class="brandproduct"><a href="index.php?type=5&brand=7">Philips</a></li>

                    <li class="typeproduct"><a href="index.php?type=6">ไมโครเวฟ</a></li>
                    <li class="brandproduct"><a href="index.php?type=6&brand=1">LG</a></li>
                    <li class="brandproduct"><a href="index.php?type=6&brand=6">Panasonic</a></li>
                    <li class="brandproduct"><a href="index.php?type=6&brand=4">Shap</a></li>
                    <li class="brandproduct"><a href="index.php?type=6&brand=5">Toshiba</a></li>
                </ul>
            </nav>
        </div>
        <div class="PDrightDiv">
            <?php if (isset($_GET['about'])) : ?>
                <!--info shop page-->
                <div class="aboutdiv">
                    <p class="pabout">
                        สั่งซื้อสินค้า / ติดต่อสอบถาม
                    </p>
                    <p class="pabout2">ที่อยู่ : 2101/11 ถนน พหลโยธิน แขวงลาดยาว เขต จตุจักร กทม 10900<br>
                        Tel. : 025794425 025790428 025797490 029411113 0909690360<br>
                        Email : kusangchai@hotmail.com</p>
                    <p class="pabout">แผนที่สำหรับการเดินทางมายังร้าน</p>
                    <p class="map"><img src="map.jpg" width="100%" height="auto"></p>
                    <p class="pabout3">ร้านตั้งในตลาดอมรพันธุ์ติดสี่แยกเกษตร-นวมินทร์ ถ้ามาจากเมเจอร์รัชโยธินตรงมาก่อนถึงแยกเกษตร100เมตร สั่งเกตุซ้ายมือจะมีร้านแว่นท๊อปเจริญเลยมาหน่อยให้เลี้ยวเข้าซอยได้เลย ทางเข้าขวามือจะเป็นร้านโดมิโนพิซซ่า
                        ที่จอดรถ : 2095/5-6 ซอย พหลโยธิน แขวง ลาดยาว เขตจตุจักร กรุงเทพมหานคร 10900<br>
                        ให้นำรถจอดที่หลังร้าน มาเบิกค่าจอดรถได้ที่ร้านแสงชัย<br>
                        แล้วเดินทางซ้ายมือจะมีซอยตลาดอมรพันธุ์เดินเข้าซอยประมาณ50เมตรจะมีร้านเครื่องใช้ไฟฟ้าสองร้าน ร้านที่สอง<br>
                        ชื่อร้านแสงชัยอีเล็คโทรนิค กรุณาดูชื่อร้านด้วยเนื่องจากมีสองร้านติดกัน</p>

                </div>
            <?php elseif (isset($_GET['infoPD'])) : ?>
                <!-- Info page-->
                <?php $product = mysqli_query($conect, $sql); ?>
                <?php $rowPD = mysqli_fetch_array($product) ?>
                <div class="divMaininfo">
                    <div class="infopage">
                        <div class="Fpicinfo">
                            <?php if (is_null($rowPD['picture']) || $rowPD['picture'] == "") {
                                $imgurl = "ไม่มีภาพ";
                                echo $imgurl;
                            } else {
                                $imgurl = 'productPic/' . $rowPD['picture'];
                            } ?>
                            <img src="<?php echo $imgurl; ?>" class="PDpicinfo">
                        </div>
                        <div class="nameprice">
                            <div class="namepriceIN">
                                <?php if ($rowPD['count'] == 0) : ?>
                                    <label class="PDnameinfo"><?php echo $rowPD['PDname'] ?></label><br>
                                    <label class="PDpriceinfo" id="outofstock">สินค้าหมด</label>
                                <?php else : ?>
                                    <label class="PDnameinfo"><?php echo $rowPD['PDname'] ?></label><br>
                                    <label class="PDpriceinfo"><?php echo $rowPD['price'] ?>.-</label>
                                    <ul>
                                        <?php if (isset($_SESSION['username'])) : ?>
                                            <li class="PDbtn"><button class="buybtn" id="addcart" onclick="addcart(this.value)" value="<?php echo $rowPD['productid'] ?>">ใส่รถเข็น <img src="cart.png" width="17" height="17"></button></li>
                                        <?php else : ?>
                                            <li class="PDbtn"><a href="loginpage.php" class="buybtn">ใส่รถเข็น <img src="cart.png" width="17" height="17"></a></li>
                                        <?php endif ?>
                                    </ul>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="infotxt">
                            <?php if (is_null($rowPD['info']) || $rowPD['info'] == "") : ?>
                                <object width="100%" height="700" type="text/plain" data="infoproduct/message.txt" border="0" style="overflow: hidden;"> </object>
                            <?php else : ?>
                                <?php $infourl = 'infoproduct/' . $rowPD['info']; ?>
                                <object width="100%" height="700" type="text/plain" data="<?php echo $infourl ?>" border="0" style="overflow: hidden;"> </object>
                            <?php endif ?>
                        </div>
                    </div>

                </div>
            <?php elseif (isset($_GET['howtobuy'])) : ?>
                <div class="aboutdiv">
                    <p class="pabout">
                        1.เลือกสินค้าที่ต้องการแล้วกด"ใส่รถเข็น"
                    </p>
                    <p>
                        <img class="pichowto" src="howtobuy/1.png" width="20%" height="auto">
                    </p>
                    <br><br><br><br>
                    <p class="pabout">
                        2.ไปที่เมนู"รถเข็นของคุณ"
                    </p>
                    <p>
                        <img class="pichowto" src="howtobuy/2.png" width="30%" height="auto">
                    </p>
                    <br><br><br><br>
                    <p class="pabout">
                        3.แก้ไขจำนวนสินค้าและเลือกสินค้าที่ต้องการชำระเงิน
                    </p>
                    <p>
                        <img class="pichowto" src="howtobuy/3.png" width="30%" height="auto">
                        <img class="pichowto" src="howtobuy/4.png" width="30%" height="auto">
                    </p>
                    <br><br><br><br>
                    <p class="pabout">
                        4.กด "สั่งซื้อสินค้า"
                    </p>
                    <p>
                        <img class="pichowto" src="howtobuy/5.png" width="30%" height="auto">
                    </p>
                    <br><br><br><br>
                    <p class="pabout">
                        5.ตรวจสอบและแก้ไขที่อยู่ในการจัดส่งให้ถูกต้อง จากนั้นกด "ยืนยันคำสั่งซื้อ"
                    </p>
                    <p>
                        <img class="pichowto" src="howtobuy/6.png" width="50%" height="auto">
                        <img class="pichowto" src="howtobuy/7.png" width="45%" height="auto">
                    </p>
                    <br><br><br><br>
                    <p class="pabout">
                        6.สามารถตรวจสอบการสั่งซื้อของคุณผ่านเมนู "ประวัติการสั่งซืื้อ"
                    </p>
                    <p>
                        <img class="pichowto" src="howtobuy/8.png" width="25%" height="auto"><br>
                        <img class="pichowto" src="howtobuy/9.png" width="60%" height="auto">
                    </p>
                </div>
            <?php elseif (isset($_GET['cart'])) : ?>
                <!-- Cart page-->
                <div class="outcartdiv" style="margin: 50px;border: green 0px solid;background-color: wheat;border-radius: 10px;">

                    <?php
                    $userid = $_SESSION['userid'];
                    $sqlx = "SELECT * FROM cart WHERE userid=$userid";
                    $resultx = mysqli_query($conect, $sqlx); //get data in cart of this user 
                    ?>
                    <?php if (mysqli_num_rows($resultx) == 1) : //thsi user have cart? 
                    ?>
                        <?php $rowshowcart = mysqli_fetch_array($resultx);
                        $cartidx = $rowshowcart['cartid']; //get cartID of this user
                        $sqlx = "SELECT * FROM cartINFO WHERE cartid=$cartidx";
                        $resultx = mysqli_query($conect, $sqlx); //get data in cartINFO 
                        ?>
                        <?php if (mysqli_num_rows($resultx) > 0) : ?>
                            <table id="table">
                                <tr>
                                    <th></th>
                                    <th class="tdH" colspan="6" style="width: 600px;">
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
                                <?php $Cwhile = 0; ?>
                                <?php while ($rowcartinfo = mysqli_fetch_array($resultx)) { ?>
                                    <tr>
                                        <?php $PDid = $rowcartinfo['productid'];
                                        $countcartshow = $rowcartinfo['count'];
                                        $sqly = "SELECT * FROM product WHERE productid=$PDid";
                                        $resulty = mysqli_query($conect, $sqly);
                                        ?>
                                        <?php $rowcartPD = mysqli_fetch_array($resulty); ?>
                                        <td><input class="chekbox" type="checkbox" value="<?php echo $rowcartPD['productid'] ?>" onchange="enableOrderbtn()" /></td>
                                        <td colspan="6">
                                            <div class="frampiccart">
                                                <?php if (is_null($rowcartPD['picture']) || $rowcartPD['picture'] == "") {
                                                    $imgurl = "ไม่มีภาพ";
                                                    echo $imgurl;
                                                } else {
                                                    $imgurl = 'productPic/' . $rowcartPD['picture'];
                                                } ?>
                                                <img src="<?php echo $imgurl; ?>" class="picincart" alt="<?php echo $rowcartPD['productid'] ?>" id="pdid<?php echo $Cwhile ?>">
                                            </div>
                                            <div class="framnamecart">
                                                <label class="PDnamecart"><?php echo $rowcartPD['PDname'] ?></label>
                                            </div>
                                        </td>
                                        <td><label class="PDpricecart"><?php echo $rowcartPD['price'] ?></label></td>

                                        <td><input type="number" min="1" maxlength="3" max="<?php echo $rowcartPD['count']?>" value="<?php echo $rowcartinfo['count'] ?>" class="countincart" id="count<?php echo $Cwhile ?>" 
                                        onfocus="savecurrentcount(this)" 
                                        onfocusout="chek_null(this,<?php echo $Cwhile ?>,<?php echo $cartidx ?>,<?php echo $rowcartinfo['productid'] ?>)" 
                                        oninput="C_chek_and_saveDB(this,'<?php echo $rowcartinfo['productid']; ?>',<?php echo $rowcartinfo['cartid'] ?>,<?php echo $Cwhile ?>,<?php echo $rowcartPD['count']?>)" 
                                        onkeyup="sumorder()" 
                                        onclick="sumorder()"></td>

                                        <td><label class="pricesum" id="sumPD<?php echo $Cwhile ?>"><?php echo (($rowcartPD['price']) * ($rowcartinfo['count'])); ?></label></td>
                                        <td style="width: 50px;"><button class="delcart" onclick="delcart(<?php echo $rowcartinfo['cartid'] ?>,<?php echo $rowcartinfo['productid'] ?>)">ลบ</button></td>
                                    </tr>
                                    <?php $Cwhile += 1; ?>
                                <?php } ?>
                            </table>
                            <div class="sumorderdiv">
                                <label id="txt1">ราคาสินค้ารวม (0 สินค้า) : </label><label class="sumorder" id="sumorder">0.-</label>
                            </div>
                            <div class="buyorderdiv">
                                <button class="buyorderbtn" onclick="getOrder()" disabled>สั่งซื่อสินค้า</button>
                            </div>
                        <?php else : ?>
                            <div class="emcart">
                                <p class="emcartP">ไม่มีสินค้าในรถเข็นของคุณ</p>
                            </div>
                        <?php endif ?>

                    <?php else : ?>
                        <div class="emcart">
                            <p class="emcartP">ไม่มีสินค้าในรถเข็นของคุณ</p>
                        </div>
                    <?php endif ?>
                </div>

            <?php else : ?>
                <!-- Home page-->

                <?php $product = mysqli_query($conect, $sql); ?>
                <?php while ($rowPD = mysqli_fetch_array($product)) { ?>
                    <div class="product">
                        <div class="frampic">
                            <?php if (is_null($rowPD['picture']) || $rowPD['picture'] == "") {
                                $imgurl = "ไม่มีภาพ";
                                echo $imgurl;
                            } else {
                                $imgurl = 'productPic/' . $rowPD['picture'];
                            } ?>
                            <img src="<?php echo $imgurl; ?>" class="PDpic">
                        </div>
                        <div>
                            <?php if ($rowPD['count'] == 0) : ?>
                                <ul>
                                    <li class="PDbtn"><a href="index.php?infoPD='<?php echo $rowPD['productid'] ?>'" class="infobtn">รายละเอียด</a></li>
                                </ul>
                                <label class="PDname"><?php echo $rowPD['PDname'] ?></label><br>
                                <label class="PDprice" id="outofstock">สินค้าหมด</label>
                            <?php else : ?>
                                <ul>
                                    <?php if (isset($_SESSION['username'])) : ?>
                                        <li class="PDbtn"><button class="buybtn" id="addcart" onclick="addcart(this.value)" value="<?php echo $rowPD['productid'] ?>">ใส่รถเข็น <img src="cart.png" width="17" height="17"></button></li>
                                    <?php else : ?>
                                        <li class="PDbtn"><a href="loginpage.php" class="buybtn">ใส่รถเข็น <img src="cart.png" width="17" height="17"></a></li>
                                    <?php endif ?>
                                    <li class="PDbtn"><a href="index.php?infoPD=<?php echo $rowPD['productid'] ?>" class="infobtn">รายละเอียด</a></li>
                                </ul>
                                <label class="PDname"><?php echo $rowPD['PDname'] ?></label><br>
                                <label class="PDprice"><?php echo $rowPD['price'] ?>.-</label>
                            <?php endif ?>
                        </div>
                    </div>
                <?php } ?>
            <?php endif ?>
        </div>
    </div>

    <script>
        var defultcount;
        var arrOrder;
        var ordersum;

        function addcart(x) {
            var PDid = x;
            var userid = "<?php echo $_SESSION['userid'] ?>"
            $("#cart").load("addCart.php", {
                PDidnew: PDid,
                useridnew: userid
            });
        }



        function C_chek_and_saveDB(x, PDid, cartid, pos,maxcount) {
            if (x.value.length > x.maxLength) {
                x.value = x.value.slice(0, x.maxLength);

            } else if (x.value == 0 && x.value != "") {
                x.value = "";
            }else if (x.value > maxcount){
                oldvalue = defultcount;
                alert("สินค้าในคลังไม่เพียงพอ");
                x.value = oldvalue;
            }


            y = x.value;
            if (y > 0) {
                $("#cart").load("saveCountCart.php", {
                    count: y,
                    ProductID: PDid,
                    IDcart: cartid
                })

                $("#sumPD" + pos).load("cal_sum_PD.php", {
                    ID: PDid,
                    count: y
                })
                defultcount = y;
                //enableOrderbtn();
                //sumorder();

            }

        }

        function savecurrentcount(x) {
            defultcount = x.value;
        }

        function chek_null(x, pos, cartid, PDid) {
            var oldvalue;
            if (x.value == "") {
                oldvalue = defultcount;
                document.getElementById(x.id).value = oldvalue;
            }
            C_chek_and_saveDB(x, PDid, cartid, pos);
        }

        function delcart(cart_id, product_id) {
            $("#cart").load("delPd_InCart.php", {
                cartid: cart_id,
                productid: product_id
            })
            location.reload();

        }

        function enableOrderbtn() {
            var grid = document.getElementById("table");
            var chekbox = grid.getElementsByClassName("chekbox");

            var btn = document.querySelector(".buyorderbtn");

            for (var i = 0; i < chekbox.length; i++) {

                if (chekbox[i].checked) {
                    btn.removeAttribute("disabled", "");
                    break;
                } else {
                    btn.setAttribute("disabled", "");
                }

            }
            sumorder();
        }

        function sumorder() {
            var grid = document.getElementById("table");
            var chekbox = grid.getElementsByClassName("chekbox");
            var sumorder = 0;
            var countPD = 0;
            for (var i = 0; i < chekbox.length; i++) {
                if (chekbox[i].checked) {
                    if (document.getElementById("count" + i).value != "") {
                        countPD += parseInt(document.getElementById("count" + i).value);
                    } else {
                        countPD += parseInt(defultcount);
                    }
                    sumorder += parseInt(document.getElementById("sumPD" + i).textContent);

                }
            }
            document.getElementById("sumorder").innerHTML = sumorder + ".-";
            ordersum = sumorder;
            document.getElementById("txt1").innerHTML = "ราคาสินค้ารวม (" + countPD + " สินค้า) : ";
        }

        function getOrder() {
            var grid = document.getElementById("table");
            var chekbox = grid.getElementsByClassName("chekbox");

            var pdid;
            var countpd;
            //find count of ceheckbox is checked
            var Ccheked = 0;
            for (var i = 0; i < chekbox.length; i++) {
                if (chekbox[i].checked) {
                    Ccheked += 1;
                }
            }

            //create array 1d 
            //count of element is count of checkbox checked
            arrOrder = [Ccheked];

            //keep data in array
            var Carr = -1; //count of element in array
            for (var i = 0; i < chekbox.length; i++) {
                if (chekbox[i].checked) {
                    Carr += 1;
                    arrOrder[Carr] = [2];
                    arrOrder[Carr][0] = document.getElementById("pdid" + i).alt;
                    arrOrder[Carr][1] = document.getElementById("count" + i).value;

                    //pdid = document.getElementById("pdid" + i).alt;
                    //countpd = document.getElementById("count" + i).value;
                }
            }
            Carr += 1;
            $(".outcartdiv").load("create_table/createtable.php?row=" + Carr, function() {

                for (var i = 0; i < arrOrder.length; i++) {
                    $("#row" + i + "col0").load("create_table/createCol.php?pdid=" + arrOrder[i][0] + "&col=0", function() {

                    });
                    $("#row" + i + "col1").load("create_table/createCol.php?pdid=" + arrOrder[i][0] + "&col=1", function() {

                    });
                    $("#row" + i + "col2").load("create_table/createCol.php?count=" + arrOrder[i][1] + "&col=2", function() {

                    });
                    $("#row" + i + "col3").load("create_table/createCol.php?count=" + arrOrder[i][1] + "&col=3&pdid=" + arrOrder[i][0], function() {

                    });
                }
                $("#table").append("<tr><td></td><td></td><td>ยอดรวม : </td><td> <p class=\"smuprice\">" + ordersum + "</p></td></tr>");

            });


        }

        function btnEdit() {
            btnedit = document.querySelector("#editbtn");
            btnsave = document.querySelector("#savebtn");
            area = document.querySelector("#addressarea");
            subbtn = document.querySelector(".submitorder");
            subbtn.setAttribute("disabled", "");
            btnedit.setAttribute("disabled", "");
            btnsave.removeAttribute("disabled", "");
            area.removeAttribute("disabled", "");
        }

        function btn_saveAddress() {
            btnedit = document.querySelector("#editbtn");
            btnsave = document.querySelector("#savebtn");
            area = document.querySelector("#addressarea");
            subbtn = document.querySelector(".submitorder");
            subbtn.removeAttribute("disabled", "");
            btnedit.removeAttribute("disabled", "");
            btnsave.setAttribute("disabled", "");
            area.setAttribute("disabled", "");

            $(document).ready(function() {
                $.post("save_useAddress.php", {
                    address: area.value
                });
            })
        }

        function submitorder() {
            var scripturl = "savesell/savesell.php?userid=" + "<?php echo $_SESSION['userid'] ?>";
            var sellid;
            $.ajax({
                url: scripturl,
                type: 'get',
                dataType: 'html',
                async: false,
                success: function(data) {
                    sellid = data;
                    for (var i = 0; i < arrOrder.length; i++) {
                        $.post("savesell/savesellinfo.php", {
                            idsell: sellid,
                            pdid: arrOrder[i][0],
                            count: arrOrder[i][1]
                        });
                    }
                }
            })
            //remove product ordered from cart
            var idcart;
            $(document).ready(function() {
                var scripturl2 = "savesell/getcartid.php?userid=" + "<?php echo  $_SESSION['userid'] ?>";
                $.ajax({
                    url: scripturl2,
                    type: 'get',
                    dataType: 'html',
                    async: false,
                    success: function(data) {
                        idcart = data;
                        for (var i = 0; i < arrOrder.length; i++) {
                            $.post("savesell/remove_from_cart.php", {
                                cartid: idcart,
                                pdid: arrOrder[i][0]
                            });
                        }
                        alert("การสั่งซื้อของคุณเสร็จสิ้น");
                        location.reload();
                    }
                });
            });
        }
    </script>


</body>

</html>