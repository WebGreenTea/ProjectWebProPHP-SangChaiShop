<?php
session_start();
include('conectDB.php'); 
if(isset($_SESSION['username'])){ //user in session jump to index
    header('location: index.php');
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
    <h1>Login</h1>
    <form action="loginchek.php" method="POST">
        <?php if (isset($_SESSION['error'])) : ?>
            <div class="error">
                <?php echo $_SESSION['error'];
                unset($_SESSION['error']); ?>
            </div>
        <?php endif ?>
        <div class="groupinput">
            <label for="username">Username</label>
            <input onfocus="disableerr()" type="text" name="username" maxlength="15">
        </div>


        <div class="groupinput">
            <label for="password">รหัสผ่าน</label>
            <input onfocus="disableerr()" type="password" name="password" maxlength="35" >
        </div>



        <div>
            <button type="submit" name="userlogin" class="btn">Login</button>
        </div>
    </form>
    <p>ยังไม่ได้สมัครสมาชิก? <a href="registerPage.php">Register</a></p>

    <script>
        const errlogin = document.querySelector('.error');

        function disableerr() {
            errlogin.style.display = "none";
        }
    </script>
</body>

</html>