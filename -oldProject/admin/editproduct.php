<?php include('conectDB.php');
$pdid = $_GET['id'];
$sql = "SELECT * FROM product WHERE productid=$pdid";
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
        function selectbrand(x) {
            if (x == 1) {
                document.getElementById("b1").setAttribute("selected", "");
            } else if (x == 2) {
                document.getElementById("b2").setAttribute("selected", "");
            } else if (x == 3) {
                document.getElementById("b3").setAttribute("selected", "");
            } else if (x == 4) {
                document.getElementById("b4").setAttribute("selected", "");
            } else if (x == 5) {
                document.getElementById("b5").setAttribute("selected", "");
            } else if (x == 6) {
                document.getElementById("b6").setAttribute("selected", "");
            } else if (x == 7) {
                document.getElementById("b7").setAttribute("selected", "");
            } else if (x == 8) {
                document.getElementById("b8").setAttribute("selected", "");
            } else if (x == 9) {
                document.getElementById("b9").setAttribute("selected", "");
            } else if (x == 10) {
                document.getElementById("b10").setAttribute("selected", "");
            }
        }

        function selecttype(x) {
            if (x == 1) {
                document.getElementById("t1").setAttribute("selected", "");
            } else if (x == 2) {
                document.getElementById("t2").setAttribute("selected", "");
            } else if (x == 3) {
                document.getElementById("t3").setAttribute("selected", "");
            } else if (x == 4) {
                document.getElementById("t4").setAttribute("selected", "");
            } else if (x == 5) {
                document.getElementById("t5").setAttribute("selected", "");
            } else if (x == 6) {
                document.getElementById("t6").setAttribute("selected", "");
            } else if (x == 7) {
                document.getElementById("t7").setAttribute("selected", "");
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
            <div class="col-md-8" id="bordersalmonproduct">
                <div style="margin: 20px 0px 0px 20px;">
                    <a href="index.php?product=1"><img src="img/back.png" style="height: auto; width: 20px;"> ย้อนกลับ</a>
                </div>


                <form method="post" action="saveEdit_product.php?id=<?php echo $pdid?>" enctype="multipart/form-data">
                    <div style="text-align: center;">
                        <h5>แก้ไขข้อมูลสินค้า</h5>

                        <div class="groupinput">
                            <label for="name">ชื่อสินค้า</label>
                            <input class="txtinput" type="text" name="name" maxlength="40" value="<?php echo $row['PDname'] ?>" required>
                            <label for="brand">ยี่ห้อ</label>
                            <select name="brand">
                                <option value="1" id="b1">LG</option>
                                <option value="2" id="b2">Samsung</option>
                                <option value="3" id="b3">Sony</option>
                                <option value="4" id="b4">Shap</option>
                                <option value="5" id="b5">Toshiba</option>
                                <option value="6" id="b6">Panasonic</option>
                                <option value="7" id="b7">Philips</option>
                                <option value="8" id="b8">Mitsubishi</option>
                                <option value="9" id="b9">Hitachi</option>
                                <option value="10" id="b10">Hatari</option>
                            </select>
                            <script type="text/javascript">
                                selectbrand(<?php echo $row['brandid'] ?>);
                            </script>
                        </div>
                        <div class="groupinput">
                            <label for="type">ประเภท</label>
                            <select name="type">
                                <option value="1" id="t1">ตู้เย็น</option>
                                <option value="2" id="t2">เครื่องซักผ้า</option>
                                <option value="3" id="t3">พัดลม</option>
                                <option value="4" id="t4">เครื่องปรับอากาศ</option>
                                <option value="5" id="t5">เตารีด</option>
                                <option value="6" id="t6">ไมโครเวฟ</option>
                                <option value="7" id="t7">ทีวี</option>
                            </select>
                            <script type="text/javascript">
                                selecttype(<?php echo $row['typeid'] ?>);
                            </script>
                            <label for="price">ราคา</label>
                            <input class="txtinput" type="number" min="0" name="price" value="<?php echo $row['price'] ?>" required>
                        </div>

                        <div class="inputfile">
                            <?php if (is_null($row['picture']) || $row['picture'] == "") : ?>
                                <a style="color: orangered;">สินค้านี้ยังไม่มีภาพ</a>
                                <a>เพิ่มภาพ? (.png , .jpeg , .jpg)</a>
                            <?php else : ?>
                                <a style="color: green;">สินค้านี้มีภาพอยู่แล้ว</a>
                                <a>เปลี่ยนภาพ? (.png , .jpeg , .jpg)</a>
                            <?php endif ?>
                            <input type="file" name="img" accept=".png,.jpg,.jpeg,">
                        </div>

                        <div class="inputfile">
                            <?php if (is_null($row['info']) || $row['info'] == "") : ?>
                                <a style="color: orangered;">สินค้านี้ยังไม่มีข้อมูลบนหน้าร้านค้า</a>
                                <a>เพิ่มข้อมูล? (.txt)</a>
                            <?php else : ?>
                                <a style="color: green;">สินค้านี้มีข้อมูลบนหน้าร้านค้าแล้ว</a>
                                <a>เปลี่ยนข้อมูล? (.txt)</a>
                            <?php endif ?>
                            <input type="file" name="txt" accept=".txt">
                        </div>

                        <div class="groupinput">
                            <label for="count">จำนวนสินค้าในคลัง</label>
                            <input class="txtinput" type="number" min="0" name="count" value="<?php echo $row['count'] ?>" required>
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