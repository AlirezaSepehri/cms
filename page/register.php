<?php
include "../database/db.php";
$successmessage = null;
if (isset($_POST['sub'])) {
    $name = $_POST['username'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $password = $_POST['password'];

    $result = $conn->prepare("INSERT INTO user set username=?, email=?,age=?,password=?");
    $result->bindValue(1, $name);
    $result->bindValue(2, $email);
    $result->bindValue(3, $age);
    $result->bindValue(4, $password);
    $result->execute();
    $successmessage = true;
}
?>

<html lang="fa">

<head>
    <meta charset="UTF-8">
    <title>weblog</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="//cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                    <input name="username" type="text" placeholder="نام کاربری">
                    <input name="email" type="email" placeholder="ایمیل">
                    <input name="age" type="number" placeholder="سن">
                    <input name="password" type=" password" placeholder="رمز عبور"><br>
                    <input name="sub" type="submit" value="ثبت نام" class="btn btn-success submit-register">
                </form>
            </div>
            <div class="col-lg-4"></div>
        </div>
    </div>

    <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <!--start footer-->

    <footer>
        <div class="footer1">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-7"><br><br><br>
                        <form>
                            <input type="text" class="input-group" placeholder="پست الکترونیکی">
                            <input type="submit" class="btn btn-success" value="عضویت در خبرنگار">
                        </form>
                    </div>
                    <div class="col-12 col-lg-5">
                        <div class="namad">
                            <img src="https://toplearn.com/site/images/star2.png" height="160px" alt="">
                            <img src="https://toplearn.com/site/images/logo-samandehi.png" height="160px" alt="">
                        </div>
                        <div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="footer2">
            <p class="container">کلیه حقوق سایت برای طراح سایت محفوظ است.</p>
        </div>
    </footer>

</body>

<?php if ($successmessage) { ?>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'success',
            title: 'ثبت نام با موفقیت انجام شد.'
        })
    </script>
<?php } ?>

<script src="../js/jquery-3.6.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

</html>
