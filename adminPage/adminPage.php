<?php
session_start();
include('../conectDB.php');
if (!(isset($_SESSION['identity']) && $_SESSION['identity'] == "admin")) {
    header('location: ../index.php');
}

if (isset($_GET['seach'])) {
    $seach = $_GET['seach'];
    $sql = "SELECT product.productid,product.PDname,product.price,product.count,product.picture,product_brand.pdbrand,product_type.pdtype FROM product 
    INNER JOIN product_brand ON product.brandid=product_brand.brandid
    INNER JOIN product_type ON product.typeid=product_type.typeid WHERE product.PDname LIKE '%$seach%'";
} else {
    $sql = "SELECT product.productid,product.PDname,product.price,product.count,product.picture,product_brand.pdbrand,product_type.pdtype FROM product 
    INNER JOIN product_brand ON product.brandid=product_brand.brandid
    INNER JOIN product_type ON product.typeid=product_type.typeid";
}


$productData = mysqli_query($conect, $sql);

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
                    <a href="adminPage.php" class="nav-link pr-3 ">จัดการสินค้า</a>
                </li>
                <li class="nav-item">
                    <a href="adminPageOrder.php" class="nav-link pr-3 active">จัดการรายการสั่งซื้อ</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mb-5">
        <h2 class="mt-5 d-flex justify-content-center mb-4"> -- จัดการสินค้า -- </h2>
        <div class="row">
            <div class="col-md-3 d-flex justify-content-start">
                <a href="addProductPage.php" class="btn btn-success">เพิ่มสินค้าใหม่ + </a>
            </div>

            <div class="col-md-3">
            </div>

            <div class="col-md-6 d-flex justify-content-end">
                <form class="d-flex" accept="" method="get">
                    <input class="form-control me-2" type="search" placeholder="สิ้นค้าที่ต้องการหา" aria-label="Search" name="seach">
                    <button class="btn btn-outline-success" type="submit">ค้นหา</button>
                </form>
                <?php if (isset($seach)) : ?>
                    <a href="adminPage.php" class="ms-2 btn btn-secondary">แสดงสินค้าทั้งหมด</a>
                <?php endif ?>
            </div>
        </div>
        <?php if (mysqli_num_rows($productData) > 0) : ?>
            <table class="table mb-5 mt-3">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th></th>
                        <th scope="col">ชื่อสินค้า</th>
                        <th scope="col">ยี่ห้อ</th>
                        <th scope="col">ประเภท</th>
                        <th scope="col">ราคาต่อชิ้น</th>
                        <th scope="col">จำนวน</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($rowProdict = mysqli_fetch_array($productData)) { ?>
                        <tr>
                            <th scope="row"><?php echo $rowProdict['productid'] ?></th>
                            <td><img src="../productPic/<?php echo $rowProdict['picture'] ?>" style="height: 50px;" alt=""></td>
                            <td><?php echo $rowProdict['PDname'] ?></td>
                            <td><?php echo $rowProdict['pdbrand'] ?></td>
                            <td><?php echo $rowProdict['pdtype'] ?></td>
                            <td><?php echo $rowProdict['price'] ?></td>
                            <td><?php echo $rowProdict['count'] ?></td>
                            <td><a href="editProduct.php?id=<?php echo $rowProdict['productid'] ?>" class="btn btn-warning">แก้ไข</a> <a href="delProduct.php?id=<?php echo $rowProdict['productid'] ?>" class="btn btn-danger" onClick="return confirm('ต้องการที่จะลบสินค้าชิ้นนี้?')">ลบ</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php else : ?>
            <div class="d-flex justify-content-center mt-5">
                <h1 class="text-secondary">ไม่พบสินค้า "<?php echo $seach ?>"</h1>
            </div>
        <?php endif ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>

</html>