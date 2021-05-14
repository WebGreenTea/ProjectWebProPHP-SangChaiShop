<?php
session_start();
include('conectDB.php');
if (!isset($_SESSION['username'])) {
    header('location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <style>
        input.largerCheckbox {
            width: 25px;
            height: 25px;
        }
    </style>
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

                            $sqlcart = "SELECT * FROM cartinfo WHERE cartid=$cartid";
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
                        <li><a class="dropdown-item" href="order_history.php">ประวัติการสั่งซื้อ</a></li>
                        <li><a class="dropdown-item" href="myaccountinfo.php">ตั้งค่าข้อมูลส่วนตัว</a></li>
                        <li><a class="dropdown-item" href="changePassPage.php">เปลี่ยนรหัสผ่าน</a></li>
                        <?php if (isset($_SESSION['identity']) && $_SESSION['identity'] == "admin") : ?>
                            <li><a class="dropdown-item" href="adminPage/adminPage.php">เมนู ADMIN</a></li>
                        <?php endif ?>
                        <li><a class="dropdown-item" href="index.php?logout='1'">Logout</a></li>
                    </ul>
                </div>

            </div>

            <!--</div>-->
        </div>
    </nav>
    <div class="mt-5 pt-5 container">


        <?php
        $userid = $_SESSION['userid'];
        $sql = "SELECT * FROM cart WHERE userid=$userid";
        $cartID = mysqli_query($conect, $sql); //get data in cart of this user 
        ?>

        <?php if (mysqli_num_rows($cartID) == 1) : //this user have cart? 
        ?>
            <?php $cartID = mysqli_fetch_array($cartID);
            $cartID = $cartID['cartid']; //get cartID of this user
            $sql = "SELECT * FROM cartinfo WHERE cartid=$cartID";
            $cart = mysqli_query($conect, $sql); //get data in cartINFO 
            ?>
            <?php if (mysqli_num_rows($cart) > 0) : ?>


                <?php $Cwhile = 0; ?>
                <div id="table">
                    <?php while ($rowcart = mysqli_fetch_array($cart)) { ?>
                        <?php $PDid = $rowcart['productid'];
                        $countcartshow = $rowcart['count'];
                        $sql = "SELECT * FROM product WHERE productid=$PDid"; //get product detail from product DB
                        $product = mysqli_query($conect, $sql); ?>
                        <?php $rowProduct = mysqli_fetch_array($product); ?>
                        <div class="row border-bottom">
                            <div class="col-md-1 d-flex justify-content-center align-items-center">
                                <input class="chekbox largerCheckbox" type="checkbox" value="<?php echo $rowProduct['productid'] ?>" onchange="enableOrderbtn()" />
                            </div>
                            <div class="col-md-2">
                                <div class="frampiccart">
                                    <?php if (is_null($rowProduct['picture']) || $rowProduct['picture'] == "") {
                                        $imgurl = "ไม่มีภาพ";
                                        echo $imgurl;
                                    } else {
                                        $imgurl = 'productPic/' . $rowProduct['picture'];
                                    } ?>
                                    <img src="<?php echo $imgurl; ?>" class="picincart" alt="<?php echo $rowProduct['productid'] ?>" id="pdid<?php echo $Cwhile ?>">
                                </div>
                            </div>
                            <div class="col-md-2 d-flex justify-content-start align-items-center">
                                <label class="PDnamecart"><?php echo $rowProduct['PDname'] ?></label>
                            </div>
                            <div class="col-md-2 d-flex justify-content-center align-items-center">
                                <label class="PDpricecart"><?php echo $rowProduct['price'] ?></label>
                            </div>
                            <div class="col-md-2 d-flex justify-content-center align-items-center">
                                <input type="number" min="1" maxlength="3" max="<?php echo $rowProduct['count'] ?>" value="<?php echo $rowcart['count'] ?>" id="count<?php echo $Cwhile ?>" onfocus="savecurrentcount(this)" onfocusout="chek_null(this,<?php echo $Cwhile ?>,<?php echo $cartID ?>,<?php echo $rowcart['productid'] ?>)" oninput="C_chek_and_saveDB(this,'<?php echo $rowcart['productid']; ?>',<?php echo $rowcart['cartid'] ?>,<?php echo $Cwhile ?>,<?php echo $rowProduct['count'] ?>)" onkeyup="sumorder()" onclick="sumorder()">
                            </div>
                            <div class="col-md-2 d-flex justify-content-center align-items-center">
                                <label class="pricesum" id="sumPD<?php echo $Cwhile ?>"><?php echo (($rowProduct['price']) * ($rowcart['count'])); ?></label></td>
                            </div>
                            <div class="col-md-1 d-flex justify-content-center align-items-center">
                                <a href="delPd_InCart.php?cartid=<?php echo $rowcart['cartid'] ?>&productid=<?php echo $rowcart['productid'] ?>"><button class="btn btn-danger">ลบ</button></a>
                            </div>
                        </div>
                        <?php $Cwhile += 1; ?>
                    <?php } ?>
                </div>
                <div class="mt-3 d-flex justify-content-center">
                    <h3 id="txt1">ราคาสินค้ารวม (0 ชิ้น) : </h3>
                    <h3 id="sumorder">0 บาท</h3>
                </div>
                <div class="mt-3">
                    <div class="row">
                        <div class="col-md-3 ">
                            <label for="" class="d-flex justify-content-end">ที่อยู่ในการจัดส่ง : </label>
                            <div class="d-flex justify-content-end">
                                <button onclick="editAddressON()" id="editbtn" class="btn btn-info">แก้ไข</button>
                                <button onclick="editAddressOFF()" id="savebtn" class="btn btn-success" style="display: none;">บันทึก</button>
                            </div>

                        </div>
                        <div class="col-md-9">
                            <?php $sql = "SELECT address FROM user_data WHERE userid=$userid";
                            $address = mysqli_query($conect, $sql);
                            $address = mysqli_fetch_array($address);
                            ?>
                            <textarea id="address" cols="100" rows="5" disabled><?php echo $address['address'] ?></textarea>
                        </div>
                    </div>



                </div>
                <div class="mt-3 d-flex justify-content-center">
                    <button class="btn btn-success" id="buyorderbtn" onclick="submitorder()" disabled>สั่งซื่อสินค้า</button>
                </div>

            <?php else : ?>
                <div class="d-flex justify-content-center text-secondary">
                    <h1 class="emcartP">ไม่มีสินค้าในรถเข็นของคุณ</h1>
                </div>
            <?php endif ?>
        <?php else : ?>
            <div class="d-flex justify-content-center text-secondary">
                <h1 class="emcartP">ไม่มีสินค้าในรถเข็นของคุณ</h1>
            </div>
        <?php endif ?>
    </div>

    <p id="cart"></p>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
<script src="js/jquery-3.5.1.min.js"></script>
<script>
    var defultcount;
    var addressTxtFlag = true;

    function editAddressON() {
        let txtarea = document.getElementById("address");
        let editbtn = document.getElementById("editbtn");
        let savebtn = document.getElementById("savebtn");
        txtarea.removeAttribute("disabled", "");
        editbtn.style.display = "none";
        savebtn.style.display = "";
        addressTxtFlag = false;
        enableOrderbtn();
    }

    function editAddressOFF() {
        let txtarea = document.getElementById("address");
        let editbtn = document.getElementById("editbtn");
        let savebtn = document.getElementById("savebtn");
        txtarea.setAttribute("disabled", "");
        editbtn.style.display = "";
        savebtn.style.display = "none";
        addressTxtFlag = true;
        $("#address").load("saveaddress.php", {
            userid: <?php echo $_SESSION['userid'] ?>,
            address: txtarea.value
        })
        enableOrderbtn()
    }

    function savecurrentcount(x) {
        defultcount = x.value;
    }

    function sumorder() {
        var grid = document.getElementById("table");
        var chekbox = grid.getElementsByClassName("chekbox");
        var sumorder = 0;
        var countPD = 0;
        for (var i = 0; i < chekbox.length; i++) {
            if (chekbox[i].checked) {
                if (document.getElementById("count" + i).value != "") {
                    console.log(parseInt(document.getElementById("count" + i).value));
                    countPD += parseInt(document.getElementById("count" + i).value);
                } else {
                    countPD += parseInt(defultcount);
                }
                sumorder += parseInt(document.getElementById("sumPD" + i).textContent);

            }
        }
        document.getElementById("sumorder").innerHTML = sumorder.toLocaleString() + " บาท";
        ordersum = sumorder;
        document.getElementById("txt1").innerHTML = "ราคาสินค้ารวม (" + countPD + " ชิ้น) : ";
    }

    function enableOrderbtn() {
        var grid = document.getElementById("table");
        var chekbox = grid.getElementsByClassName("chekbox");

        var btn = document.querySelector("#buyorderbtn");

        for (var i = 0; i < chekbox.length; i++) {

            if (chekbox[i].checked && addressTxtFlag) {
                btn.removeAttribute("disabled", "");
                break;
            } else {
                btn.setAttribute("disabled", "");
            }

        }
        sumorder();
    }

    function chek_null(x, pos, cartid, PDid) {

        var oldvalue;
        if (x.value == "") {
            oldvalue = defultcount;
            document.getElementById(x.id).value = oldvalue;
        }
        C_chek_and_saveDB(x, PDid, cartid, pos);
    }

    function C_chek_and_saveDB(x, PDid, cartid, pos, maxcount) {
        if (x.value.length > x.maxLength) {
            x.value = x.value.slice(0, x.maxLength);

        } else if (x.value == 0 && x.value != "") {
            x.value = "";
        } else if (x.value > maxcount) {
            oldvalue = defultcount;
            alert("สินค้าในคลังไม่เพียงพอ");
            x.value = oldvalue;
        }


        let y = x.value;
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
        }

    }

    function submitorder() {
        var grid = document.getElementById("table");
        var chekbox = grid.getElementsByClassName("chekbox");

        var scripturl = "savesell/savesell.php?userid=" + "<?php echo $_SESSION['userid'] ?>";
        var sellid;
        $(document).ready(function() {
            $.ajax({
                url: scripturl,
                type: 'get',
                dataType: 'html',
                async: false,
                success: function(data) {
                    sellid = data;
                    for (let i = 0; i < chekbox.length; i++) {
                        if (chekbox[i].checked) {
                            $.post("savesell/savesellinfo.php", {
                                idsell: sellid,
                                pdid: document.getElementById("pdid" + i).alt,
                                count: document.getElementById("count" + i).value
                            });

                        }
                    }
                }
            })
        });
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
                    for (let i = 0; i < chekbox.length; i++) {
                        if (chekbox[i].checked) {
                            $.post("savesell/remove_from_cart.php", {
                                cartid: idcart,
                                pdid: document.getElementById("pdid" + i).alt,
                            });
                        }
                    }
                    alert("การสั่งซื้อของคุณเสร็จสิ้น");
                    location.reload();
                }
            });
        });
    }
</script>

</html>