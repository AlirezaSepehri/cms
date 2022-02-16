<?php
include '../../database/db.php';
$id = $_GET['id'];
if (isset($_POST['sub'])) {;
    $name = $_POST['name'];
    $result = $conn->prepare("UPDATE writers SET name=? WHERE id=?");
    $result->bindValue(1, $name);
    $result->bindValue(2, $id);
    $result->execute();
}
$all = $conn->prepare("SELECT * FROM writers WHERE id=?");
$all->bindValue(1, $id);
$all->execute();
$writer = $all->fetch(PDO::FETCH_ASSOC);
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
                <input name="name" type="text" placeholder="عنوان" class="form-control" value="<?php echo $writer['name'] ?>"><br>
                <input type="submit" value="ثبت" name="sub" class="btn btn-primary">
                <a href="comment.php" class="btn btn-danger">بازگشت</a>
            </form>
            <br>
        </div>
    </div>
</body>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/jquery-3.6.0.min.js"></script>

</html>