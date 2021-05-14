<?php
session_start();
include('conectDB.php');
if (!isset($_SESSION['userid'])) {
    header('location: index.php');
}
$userid = $_SESSION['userid'];
$sql = "SELECT * FROM user_data WHERE userid=$userid";
$userData = mysqli_query($conect, $sql);
$userData = mysqli_fetch_array($userData);


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
    <div class="container">
        <h2 class="d-flex justify-content-center mt-5 mb-4">ข้อมูลบัญชีของฉัน</h2>
        <form action="updateUserData.php" method="post">
            <?php if (isset($_SESSION['status'])) : ?>
                <div>
                    <?php $status =  $_SESSION['status'];
                    echo "<script>alert('$status')</script>";
                    unset($_SESSION['status']); ?>
                </div>
            <?php endif ?>
            <div class="mb-3 row">
                <div class="col-md-6">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" maxlength="15" required value="<?php echo $userData['username'] ?>">
                </div>
                <div class="col-md-6">
                    <label for="Email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="Email" name="Email" maxlength="40" required value="<?php echo $userData['email'] ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-md-6">
                    <label for="name" class="form-label">ชื่อ</label>
                    <input type="text" class="form-control" id="name" name="name" maxlength="35" required value="<?php echo $userData['name'] ?>">
                </div>
                <div class="col-md-6">
                    <label for="lastname" class="form-label">นามสกุล</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" maxlength="35" required value="<?php echo $userData['lastname'] ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-md-6">
                    <label for="gender">เพศ</label>
                    <select class="form-select" name="gender" id="gender">
                        <?php if ($userData['gender'] == "ชาย") : ?>
                            <option value="ชาย">ชาย</option>
                            <option value="หญิง">หญิง</option>
                            <option value="อื่นๆ">อื่นๆ</option>
                        <?php elseif ($userData['gender'] == "หญิง") : ?>
                            <option value="หญิง">หญิง</option>
                            <option value="ชาย">ชาย</option>
                            <option value="อื่นๆ">อื่นๆ</option>
                        <?php else : ?>
                            <option value="อื่นๆ">อื่นๆ</option>
                            <option value="หญิง">หญิง</option>
                            <option value="ชาย">ชาย</option>
                        <?php endif ?>

                    </select>
                </div>
                <div class="col-md-6">
                    <label for="PhoneNumber" class="form-label">เบอร์โทรศัพท์</label>
                    <input type="number" class="form-control" id="PhoneNumber" name="PhoneNumber" maxlength="10" required value="<?php echo "0" . $userData['PhonNumber'] ?>">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label for=" adress">ที่อยู่(สำหรับการจัดส่งสินค้า)</label>
                <textarea class="form-control" id="adress" name="address" maxlength="300" required><?php echo $userData['address'] ?></textarea>
            </div>
            <div class="d-flex justify-content-center">
                <input type="hidden" value="<?php echo $userid ?>" name="userid">
                <input type="submit" value="บันทึก" name="submit" class="btn btn-success">
            </div>
        </form>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
<script>

</script>

</html>