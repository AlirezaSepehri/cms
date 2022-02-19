<?php
include '../database/db.php';
if ($_SESSION["role"] != 2) {
    header("location:../index.php");
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Admin</title>
</head>

<body>
    <br>
    <div class="container">
        <div class="row">
            <ul class="nav nav-pills nav-fill">
                <li class="nav-item">
                    <a class="nav-link" href="page/menu.php">منو</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="page/blog.php">وبلاگ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="page/comment.php">نویسندگان</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="page/user.php">اعضا</a>
                </li>
            </ul>
        </div>
    </div>
</body>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery-3.6.0.min.js"></script>

</html>