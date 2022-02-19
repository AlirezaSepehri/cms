<?php
include '../../database/db.php';
if ($_SESSION["role"] != 2) {
    header("location:../index.php");
}
$id = $_GET['id'];
if (isset($_POST['sub'])) {
    $username = $_POST['username'];
    $rd = $_POST['rd'];
    $result = $conn->prepare("UPDATE user SET username=? , role=? WHERE id=?");
    $result->bindValue(1, $username);
    $result->bindValue(2, $rd);
    $result->bindValue(3, $id);
    $result->execute();
}
$all = $conn->prepare("SELECT * FROM user WHERE id=?");
$all->bindValue(1, $id);
$all->execute();
$user = $all->fetch(PDO::FETCH_ASSOC);
?>
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
        <div class="row" style="padding: 3%;">
            <form method="post"> <br>
                <input name="username" type="text" placeholder="نام" class="form-control" value="<?php echo $user['username'] ?>"><br>
                <div class="custom-control custom-radio">
                    <input type="radio" value="2" id="customRadio1" name="rd" class="custom-control-input" <?php if ($user['role'] == 2) { ?> checked <?php } ?>>
                    <label class="custom-control-label" for="customRadio1">ادمین</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" value="1" id="customRadio2" name="rd" class="custom-control-input" <?php if ($user['role'] == 1) { ?> checked <?php } ?>>
                    <label class="custom-control-label" for="customRadio2">عادی</label>
                </div><br>
                <input type="submit" value="ثبت" name="sub" class="btn btn-primary">
                <a href="user.php" class="btn btn-danger">بازگشت</a>
            </form>
            <br>
        </div>
    </div>
</body>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/jquery-3.6.0.min.js"></script>

</html>