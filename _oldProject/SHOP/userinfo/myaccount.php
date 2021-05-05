<?php
session_start();
include('../conectDB.php');
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
        'alert("บันทึกข้อมูลเสร็จสิ้น");',
        '</script>';
}
$userid = $_SESSION['userid'];
$sql = "SELECT * FROM user_data WHERE userid=$userid";
$result = mysqli_query($conect, $sql);
$rowOfdata = mysqli_fetch_array($result);
$gender = $rowOfdata['gender'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>บัญชีของฉัน</title>
    <link rel="stylesheet" href="stly.css">
    <script type="text/javascript">
        function codeAddress() {
            var male = document.querySelector("#male");
            var female = document.querySelector("#female");
            var other = document.querySelector("#other");
            var gender = "<?php echo $gender ?>"
            if (gender == "ชาย") {
                male.setAttribute("checked", "");
            } else if (gender == "หญิง") {
                female.setAttribute("checked", "");
            } else if (gender == "อื่นๆ") {
                other.setAttribute("checked", "");
            }
        }
        window.onload = codeAddress;
    </script>
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
                <a class="inamenu1">ข้อมูลบัญชี</a>
                <a href="pass.php" class="inamenu2">ตั้งค่ารหัสผ่าน</a>
            </div>
            <div class="content">

                <div class="incontent">
                    <form action="saveuser.php" method="post">
                        <div class="groupinput">
                            <label>Username : <?php echo $_SESSION['username'] ?></label>
                        </div>

                        <div class="groupinput">
                            <label for="name">ชื่อ</label>
                            <input class="txtinput" type="text" name="name" maxlength="35" value="<?php echo $rowOfdata['name'] ?>" required>
                            <label for="lastname">นามสกุล</label>
                            <input class="txtinput" type="text" name="lastname" maxlength="35" value="<?php echo $rowOfdata['lastname'] ?>" required>
                        </div>
                        <div class="groupinput">
                            <?php $valueemail = $rowOfdata['email'] ?>
                            <?php if (isset($_SESSION['error'])) : ?>
                                <div class="error">
                                    <?php $valueemail = "" ?>
                                    <?php echo $_SESSION['error'];
                                    unset($_SESSION['error']); ?>
                                </div>
                            <?php endif ?>
                            <label for="Email">e-mail</label>
                            <input class="txtinput" onfocus="disableerr()" type="email" name="Email" maxlength="40" value="<?php echo $valueemail ?>" required>
                            <label for="PhoneNumber">เบอร์โทรศัพท์</label>
                            <input class="txtinput" type="text" name="PhoneNumber" maxlength="10" value="0<?php echo $rowOfdata['PhonNumber'] ?>" required>
                        </div>
                        <div class="groupinput">
                            <label for="gender">เพศ</label><br>
                            <input type="radio" id="male" name="gender" value="ชาย">
                            <label for="male">ชาย</label>
                            <input type="radio" id="female" name="gender" value="หญิง">
                            <label for="female">หญิง</label>
                            <input type="radio" id="other" name="gender" value="อื่นๆ">
                            <label for="other">อื่นๆ</label>
                        </div>
                        <div class="groupinput">
                            <label for="adress">ที่อยู่(สำหรับการจัดส่งสินค้า)</label><br>
                            <textarea name="address" cols="50" rows="4" maxlength="300" required><?php echo $rowOfdata['address'] ?></textarea>
                        </div>
                        <div style="text-align: center;">
                            <button class="btn" type="submit" name="userEdit">บันทึก</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
<script>
    function disableerr() {
        var err_U_E = document.querySelector(".error");
        err_U_E.style.display = "none";
    }
</script>

</html>