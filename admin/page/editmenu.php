<?php
include '../../database/db.php';
if ($_SESSION["role"] != 2) {
    header("location:../index.php");
}
$id = $_GET['id'];
if (isset($_POST['sub'])) {
    $title = $_POST['title'];
    $sort = $_POST['sort'];
    $rd = $_POST['rd'];
    $result = $conn->prepare("UPDATE menu SET title=? , sort=? , status=? WHERE id=?");
    $result->bindValue(1, $title);
    $result->bindValue(2, $sort);
    $result->bindValue(3, $rd);
    $result->bindValue(4, $id);
    $result->execute();
}
$all = $conn->prepare("SELECT * FROM menu WHERE id=?");
$all->bindValue(1, $id);
$all->execute();
$menu = $all->fetch(PDO::FETCH_ASSOC);
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
                <input name="title" type="text" placeholder="عنوان" class="form-control" value="<?php echo $menu['title'] ?>"><br>
                <input name="sort" type="number" placeholder=" اولویت بندی" class="form-control" value="<?php echo $menu['sort'] ?>"><br>
                <div class="custom-control custom-radio">
                    <input type="radio" value="1" id="customRadio1" name="rd" class="custom-control-input" <?php if ($menu['status'] == 1) { ?> checked <?php } ?>>
                    <label class="custom-control-label" for="customRadio1">فعال</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" value="0" id="customRadio2" name="rd" class="custom-control-input" <?php if ($menu['status'] == 0) { ?> checked <?php } ?>>
                    <label class="custom-control-label" for="customRadio2">غیرفعال</label>
                </div><br>
                <input type="submit" value="ثبت" name="sub" class="btn btn-primary">
                <a href="menu.php" class="btn btn-danger">بازگشت</a>
            </form>
            <br>
        </div>
    </div>
</body>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/jquery-3.6.0.min.js"></script>

</html>