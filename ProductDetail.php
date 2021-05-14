<?php session_start();
include('conectDB.php');
$productID = $_GET['productID'];
$sql = "SELECT * FROM product WHERE productid=$productID";
$product = mysqli_query($conect, $sql);
$product =  mysqli_fetch_assoc($product);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['PDname'] ?></title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark justify-content-between flex-nowrap flex-row">
        <div class="container">
            <a href="index.php" class="navbar-brand float-left">Sangchai SHOP</a>
            <!--<div class="collapse navbar-collapse nav justify-content-end" id="navbarDropdown">-->
            <?php if (isset($_SESSION['username'])) : ?>
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

            <?php else : ?>
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="loginPage.php" class="nav-link pr-3">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="registerPage.php" class="nav-link pr-3">Register</a>
                    </li>
                </ul>
            <?php endif ?>
            <!--</div>-->
        </div>
    </nav>

    <div class="container">
        <div class="row mt-5 pt-5">
            <div class="col-lg-6 pe-4 d-flex justify-content-end ">
                <?php if (is_null($product['picture']) || $product['picture'] == "") {
                    $imgurl = "ไม่มีภาพ";
                    echo $imgurl;
                } else {
                    $imgurl = 'productPic/' . $product['picture'];
                } ?>
                <img src="<?php echo $imgurl; ?>" style="width: 70%;" class="border">
            </div>
            <div class="col-lg-6 pt-5 ps-4 d-flex align-items-center">
                <div>
                    <div>
                        <h2><?php echo $product['PDname'] ?></h2>
                    </div>
                    <p>มีสินค้าอยู่ <?php echo $product['count'] ?> ชิ้น</p>
                    <h3><?php echo number_format($product['price']); ?> บาท</h3>
                    <?php if ($product['count'] < 1) : ?>
                        <h4 class="text-danger">สินค้าหมด</h4>
                    <?php else : ?>
                        <?php if(isset($_SESSION['userid'])):?>
                            <button class="btn btn-info mt-2" onclick="addcart(<?php echo $product['productid'] ?>,<?php echo $_SESSION['userid']?>)">ใส่รถเข็น</button>
                        <?php else: ?>
                            <a href="loginPage.php"><button class="btn btn-info mt-2">ใส่รถเข็น</button></a>
                        <?php endif ?>
                    <?php endif ?>
                </div>

            </div>
        </div>

        <div class="mt-5 mb-5 bg-light">
            <textarea class="form-control" disabled rows="20"><?php echo $product['info'] ?></textarea>
        </div>

        
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<script src="js/jquery-3.5.1.min.js"></script>
<script>
    function addcart(PDid,userid) {
        $("#cart").load("addCart.php", {
            PDidnew: PDid,
            useridnew: userid
        });
    }
</script>

</html>