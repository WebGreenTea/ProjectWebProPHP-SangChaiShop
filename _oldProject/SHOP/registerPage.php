<?php
session_start();
include('conectDB.php'); 
if(isset($_SESSION['username'])){ //user in session jump to index
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
</head>

<body>
    <h1>Register</h1>
    <form action="savedb_user.php" method="post">
        <?php if (isset($_SESSION['error'])) : ?>
            <div class="error">
                <?php echo $_SESSION['error'];
                unset($_SESSION['error']);?>
            </div>
        <?php endif ?>
        <div class="groupinput">
            <label for="username">Username</label>
            <input onfocus="disableerr()" type="text" name="username" maxlength="15" required>
            <label for="Email">e-mail</label>
            <input onfocus="disableerr()" type="email" name="Email" maxlength="40" required>
        </div>

        <div class="groupinput">
            <label for="name">ชื่อ</label>
            <input type="text" name="name" maxlength="35" required>
            <label for="lastname">นามสกุล</label>
            <input type="text" name="lastname" maxlength="35" required>
        </div>

        <div class="groupinput">
            <label for="gender">เพศ</label>
            <select name="gender">
                <option value="ชาย">ชาย</option>
                <option value="หญิง">หญิง</option>
                <option value="อื่นๆ">อื่นๆ</option>
            </select>
            <label for="PhoneNumber">เบอร์โทรศัพท์</label>
            <input type="text" name="PhoneNumber"maxlength="10" required>
        </div>


        <div class="groupinput">
            <label for="adress">ที่อยู่(สำหรับการจัดส่งสินค้า)</label>
            <textarea name="address" cols="100" rows="4" maxlength="300" required></textarea>
        </div>

        <div class="groupinput">
            <label for="password">รหัสผ่าน</label>
            <input onkeyup="passchek()" id="pwd1" type="password" name="password" maxlength="35" required>
            <label for="password2">ยืนยันรหัสผ่าน</label>
            <input onkeyup="passchek()" id="pwd2" type="password" name="password2" maxlength="35" required>
        </div>

        <div class="errpwd"></div>

        <div>
            <button disabled class="btn" type="submit" name="userReg">สมัคร</button>
        </div>
    </form>
    <p>มีบัญชีอยู่แล้ว? <a href="loginPage.php">Login</a></p>

    <script>
        const pwd1 = document.querySelector("#pwd1");
        const pwd2 = document.querySelector("#pwd2");
        const btn = document.querySelector("button");
        const errpass = document.querySelector(".errpwd");
        const err_U_E = document.querySelector(".error");
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
        function disableerr(){
            err_U_E.style.display = "none";
        }
    </script>
</body>

</html>