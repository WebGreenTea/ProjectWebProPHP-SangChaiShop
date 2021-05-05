<?php
include('conectDB.php');
$sql = "SELECT * FROM product WHERE typeid=2 AND brandsid=3";
$PDtable = mysqli_query($conect, $sql); ?>
<?php while ($rowPD = mysqli_fetch_array($PDtable)) { ?>
    <div class="w3-col l3 s6">
        <div class="w3-contaiber">
            <img src="<?php echo $rowPD['img'] ?>" style="width: 100%;">
            <p><?php echo $rowPD['name'] ?><br><b><?php echo $rowPD['price'] ?></b></p>
            <?php
            $brandsid = $rowPD['brandsid'];
            $sql2 = "SELECT brandsname FROM brands WHERE brandsid=$brandsid";
            $brandstable = mysqli_query($conect, $sql2);
            $rowbrands = mysqli_fetch_array($brandstable);

            ?>
            <a href="product/mainboard/<?php echo $rowbrands['brandsname'] ?>.php?infocpu=<?php echo $rowPD['id'] ?>" class="w3=button">รายละเอียดสินค้า</a>
        </div>
    </div>

<?php } ?>