<?php include('conectDB.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="stly.css">
    <title>Admin</title>
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
                

                <form method="post" action="saveemployee.php">
                    <div style="text-align: center;">
                        <h5>เพิ่มข้อมูลพนักงาน</h5>

                        <div class="groupinput">
                            <label for="name">ชื่อ</label>
                            <input class="txtinput" type="text" name="name" maxlength="35" required>
                            <label for="lastname">นามสกุล</label>
                            <input class="txtinput" type="text" name="lastname" maxlength="35" required>
                        </div>
                        <div class="groupinput">
                            <label for="gender">เพศ</label>
                            <select name="gender">
                                <option value="ชาย">ชาย</option>
                                <option value="หญิง">หญิง</option>
                                <option value="อื่นๆ">อื่นๆ</option>
                            </select>
                            <label for="PhoneNumber">เบอร์โทรศัพท์</label>
                            <input class="txtinput" type="text" name="PhoneNumber" maxlength="10" required>
                        </div>

                        <div class="groupinput">
                            <label for="status">ตำแหน่ง</label>
                            <select name="status">
                                <option value="พนักงานส่ง">พนักงานส่ง</option>
                                <option value="ผู้จัดการ">ผู้จัดการ</option>
                            </select>
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