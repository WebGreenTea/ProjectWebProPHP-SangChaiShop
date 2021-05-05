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
            <div class="col-md-8" id="bordersalmonproduct">
                <div style="margin: 20px 0px 0px 20px;">
                    <a href="index.php?product=1"><img src="img/back.png" style="height: auto; width: 20px;"> ย้อนกลับ</a>
                </div>


                <form method="post" action="saveNew_product.php" enctype="multipart/form-data">
                    <div style="text-align: center;">
                        <h5>เพิ่มข้อมูลสินค้าใหม่</h5>

                        <div class="groupinput">
                            <label for="name">ชื่อสินค้า</label>
                            <input class="txtinput" type="text" name="name" maxlength="40" required>
                            <label for="brand">ยี่ห้อ</label>
                            <select name="brand">
                                <option value="1">LG</option>
                                <option value="2">Samsung</option>
                                <option value="3">Sony</option>
                                <option value="4">Shap</option>
                                <option value="5">Toshiba</option>
                                <option value="6">Panasonic</option>
                                <option value="7">Philips</option>
                                <option value="8">Mitsubishi</option>
                                <option value="9">Hitachi</option>
                                <option value="10">Hatari</option>
                            </select>
                        </div>
                        <div class="groupinput">
                            <label for="type">ประเภท</label>
                            <select name="type">
                                <option value="1">ตู้เย็น</option>
                                <option value="2">เครื่องซักผ้า</option>
                                <option value="3">พัดลม</option>
                                <option value="4">เครื่องปรับอากาศ</option>
                                <option value="5">เตารีด</option>
                                <option value="6">ไมโครเวฟ</option>
                                <option value="7">ทีวี</option>
                            </select>
                            <label for="price">ราคา</label>
                            <input class="txtinput" type="number" min="0" name="price" required>
                        </div>

                        <div class="groupinput">
                            <label for="img">ภาพ (.png , .jpeg , .jpg)</label>
                            <input type="file" name="img" accept=".png,.jpg,.jpeg,">
                        </div>

                        <div class="groupinput">
                            <label for="txt">ข้อมูลบนหน้าร้านค้า (.txt)</label>
                            <input type="file" name="txt" accept=".txt">
                        </div>

                        <div class="groupinput">
                            <label for="count">จำนวนสินค้าในคลัง</label>
                            <input class="txtinput" type="number" min="0" name="count" required>
                        </div>
                    </div>
                    <div style="text-align: center;">
                        <button class="btn" type="submit" name="submit">บันทึก</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <script src="js/jquery-3.5.1.slim.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

</body>

</html>