<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm khách hàng</title>
    <link rel="stylesheet" href="../../layouts/style.css">
</head>
<body>
    <?php
        include_once "../../layouts/header.php";
    ?>
    <form action="store.php" method="post">
        <label for="name">Tên khách hàng: </label><input type="text" name="name" id="name"><br>
        <label for="email">email: </label><input type="text" name="email" id="email"><br>
        <label for="phone">SĐT: </label><input type="text" name="phone" id="phone"><br>
        <label for="address">Địa chỉ: </label><textarea name="address" id="address"></textarea><br>
        <label for="gender">Giới tính: </label>
        <input type="radio" name="gender" id="gender" value="Nam"> Nam 
        <input type="radio" name= "gender" id="gender" value="Nữ">Nữ<br>
        <label for="description">Thông tin khách hàng: </label><textarea name="description" id="description"></textarea><br>
        <button>Thêm</button>
    </form>
    <!-- <?php
        include_once "../../layouts/footer.php";
    ?> -->
</body>
</html>