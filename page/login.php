<?php
include '../database/db.php';
if (isset($_POST['sub'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $result = $conn->prepare('SELECT * FROM user WHERE email=? AND password=?');
    $result->bindValue(1, $email);
    $result->bindValue(2, $password);
    $result->execute();
    if ($result->rowCount() >= 1) {
        $rows = $result->fetch(PDO::FETCH_ASSOC);
        $_SESSION["login"] = true;
        $_SESSION["email"] = $email;
        $_SESSION["password"] = $password;
        $_SESSION["role"] = $rows["role"];
        if (isset($_POST['rem'])) {
            setcookie('email', $_SESSION['email'], time() + 60 * 60 * 24 * 7, '/');
            setcookie('password', $_SESSION['password'], time() + 60 * 60 * 24 * 7, '/');
        } else {
            echo 0;
        }
        
    } else {
        echo 'no user';
    }header("location:../");
}
?>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <title>weblog</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="//cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
</head>

<body>

    <div class="container">
        <br>
        <!-- start headers -->
        <nav class="navbar navbar-expand-lg navbar-light bg-dark">
            <a class="navbar-brand" href="#">وبلاگ</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="../index.php">خانه <span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="pages.php">مقالات <span class="sr-only"></span></a>
                    </li>
                    
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            مقالات
                        </a>
                        <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">aaa</a>
                            <a class="dropdown-item" href="#">bbb</a>
                            <a class="dropdown-item" href="#">ccc</a>
                        </div>
                    </li> -->
                </ul>
                <form class="form-inline my-2 my-lg-0 margin-right" style="margin-right:auto;">
                    <input class="form-control mr-sm-2 placholder" type="search" placeholder="دنبال چی میگردی؟" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">جستجو</button>
                </form>
            </div>
        </nav>
    </div><br><br>
    <!-- end headers -->
    <div class="container">
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <form method="POST" class="register-form">
                    <input type="email" placeholder="ایمیل" name="email">
                    <input type="password" placeholder="رمز عبور" name="password"><br>
                    <input type="checkbox" class="rememberme" name="rem"><span class="remembermelabel">مرا به خاطر بسپار</span>
                    <input type="submit" value="ثبت نام" class="btn btn-success submit-register" name="sub">
                </form>
            </div>
            <div class="col-lg-4"></div>
        </div>
    </div>

</body>

<script src="../js/jquery-3.6.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

</html>