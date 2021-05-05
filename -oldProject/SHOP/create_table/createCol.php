<?php
include('../conectDB.php');
$col = $_GET['col'];
if (isset($_GET['pdid'])) {
    $pdid = $_GET['pdid'];
    $sql = "SELECT * FROM product WHERE productid=$pdid";
    $result = mysqli_query($conect, $sql);
    $rowData = mysqli_fetch_array($result);
}
if (isset($_GET['count'])) {
    $count = $_GET['count'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php if ($col == 0) : ?>
        <div class="frampiccartCO">
            <?php if (is_null($rowData['picture']) || $rowData['picture'] == "") {
                $imgurl = "ไม่มีภาพ";
                echo $imgurl;
            } else {
                $imgurl = 'productPic/' . $rowData['picture'];
            } ?>
            <img src="<?php echo $imgurl; ?>" class="picincart" alt="<?php echo $rowData['productid'] ?>" id="pdid<?php echo $Cwhile ?>">
        </div>
        <div class="framnamecartCO">
            <label class="PDnamecart"><?php echo $rowData['PDname'] ?></label>
        </div>
    <?php elseif ($col == 1) : ?>
        <label><?php echo $rowData['price'] ?></label>
    <?php elseif ($col == 2) : ?>
        <label><?php echo $count ?></label>
    <?php elseif ($col == 3) : ?>
        <label class="PDpricecart"><?php echo $count*$rowData['price'] ?></label>
    <?php endif ?>
</body>

</html>