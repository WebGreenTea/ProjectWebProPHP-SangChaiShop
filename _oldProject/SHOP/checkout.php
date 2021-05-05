<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="stly.css">
</head>
<body>
<nav class="topbar">
        <ul>
            <li id="logo">SHOP</li>
            <?php if (isset($_SESSION['username'])) : ?>
                <li class="topbarli"><a href="index.php?logout='1'" class="btnsign">Logout</a></li>
                <li class="topbarli">
                    <p><?php echo $_SESSION['username'] ?></p>
                </li>
            <?php else : ?>
                <li class="topbarli"><a href="registerPage.php" class="btnsign">Register</a></li>
                <li class="topbarli"><a href="loginpage.php" class="btnsign">Login</a></li>
            <?php endif ?>
        </ul>
    </nav>
</body>
</html>