<?php
include '../../database/db.php';
if ($_SESSION["role"] != 2) {
    header("location:../index.php");
}
$number = 1;
if (isset($_POST['sub'])) {
    $title = $_POST['username'];
    $sort = $_POST['role'];
    $result = $conn->prepare("INSERT INTO user SET username=? , role=?");
    $result->bindValue(1, $username);
    $result->bindValue(2, $role);
    $result->execute();
}

$all = $conn->prepare("SELECT * FROM user");
$all->execute();
$users = $all->fetchAll(PDO::FETCH_ASSOC);
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
    <br>
    <div class="container">
        <div class="row">
            <ul class="nav nav-pills nav-fill">
                <li class="nav-item">
                    <a class="nav-link " href="menu.php">منو</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="blog.php">وبلاگ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="comment.php">نویسندگان</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#">اعضا</a>
                </li>
            </ul>
        </div>
        

        <br><br><br><br><br><br>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">نام</th>
                        <th scope="col">نقش</th>
                        <th scope="col">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) { ?>
                        <tr>
                            <th scope="row"><?php echo $number++; ?></th>
                            <td><?php echo $user["username"]; ?></td>
                            <td><?php echo $user["role"]; ?></td>
                            <td>
                                <a href="edituser.php?id=<?php echo $user['id']; ?>" class="btn btn-warning">ویرایش</a>
                                <a href="deleteuser.php?id=<?php echo $user['id']; ?>" class="btn btn-danger">حدف</a>
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