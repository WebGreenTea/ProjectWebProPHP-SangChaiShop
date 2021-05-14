<?php
session_start();
include('../conectDB.php');
if (!(isset($_SESSION['identity']) && $_SESSION['identity'] == "admin")) {
    header('location: ../index.php');
}
if (!isset($_GET['id'])) {
    header('location: ../index.php');
}
$pdid = $_GET['id'];
//get product data
$sql = "SELECT * FROM product WHERE productid=$pdid";
$product = mysqli_query($conect, $sql);
$product = mysqli_fetch_array($product);
//get current brand
$currentBrandid = $product['brandid'];
$sql = "SELECT * FROM product_brand WHERE brandid=$currentBrandid";
$currentBrandName = mysqli_query($conect, $sql);
$currentBrandName = mysqli_fetch_array($currentBrandName)['pdbrand'];
//get current type
$currentTypeid = $product['typeid'];
$sql = "SELECT * FROM product_type WHERE typeid=$currentTypeid";
$currentTypeName = mysqli_query($conect, $sql);
$currentTypeName = mysqli_fetch_array($currentTypeName)['pdtype'];

//get brand
$sql = "SELECT * FROM product_brand WHERE NOT brandid=$currentBrandid";
$brand = mysqli_query($conect, $sql);

//get type
$sql = "SELECT * FROM product_type WHERE NOT typeid=$currentTypeid";
$type = mysqli_query($conect, $sql);
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
                    <a href="" class="nav-link pr-3 ">จัดการสินค้า</a>
                </li>
                <li class="nav-item">
                    <a href="adminPageOrder.php" class="nav-link pr-3 active">จัดการรายการสั่งซื้อ</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="mt-3">
            <a href="adminPage.php" class="btn btn-secondary"><img src="img/back.png" alt="" style="width: 20px;"> ย้อนหลับ</a>
        </div>
        <h3 class="d-flex justify-content-center"> -- แก้ไขข้อมูลสินค้า -- </h3>
        <form action="saveEditProduct.php" method="post" enctype="multipart/form-data">
            <label for="productname">ชื่อสินค้า</label>
            <input type="text" class="form-control" id="productname" name="productname" maxlength="40" required value="<?php echo $product['PDname'] ?>">
            <div class="row mt-2">
                <div class="col-md-6">
                    <label for="brand">ยี่ห้อ</label>
                    <select class="form-select" name="brand" id="brand" required>
                        <option value="<?php echo $currentBrandid ?>"><?php echo $currentBrandName; ?></option>
                        <?php while ($rowBrand = mysqli_fetch_array($brand)) { ?>
                            <option value="<?php echo $rowBrand['brandid'] ?>"><?php echo $rowBrand['pdbrand'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="type">ประเภทสินค้า</label>
                    <select class="form-select" name="type" id="type" required>
                        <option value="<?php echo $currentTypeid ?>"><?php echo $currentTypeName; ?></option>
                        <?php while ($rowType = mysqli_fetch_array($type)) { ?>
                            <option value="<?php echo $rowType['typeid'] ?>"><?php echo $rowType['pdtype'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6">
                    <label for="price">ราคา</label>
                    <input type="number" class="form-control" id="price" name="price" min="0" max="10000000" required value="<?php echo $product['price'] ?>">
                </div>
                <div class="col-md-6">
                    <label for="count">จำนวนสินค้าในคลัง</label>
                    <input type="number" class="form-control" id="count" name="count" min="0" max="1000000" required value="<?php echo $product['count'] ?>">
                </div>
            </div>
            <?php if (is_null($product['picture']) || $product['picture'] == "") : ?>
                <label class="mt-2" for="img">เพิ่มภาพ (.png, .jpeg, .jpg)</label>
                <input type="file" accept=".png,.jpg,.jpeg," class="form-control" id="img" name="img" />
            <?php else : ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mt-3 mb-3 d-flex justify-content-center border">
                            <?php $imgurl = "../productPic/" . $product['picture'] ?>
                            <img src="<?php echo $imgurl ?>" alt="" style="height: 150px;">
                        </div>
                    </div>
                    <div class="col-md-6 d-flex align-items-center">
                        <div>
                            <label class="mt-2" for="img">เปลี่ยนภาพ (.png, .jpeg, .jpg)</label>
                            <input type="file" accept=".png,.jpg,.jpeg," class="form-control" id="img" name="img" />
                        </div>

                    </div>
                </div>

            <?php endif ?>


            <label class="mt-2" for="info">รายละเอียดสินค้า</label>
            <textarea class="form-control" id="info" rows="10" name="info" maxlength="8000"><?php echo $product['info'] ?></textarea>

            <div class="d-flex justify-content-center mt-2">
            <input type="hidden" name="id" value="<?php echo $product['productid'] ?>">
                <input type="submit" name="submit" class="btn btn-success" value="บันทึก">
            </div>

        </form>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>

</html>