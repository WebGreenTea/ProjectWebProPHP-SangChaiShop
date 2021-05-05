<?php
session_start();
include('../conectDB.php');
$row = $_GET['row'];
$Uid = $_SESSION['userid'];
$sql = "SELECT `address` FROM user_data WHERE userid=$Uid";
$result = mysqli_query($conect, $sql);
$rowdata = mysqli_fetch_array($result);


?>

<div class="Uaddress">
    <form>
        <div class="addressarea">
            <label for="adress" class="H">ที่อยู่สำหรับการจัดส่งสินค้าของคุณ</label>
            <textarea id="addressarea" name="address" cols="100" rows="4" maxlength="300" required disabled><?php echo $rowdata['address'] ?></textarea>
        </div>
        <div class="editadddiv">
            <button type="button" class="btninorder" id="editbtn" onclick="btnEdit()">แก้ไข</button><br>
            <button type="button" class="btninorder" id="savebtn" onclick="btn_saveAddress()" disabled>บันทึก</button>
        </div>
        <p class="H"><br>รายการการสั่งซื้อของคุณ</p>
        <table id="table">
            <tr>
                <th class="tdH" style="width: 400px;">
                    <p class="tablehead">สินค้า</p>
                </th>
                <th class="tdH" style="width: 100px;">
                    <p class="tablehead">ราคาต่อชิน</p>
                </th>
                <th class="tdH" style="width: 100px;">
                    <p class="tablehead">จำนวน</p>
                </th>
                <th class="tdH" style="width: 100px;">
                    <p class="tablehead">ราคารวม</p>
                </th>
            </tr>
            <?php $flag = 0; ?>
            <?php while ($flag < $row) { ?>
                <tr>
                    <td id="row<?php echo $flag ?>col0"></td>
                    <td id="row<?php echo $flag ?>col1"></td>
                    <td id="row<?php echo $flag ?>col2"></td>
                    <td id="row<?php echo $flag ?>col3"></td>
                </tr>
                <?php $flag += 1; ?>
            <?php } ?>
        </table>
        <div style="margin: 30px auto;width:120px;"><button class="submitorder" type="button" onclick="submitorder()">ยืนยันคำสั่งซื้อและชำระเงิน</button></div>
    </form>
</div>