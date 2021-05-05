<?php
session_start();
include('conectDB.php');
if (isset($_SESSION['username'])) { //user in session jump to index
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <div class="mb-3 d-flex justify-content-center bg-info text-light rounded-pill">
            <h1>ลงชื่อเข้าใช้</h1>
        </div>
        <form action="loginchek.php" method="POST">
            <?php if (isset($_SESSION['error'])) : ?>
                <div id="error" class="">
                    <h3 class="d-flex justify-content-center text-danger"><?php echo $_SESSION['error'];?></h3>
                    <?php unset($_SESSION['error']); ?>
                </div>
            <?php endif ?>
            <div class="mb-2">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" maxlength="15" required onfocus="disableerr()">
            </div>
            <div class="mb-2">
                <label for="password" class="form-label">รหัสผ่าน</label>
                <input type="password" class="form-control" id="password" name="password" maxlength="35" required onfocus="disableerr()">
            </div>
            <p class="d-flex justify-content-end">ยังไม่มีบัญชี? <a href="registerPage.php">สร้างบัญชีผู้ใช้</a></p>
            <div class="d-flex justify-content-center">
                <button type="submit" name="userlogin" class="btn btn-success">Login</button>
            </div>
        </form>
    </div>

    <script>
        const errlogin = document.querySelector('#error');

        function disableerr() {
            errlogin.style.display = "none";
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>

</html>