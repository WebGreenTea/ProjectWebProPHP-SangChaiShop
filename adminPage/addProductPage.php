<?php
session_start();
include('../conectDB.php');
if (!(isset($_SESSION['identity']) && $_SESSION['identity'] == "admin")) {
    header('location: ../index.php');
}
//get brand
$sql = "SELECT * FROM product_brand";
$brand = mysqli_query($conect, $sql);

//get type
$sql = "SELECT * FROM product_type";
$type = mysqli_query($conect, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        <h3 class="d-flex justify-content-center"> -- เพิ่มสินค้าใหม่ -- </h3>
        <form action="addProduct.php" method="post" enctype="multipart/form-data">
            <label for="productname" >ชื่อสินค้า</label>
            <input type="text" class="form-control" id="productname" name="productname" maxlength="40" required>
            <div class="row mt-2">
                <div class="col-md-6">
                    <label for="brand" >ยี่ห้อ</label>
                    <select class="form-select" name="brand" id="brand" required>
                        <?php while ($rowBrand = mysqli_fetch_array($brand)) { ?>
                            <option value="<?php echo $rowBrand['brandid'] ?>"><?php echo $rowBrand['pdbrand'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="type" >ประเภทสินค้า</label>
                    <select class="form-select" name="type" id="type" required>
                        <?php while ($rowType = mysqli_fetch_array($type)) { ?>
                            <option value="<?php echo $rowType['typeid'] ?>"><?php echo $rowType['pdtype'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6">
                    <label for="price" >ราคา</label>
                    <input type="number" class="form-control" id="price" name="price" min="0" max="10000000" required>
                </div>
                <div class="col-md-6">
                    <label for="count" >จำนวนสินค้าในคลัง</label>
                    <input type="number" class="form-control" id="count" name="count" min="0" max="1000000" required>
                </div>
            </div>
            <label class="mt-2" for="img">ภาพ(.png, .jpeg, .jpg)</label>
            <input type="file" accept=".png,.jpg,.jpeg," class="form-control" id="img" name="img" />

            <label class="mt-2" for="info">รายละเอียดสินค้า</label>
            <textarea class="form-control" id="info" rows="10" name="info" maxlength="8000"></textarea>

            <div class="d-flex justify-content-center mt-2">
                <input type="submit" name="submit" class="btn btn-success" value="เพิ่มสินค้า">
            </div>

        </form>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>

</html>