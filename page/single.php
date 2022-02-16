<?php include "../database/db.php";
include "../js/jdf.php";

$posts = $conn->prepare("SELECT * FROM post WHERE title=?");
$posts->execute();
$posts = $posts->fetch(PDO::FETCH_ASSOC);

$writers = $conn->prepare("SELECT * FROM writers");
$writers->execute();
$writers = $writers->fetchAll(PDO::FETCH_ASSOC);

?>



<html lang="fa">

<head>
    <meta charset="UTF-8">
    <title><?php echo $posts['title']; ?></title>
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
                        <a class="nav-link" href="#">خانه <span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">پروفایل</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            مقالات
                        </a>
                        <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">aaa</a>
                            <a class="dropdown-item" href="#">bbb</a>
                            <a class="dropdown-item" href="#">ccc</a>
                        </div>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0 margin-right" style="margin-right:auto;">
                    <input class="form-control mr-sm-2 placholder" type="search" placeholder="دنبال چی میگردی؟" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">جستجو</button>
                </form>
            </div>
        </nav>
    </div>
    <!-- end headers -->
    <br><br><br>
    <div class="container">
        <div class="row">
            <div class="post-page">
                <div class="image-post">
                    <img src="<?php echo $posts['image']; ?>">
                </div>
                <div class="information-post">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                        </svg>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-person-fill" viewBox="0 0 16 16">
                            <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm-1 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0zm-3 4c2.623 0 4.146.826 5 1.755V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-1.245C3.854 11.825 5.377 11 8 11z" />
                        </svg><?php
                                foreach ($writers as $writer) {
                                    if ($posts["writer"] == $writer["id"]) {
                                        echo $writer["name"];
                                    }
                                }
                                ?>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-minus" viewBox="0 0 16 16">
                            <path d="M5.5 9.5A.5.5 0 0 1 6 9h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z" />
                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                        </svg><?php echo jdate(format: "d F", timestamp: $posts['date']); ?>
                    </div>
                </div>
                <br><br>
                <div class="content-post">
                    <h5><?php echo $posts['title']; ?></h5>
                    <br>
                    <?php echo $posts['content']; ?>
                </div>
                <br>
                <div class="tag-post">
                    <?php $tags = explode(separator: ",", string: $posts["tag"]);
                    foreach ($tags as $tag) {
                    ?>
                        <span><?php echo $tag; ?></span>
                    <?php } ?>
                </div><br>
                <div>
                    <b>نظرات کاربران در رابطه با این دوره</b>
                    <form><br>
                        <textarea placeholder="پیام خود را وارد کنید" name="editor1" id="editor1">&lt;p&gt;Write your comment.&lt;/p&gt;</textarea>
                        <script>
                            CKEDITOR.replace('editor1');
                        </script><br>
                        <input type="submit" value="ثبت نظر" class="btn btn-success">
                    </form>
                </div>
                <div class="comments">
                    <div class="comment-item">
                        <div class="comment-image">
                            <img src="../image/profile.png" width=100px alt="">
                        </div>
                        <div class="comment-text">
                            <p class="username-comment">محمد معین محمدی</p>
                            <span>ارسال شده در 1400/10/22</span>
                            <a href="" class="btn btn-success" style="margin-right: 5px">ثبت پاسخ</a>
                            <a href="" class="btn btn-warning">گزارش</a>
                            <br><br>
                            <p class="text-comment">سلام دوره آموزشیتان خیلی مفید بود موفق باشید.</p>
                            <p class="text-comment">. weblog shoma ali ast</p>
                            <p class="text-comment">1385</p>
                        </div>
                    </div>
                </div>
            </div>
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

<script src="../js/jquery-3.6.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

</html>