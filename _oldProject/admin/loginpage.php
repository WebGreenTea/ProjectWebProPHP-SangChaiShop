<?php
session_start();
include('conectDB.php'); 
if(isset($_SESSION['accessAdmin'])){
    header('location: index.php');
}
else if(isset($_SESSION['accessEM'])){
    header('location: orderlist.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="stlylogin.css">
</head>

<body>
    <h1 style="color: white;">Login</h1>
    <form action="loginchek.php" method="POST">
        <?php if (isset($_SESSION['error'])) : ?>
            <div class="error">
                <?php echo $_SESSION['error'];
                unset($_SESSION['error']); ?>
            </div>
        <?php endif ?>


        <div class="groupinput">
            <label for="password">รหัสพนักงาน</label>
            <input onfocus="disableerr()" type="password" name="password" maxlength="35" >
        </div>



        <div>
            <button type="submit" name="EMlogin" class="btn">Login</button>
        </div>
    </form>

    <script>
        const errlogin = document.querySelector('.error');

        function disableerr() {
            errlogin.style.display = "none";
        }
    </script>
</body>

</html>