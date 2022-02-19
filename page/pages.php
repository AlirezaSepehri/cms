<!-- Hklsdf  aslkf;sja;lsdjla-->
<?php
include "../database/db.php";
if(isset($_POST['search'])){
    $search=$_POST['searchcontent'];
    header("location:search.php?post=$search");
}

$result = $conn->prepare("SELECT COUNT(id) FROM post");
$result->execute();
$numposts = $result->fetch(PDO::FETCH_ASSOC);
foreach ($numposts as $numpost) {
}

$result = $conn->prepare("SELECT COUNT(id) FROM writers");
$result->execute();
$numwriters = $result->fetch(PDO::FETCH_ASSOC);
foreach ($numwriters as $numwriter) {
}

$result = $conn->prepare("SELECT COUNT(id) FROM user");
$result->execute();
$numusers = $result->fetch(PDO::FETCH_ASSOC);
foreach ($numusers as $numuser) {
}

$menus = $conn->prepare("SELECT * FROM menu ORDER BY sort");
$menus->execute();
$menus = $menus->fetchAll(PDO::FETCH_ASSOC);

$posts = $conn->prepare("SELECT * FROM post ORDER BY date DESC");
$posts->execute();
$posts = $posts->fetchAll(PDO::FETCH_ASSOC);

$writers = $conn->prepare("SELECT * FROM writers");
$writers->execute();
$writers = $writers->fetchAll(PDO::FETCH_ASSOC);

function limit_words($string, $word_limit)
{
    $words = explode(" ", $string);
    return implode(" ", array_splice($words, 0, $word_limit));
}

?>

<html lang="fa">

<head>
    <meta charset="UTF-8">
    <title>weblog</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
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
                        <a class="nav-link" href="../index.php">خانه</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">مقالات</a>
                    </li>
                    <!-- <?php foreach ($menus as $menu) {
                        if ($menu["status"] == 1) { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="single.php"><?php echo $menu["title"]; ?></a>
                            </li>
                    <?php }
                    } ?> -->

                    <?php if (isset($_SESSION["login"])) { ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                حساب کاربری
                            </a>
                            <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#"><?php echo $_SESSION['email'] ?></a>
                                <?php if ($_SESSION["role"] == 2) { ?><a class="dropdown-item" href="../admin/index.php">پنل ادمین</a> <?php } ?>

                            </div>
                        </li>
                        <li>
                            <a class="exit" href="log.php">خروج</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item active">
                            <a class="nav-link" href="login.php">ورود<span class="sr-only"></span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="register.php">ثبت نام <span class="sr-only"></span></a>
                        </li>
                    <?php } ?>
                </ul>
                <form method="post" class="form-inline my-2 my-lg-0 margin-right" style="margin-right:auto;">
                    <input class="form-control mr-sm-2 placholder" type="search" placeholder="دنبال چی میگردی؟" aria-label="Search" name="searchcontent">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="search">جستجو</button>
                </form>
            </div>
        </nav>
        <!-- end headers -->
        <!-- start content -->
        <br>
        
        <!-- end content -->
        <br><br class="d-none d-lg-block">
        <!-- start posts -->
        <div>
            <h3 style="padding: 10px;">
                مقالات
            </h3>
            <div class="row">
                <?php foreach ($posts as $post) {
                    $idpost = $post["id"];
                    $result = $conn->prepare("SELECT COUNT(*) FROM view WHERE post=?");
                    $result->bindValue(1, $idpost);
                    $result->execute();
                    $numviews = $result->fetch(PDO::FETCH_ASSOC);
                    foreach ($numviews as $numview) {
                    } ?>
                    <div class="col-12 col-lg-6">

                        <div class="post-item">
                            <a href="single.php?post=<?php echo $post["title"]; ?>"><img src="<?php echo $post["image"]; ?>" alt="" width="100%"></a>
                            <div class="post-caption">
                                <p><a href="single.php?post=<?php echo $post["title"]; ?>"><?php echo $post["title"] ?></a></p>
                                <span><?php echo limit_words($post["content"], 14) . "  ..."; ?>
                                </span>
                                <br><br>
                                <span class="seen-post">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                    </svg><?= $numview ?>
                                </span>
                                <span class="seen-post post-comment">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-right-text-fill" viewBox="0 0 16 16">
                                        <path d="M16 2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h9.586a1 1 0 0 1 .707.293l2.853 2.853a.5.5 0 0 0 .854-.353V2zM3.5 3h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1 0-1zm0 2.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1 0-1zm0 2.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1z" />
                                    </svg>7
                                </span>
                                <a href="">
                                    <span class="float-left post-m">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-person-fill" viewBox="0 0 16 16">
                                            <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm-1 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0zm-3 4c2.623 0 4.146.826 5 1.755V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-1.245C3.854 11.825 5.377 11 8 11z" />
                                        </svg><?php foreach ($writers as $writer) {
                                                    if ($post["writer"] == $writer["id"]) {
                                                        echo $writer["name"];
                                                    }
                                                } ?>
                                    </span>
                                </a>
                            </div>
                        </div>

                    </div>
                <?php } ?>

            </div>
        </div>
        <br><br>
    </div>

    <!--end posts-->

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
                    </div>
                </div>
            </div>

        </div>
        <div class="footer2">
            <p class="container">کلیه حقوق سایت برای طراح سایت محفوظ است.</p>
        </div>
    </footer>

</body>

<script src="../js/jquery-3.6.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

</html>