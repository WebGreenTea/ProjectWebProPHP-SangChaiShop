<?php
session_start();
if (isset($_GET['logout'])) { //logout
    session_destroy();
    unset($_SESSION['username']);
    unset($_SESSION['userid']);
    header('location: index.php');
}
if (!isset($_SESSION['userid'])) {
    header('location: ../loginPage.php');
}
if (isset($_GET['complete'])) {
    echo '<script type="text/javascript">',
        'alert("แก้ไขรหัสผ่านเสร็จสิ้น");',
        '</script>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>บัญชีของฉัน</title>
    <link rel="stylesheet" href="stlypass.css">
</head>

<body>
    <nav class="topbar">
        <ul>
            <li id="homeli"><a href="../index.php">กลับหน้าหลัก</a></li>
            <li class="topbarli2"><a class="usermenu" href="#"><?php echo $_SESSION['username'] ?></a>
                <ul class="ulsubtopbtn">
                    <li class="subtopbarli"><a href="myaccount.php" class="subbtnsign">บัญชีของฉัน</a></li>
                    <li class="subtopbarli"><a href="../vieworder/my_order.php" class="subbtnsign">ประวัติการสั่งซื้อ</a></li>
                    <li class="subtopbarli"><a href="../index.php?logout='1'" class="subbtnsign">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div class="maindiv">
        <br>
        <br>
        <div class="inmainDiv">
            <div class="mainmenu">
                <a class="inamenu2">ตั้งค่ารหัสผ่าน</a>
                <a href="myaccount.php" class="inamenu1">ข้อมูลบัญชี</a>
            </div>
            <div class="content">
                <div class="incontent">
                    <form action="savepass.php" method="post">
                        <div class="groupinput">
                            <?php if (isset($_SESSION['error'])) : ?>
                                <div class="errpwdold">
                                    <?php echo $_SESSION['error'];
                                    unset($_SESSION['error']); ?>
                                </div>
                            <?php endif ?>
                            <label for="passwordold">รหัสผ่านปัจจุบัน</label>
                            <input onfocus="disableerr()" class="txtinput" type="password" name="passwordold" maxlength="35">
                        </div>
                        <div class="groupinput">
                            <br>
                            <label for="password">รหัสผ่านใหม่</label>
                            <input onkeyup="passchek()" class="txtinput" id="pwd1" type="password" name="password" maxlength="35" required><br>
                            <label for="password2">ยืนยันรหัสผ่านใหม่อีกครั้ง</label>
                            <input onkeyup="passchek()" class="txtinput" id="pwd2" type="password" name="password2" maxlength="35" required>
                        </div>
                        <div class="errpwd"></div>
                        <div style="text-align: center;">
                            <button class="btn" type="submit" name="userPass">ยืนยันการแก้ไข</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        const pwd1 = document.querySelector("#pwd1");
        const pwd2 = document.querySelector("#pwd2");
        const btn = document.querySelector("button");
        const errpass = document.querySelector(".errpwd");
        const err_U_E = document.querySelector(".errpwdold");
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
</body>

</html>