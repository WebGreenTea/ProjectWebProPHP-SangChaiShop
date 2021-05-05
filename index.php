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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop - Sangchai</title>
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
                            </svg>(<?php echo $countcart; ?>)</a>
                    </div>
                    <div class="dropdown col-lg-6 d-flex justify-content-start p-0">
                        <a class="nav-link text-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo $_SESSION['username'] ?>
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" href="userinfo/myaccount.php">บัญชีของฉัน</a></li>
                            <li><a class="dropdown-item" href="vieworder/my_order.php">ประวัติการสั่งซื้อ</a></li>
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
    
    <div class="container-fulid bg-overlay">
        <div class="text-center">
            <h1 class="text-info" style="font-size: 80px;">Sangchai SHOP </h1>
            <h3 class="text-info" style="font-size: 50px;"> จำหน่ายเครื่องใช้ไฟฟ้าครบวงจร</h3>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">


            <div class="collapse navbar-collapse d-flex justify-content-center" id="navbarNavDarkDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">สินค้าทั้งหมด</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            โทรทัศน์
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                            <li><a class="dropdown-item" href="index.php?type=7">โทรทัศน์ทั้งหมด</a></li>
                            <?php $sqlbrand = "SELECT product_brand.pdbrand ,product_brand.brandid FROM product INNER JOIN product_brand ON product.brandid = product_brand.brandid WHERE product.typeid=7 GROUP BY pdbrand";
                            $brand = mysqli_query($conect, $sqlbrand);
                            while ($row = mysqli_fetch_array($brand)) {
                            ?>
                                <li><a class="dropdown-item" href="index.php?type=7&brand=<?php echo $row['brandid'] ?>"><?php echo $row['pdbrand'] ?></a></li>
                            <?php } ?>

                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            ตู้เย็น
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                            <li><a class="dropdown-item" href="index.php?type=1">ตู้เย็นทั้งหมด</a></li>
                            <?php $sqlbrand = "SELECT product_brand.pdbrand ,product_brand.brandid FROM product INNER JOIN product_brand ON product.brandid = product_brand.brandid WHERE product.typeid=1 GROUP BY pdbrand";
                            $brand = mysqli_query($conect, $sqlbrand);
                            while ($row = mysqli_fetch_array($brand)) {
                            ?>
                                <li><a class="dropdown-item" href="index.php?type=1&brand=<?php echo $row['brandid'] ?>"><?php echo $row['pdbrand'] ?></a></li>
                            <?php } ?>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            เครื่องซักผ้า
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                            <li><a class="dropdown-item" href="index.php?type=2">เครื่องซักผ้าทั้งหมด</a></li>
                            <?php $sqlbrand = "SELECT product_brand.pdbrand ,product_brand.brandid FROM product INNER JOIN product_brand ON product.brandid = product_brand.brandid WHERE product.typeid=2 GROUP BY pdbrand";
                            $brand = mysqli_query($conect, $sqlbrand);
                            while ($row = mysqli_fetch_array($brand)) {
                            ?>
                                <li><a class="dropdown-item" href="index.php?type=2&brand=<?php echo $row['brandid'] ?>"><?php echo $row['pdbrand'] ?></a></li>
                            <?php } ?>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            พัดลม
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                            <li><a class="dropdown-item" href="index.php?type=3">พัดลมทั้งหมด</a></li>
                            <?php $sqlbrand = "SELECT product_brand.pdbrand ,product_brand.brandid FROM product INNER JOIN product_brand ON product.brandid = product_brand.brandid WHERE product.typeid=3 GROUP BY pdbrand";
                            $brand = mysqli_query($conect, $sqlbrand);
                            while ($row = mysqli_fetch_array($brand)) {
                            ?>
                                <li><a class="dropdown-item" href="index.php?type=3&brand=<?php echo $row['brandid'] ?>"><?php echo $row['pdbrand'] ?></a></li>
                            <?php } ?>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            เครื่องปรับอากาศ
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                            <li><a class="dropdown-item" href="index.php?type=4">เครื่องปรับอากาศทั้งหมด</a></li>
                            <?php $sqlbrand = "SELECT product_brand.pdbrand ,product_brand.brandid FROM product INNER JOIN product_brand ON product.brandid = product_brand.brandid WHERE product.typeid=4 GROUP BY pdbrand";
                            $brand = mysqli_query($conect, $sqlbrand);
                            while ($row = mysqli_fetch_array($brand)) {
                            ?>
                                <li><a class="dropdown-item" href="index.php?type=4&brand=<?php echo $row['brandid'] ?>"><?php echo $row['pdbrand'] ?></a></li>
                            <?php } ?>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            เตารีด
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                            <li><a class="dropdown-item" href="index.php?type=5">เตารีดทั้งหมด</a></li>
                            <?php $sqlbrand = "SELECT product_brand.pdbrand ,product_brand.brandid FROM product INNER JOIN product_brand ON product.brandid = product_brand.brandid WHERE product.typeid=5 GROUP BY pdbrand";
                            $brand = mysqli_query($conect, $sqlbrand);
                            while ($row = mysqli_fetch_array($brand)) {
                            ?>
                                <li><a class="dropdown-item" href="index.php?type=5&brand=<?php echo $row['brandid'] ?>"><?php echo $row['pdbrand'] ?></a></li>
                            <?php } ?>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            ไมโครเวฟ
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                            <li><a class="dropdown-item" href="index.php?type=6">ไมโครเวฟทั้งหมด</a></li>
                            <?php $sqlbrand = "SELECT product_brand.pdbrand ,product_brand.brandid FROM product INNER JOIN product_brand ON product.brandid = product_brand.brandid WHERE product.typeid=6 GROUP BY pdbrand";
                            $brand = mysqli_query($conect, $sqlbrand);
                            while ($row = mysqli_fetch_array($brand)) {
                            ?>
                                <li><a class="dropdown-item" href="index.php?type=6&brand=<?php echo $row['brandid'] ?>"><?php echo $row['pdbrand'] ?></a></li>
                            <?php } ?>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!---show product-->
    <div class="container-fulid mt-4">
        <div class="row">
            <?php $product = mysqli_query($conect, $sql); ?>
            <?php while ($rowPD = mysqli_fetch_array($product)) { ?>
                <?php $imgurl = 'productPic/' . $rowPD['picture']; ?>
                <div class="col-lg-2">
                    <div class="card" onclick="goProductDetail(<?php echo $rowPD['productid'] ?>)">
                        <div class="frampic">
                            <?php if (is_null($rowPD['picture']) || $rowPD['picture'] == "") {
                                $imgurl = "ไม่มีภาพ";
                                echo $imgurl;
                            } else {
                                $imgurl = 'productPic/' . $rowPD['picture'];
                            } ?>
                            <img src="<?php echo $imgurl; ?>" class="PDpic">
                        </div>
                        <div class="card-body">
                            <h6 class=" d-flex justify-content-center card-title"><?php echo $rowPD['PDname'] ?></h6>
                            <h5 class=" d-flex justify-content-center card-text"><?php echo number_format($rowPD['price']); ?> บาท</h5>
                            
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

</body>
<script>
    function goProductDetail(id){
        window.location.assign('ProductDetail.php?productID='+id)
    }
</script>

</html>