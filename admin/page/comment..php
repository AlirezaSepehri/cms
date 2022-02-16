<?php
include '../../database/db.php';
if ($_SESSION["role"] != 2) {
    header("location:../index.php");
}
$number = 1;
if (isset($_POST['sub'])) {
    $name = $_POST['name'];
    $result = $conn->prepare("INSERT INTO writers SET name=?");
    $result->bindValue(1, $name);
    $result->execute();
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/bootstrap.css">
    <link rel="stylesheet" href="../../css/style.css">
    <title>Admin</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <ul class="nav nav-pills nav-fill">
                <li class="nav-item">
                    <a class="nav-link" href="menu.php">منو</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="blog.php">وبلاگ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#">نویسندگان</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                </li>
            </ul>
        </div><br>
        <div class="row">
            <form method="post"> <br>
                <input name="name" type="text" placeholder="نام و نام خانوادگی" class="form-control"><br>
                <input type="submit" value="ثبت" name="sub" class="btn btn-primary">
            </form>
        </div>
    </div>
</body>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/jquery-3.6.0.min.js"></script>

</html>