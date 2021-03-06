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

$all = $conn->prepare("SELECT * FROM writers");
$all->execute();
$writer = $all->fetchAll(PDO::FETCH_ASSOC);

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/bootstrap.css">
    <link rel="stylesheet" href="../../css/style.css">
    <title>Admin</title>
    <style>
        table{
            margin-bottom: 50px;
        }
    </style>
</head>

<body>
    <br>
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
                    <a class="nav-link" href="user.php">اعضا</a>
                </li>
            </ul>
        </div><br>
        <div class="row">
            <form method="post"> <br>
                <input name="name" type="text" placeholder="نام و نام خانوادگی" class="form-control"><br>
                <input type="submit" value="ثبت" name="sub" class="btn btn-primary">
            </form>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">عنوان</th>
                        <th scope="col">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($writer as $writers) { ?>
                        <tr>
                            <th scope="row"><?php echo $number++; ?></th>
                            <td><?php echo $writers["name"]; ?></td>
                            <td>
                                <a href="editwriter.php?id=<?php echo $writers['id']; ?>" class="btn btn-warning">ویرایش</a>
                                <a href="deletewriter.php?id=<?php echo $writers['id']; ?>" class="btn btn-danger">حدف</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/jquery-3.6.0.min.js"></script>

</html>