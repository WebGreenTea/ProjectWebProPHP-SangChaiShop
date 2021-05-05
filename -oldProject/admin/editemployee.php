<?php include('conectDB.php');
$id = $_GET['id'];
$sql = "SELECT * FROM employee WHERE id=$id";
$result = mysqli_query($conect, $sql);
$row = mysqli_fetch_array($result);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="stly.css">
    <title>Admin</title>
    <script>
        function selectgender(x) {
            if (x == "ชาย") {
                document.getElementById("male").setAttribute("selected", "");
            } else if (x == "หญิง") {
                document.getElementById("female").setAttribute("selected", "");
            } else {
                document.getElementById("otherG").setAttribute("selected", "");
            }
        }

        function selectststus(x) {
            if (x == "พนักงานส่ง") {
                document.getElementById("em1").setAttribute("selected", "");
            } else {
                document.getElementById("em2").setAttribute("selected", "");
            }
        }
    </script>
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: wheat;">
            <a class="navbar-brand" href="#">Admin</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


        </nav>
    </header>
    <div class="" style="margin: 0px">
        <div class="row" style="margin-top: 20px;">
            <div class="col-md-2">
                <div class="list-group">
                    <a href="index.php?product=1" class="list-group-item list-group-item-action list-group-item-primary">จัดการสิ้นค้า</a>
                    <a href="index.php?employee=1" class="list-group-item list-group-item-action list-group-item-secondary">จัดการพนักงาน</a>
                    <a href="index.php?order=1" class="list-group-item list-group-item-action list-group-item-success">จัดการการขาย</a>

                </div>
            </div>
            <div class="col-md-8" id="bordersalmon">
                <div style="margin: 20px 0px 0px 20px;">
                    <a href="index.php?employee=1"><img src="img/back.png" style="height: auto; width: 20px;"> ย้อนกลับ</a>
                </div>


                <form method="post" action="saveemployee_edit.php?id=<?php echo $id?>">
                    <div style="text-align: center;">
                        <h5>แก้ไขข้อมูลพนักงาน</h5>

                        <div class="groupinput">
                            <label for="name">ชื่อ</label>
                            <input class="txtinput" type="text" name="name" maxlength="35" value="<?php echo $row['name'] ?>" required>
                            <label for="lastname">นามสกุล</label>
                            <input class="txtinput" type="text" name="lastname" maxlength="35" value="<?php echo $row['lastname'] ?>" required>
                        </div>
                        <div class="groupinput">
                            <label for="gender">เพศ</label>
                            <select name="gender">
                                <option value="ชาย" id="male">ชาย</option>
                                <option value="หญิง" id="female">หญิง</option>
                                <option value="อื่นๆ" id="otherG">อื่นๆ</option>
                            </select>
                            <script type="text/javascript">
                                selectgender('<?php echo $row['gender'] ?>');
                            </script>
                            <label for="PhoneNumber">เบอร์โทรศัพท์</label>
                            <input class="txtinput" type="text" name="PhoneNumber" maxlength="10" value="<?php echo $row['phone'] ?>" required>
                        </div>

                        <div class="groupinput">
                            <label for="status">ตำแหน่ง</label>
                            <select name="status">
                                <option value="พนักงานส่ง" id="em1">พนักงานส่ง</option>
                                <option value="ผู้จัดการ" id="em2">ผู้จัดการ</option>
                            </select>
                            <script type="text/javascript">
                                selectststus('<?php echo $row['EMstatus'] ?>');
                            </script>
                        </div>
                    </div>
                    <div style="text-align: center;">
                        <button class="btn" type="submit" name="userEdit">บันทึก</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <script src="js/jquery-3.5.1.slim.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

</body>

</html>