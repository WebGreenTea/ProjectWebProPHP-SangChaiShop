<?php
session_start();
include('conectDB.php');
if (isset($_SESSION['username'])) { //user in session jump to index
    header('location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="stlyregis.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>

<body>

    <div class="container mt-5">
        <div class="mb-3 d-flex justify-content-center bg-info text-light rounded-pill">
            <h1>สร้างบัญชีผู้ใช้</h1>
        </div>
        <form action="savedb_user.php" method="post">
            <?php if (isset($_SESSION['error'])) : ?>
                <div id="error">
                    <div class="text-danger d-flex justify-content-center">
                        <?php echo $_SESSION['error'];
                        unset($_SESSION['error']); ?>
                    </div>

                </div>
            <?php endif ?>
            <div class="mb-3 row">
                <div class="col-md-6">
                    <label for="username" class="form-label">Username</label>
                    <input onfocus="disableerr()" type="text" class="form-control" id="username" name="username" maxlength="15" required>
                </div>
                <div class="col-md-6">
                    <label for="Email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="Email" name="Email" maxlength="40" required onfocus="disableerr()">
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-md-6">
                    <label for="name" class="form-label">ชื่อ</label>
                    <input type="text" class="form-control" id="name" name="name" maxlength="35" required onfocus="disableerr()">
                </div>
                <div class="col-md-6">
                    <label for="lastname" class="form-label">นามสกุล</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" maxlength="35" required onfocus="disableerr()">
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-md-6">
                    <label for="gender">เพศ</label>
                    <select class="form-select" name="gender" id="gender">
                        <option value="ชาย">ชาย</option>
                        <option value="หญิง">หญิง</option>
                        <option value="อื่นๆ">อื่นๆ</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="PhoneNumber" class="form-label">เบอร์โทรศัพท์</label>
                    <input type="number" class="form-control" id="PhoneNumber" name="PhoneNumber" maxlength="10" required onfocus="disableerr()">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label for=" adress">ที่อยู่(สำหรับการจัดส่งสินค้า)</label>
                <textarea class="form-control" id="adress" name="address" maxlength="300" required onfocus="disableerr()"></textarea>
            </div>
            <div class="mb-3 row">
                <div class="col-md-6">
                    <label class="form-label for=" password">รหัสผ่าน</label>
                    <input class="form-control" onkeyup="passchek()" id="pwd1" type="password" name="password" maxlength="35" required onfocus="disableerr()">
                </div>
                <div class="col-md-6">
                    <label class="form-label for=" password2">ยืนยันรหัสผ่าน</label>
                    <input class="form-control" onkeyup="passchek()" id="pwd2" type="password" name="password2" maxlength="35" required onfocus="disableerr()">
                </div>
                <div class="d-flex justify-content-end mt-1 text-danger" id="errpwd"></div>
            </div>
            <p class="d-flex justify-content-end">มีบัญชีอยู่แล้ว? <a href="loginPage.php">ลงชื่อเข้าใช้</a></p>

            <div class="d-flex justify-content-center">
                <button disabled class="btn btn-success" type="submit" name="userReg">สมัคร</button>
            </div>
        </form>
    </div>




    <script>
        const pwd1 = document.querySelector("#pwd1");
        const pwd2 = document.querySelector("#pwd2");
        const btn = document.querySelector("button");
        const errpass = document.querySelector("#errpwd");
        const err_U_E = document.querySelector("#error");
        var counter = 0;

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
                counter = counter + 1;

            }
        }

        function disableerr() {
            err_U_E.style.display = "none";
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>

</html>