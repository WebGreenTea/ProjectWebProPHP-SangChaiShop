<?php
session_start();
include('conectDB.php');
if (!isset($_SESSION['userid'])) {
    header('location: index.php');
}

if (isset($_SESSION['success'])) {
    echo "<script>alert('เปลี่ยนรหัสผ่านเสร็จสิ้น')</script>";
    unset($_SESSION['success']);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setting</title>
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
                        <li><a class="dropdown-item" href="myaccountinfo.php">ตั้งค่าข้อมูลส่วนตัว</a></li>
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
        <h2 class="d-flex justify-content-center mt-5 mb-4">เปลี่ยนรหัสผ่าน</h2>
        <form action="saveNewPass.php" method="post">
            <?php if (isset($_SESSION['error'])) : ?>
                <div id="error">
                    <div class="text-light d-flex justify-content-center bg-danger">
                        <?php
                        echo $_SESSION['error'];
                        unset($_SESSION['error']); ?>
                    </div>

                </div>
            <?php endif ?>
            <label for="currentPass" class="font-25">รหัสผ่านปัจจุบัน</label>
            <input id="currentPass" type="password" required maxlength="35" class="form-control" name="oldpass" onfocus="disableerr()">
            <label class="form-label for=" password">รหัสผ่านใหม่</label>
            <input class="form-control" onkeyup="passchek()" id="pwd1" type="password" name="password" maxlength="35" required onfocus="disableerr()" pattern=".{8,}" title="ตัวอักษรอย่างน้อย 8 ตัว">
            <label class="form-label for=" password2">ยืนยันรหัสผ่านใหม่</label>
            <input class="form-control" onkeyup="passchek()" id="pwd2" type="password" maxlength="35" required onfocus="disableerr()">
            <div class="d-flex justify-content-end mt-1 text-danger" id="errpwd"></div>
            <div class="mt-3 d-flex justify-content-center">
                <input type="hidden" value="<?php echo $_SESSION['userid'] ?>" name="userid">
                <button disabled class="btn btn-success" type="submit" name="userReg">สมัคร</button>
            </div>
        </form>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
<script>
    const pwd1 = document.querySelector("#pwd1");
    const pwd2 = document.querySelector("#pwd2");
    const btn = document.querySelector("button");
    const errpass = document.querySelector("#errpwd");
    const err_U_E = document.querySelector("#error");

    function disableerr() {
        err_U_E.style.display = "none";
    }

    function passchek() {
        if (!pwd2.value) {
            errpass.textContent = "";
            btn.setAttribute("disabled", "");
        } else if (pwd1.value != pwd2.value) {
            errpass.textContent = "*ยืนยันรหัสผ่านผิด";
            btn.setAttribute("disabled", "");
        } else {
            errpass.textContent = "";
            btn.removeAttribute("disabled", "");
        }
    }
</script>

</html>