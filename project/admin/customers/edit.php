<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update a customer</title>
    <link rel="stylesheet" href="../../layouts/style.css">
</head>
<body>
    <?php
        //lấy id
        $id = $_GET['id'];
        //mở kết nối
        include_once "../connection/open.php";
        //viết sql
        $sql = "SELECT * FROM customers WHERE CUS_ID = '$id'";
        //chạy query
        $customers = mysqli_query($connection, $sql);
        //đóng kết nối
        include_once "../connection/close.php";
        //hiển thị dữ liệu
    ?>
    <form method="post" action="update.php">
        <?php
            foreach ($customers as $customer) {
        ?>
            <label for="id">ID: </label><input type="text" name="id" id="id" readonly value="<?php echo $customer['CUS_ID']; ?>"><br>
            <label for="name">Name: </label><input type="text" name="name" id="name" value="<?php echo $customer['NAME']; ?>"><br>
            <label for="phone">Phone: </label><input type="text" name="phone" id="phone" value="<?php echo $customer['PHONE_NUMBER']; ?>"><br>
            <label for="email">Email: </label><input type="text" name="email" id="email" value="<?php echo $customer['EMAIL']; ?>"><br>
            <label for="gender">Gender: </label>
            <input type="radio" name="gender" id="gender_male" value="Male" <?php echo ($customer['GENDER'] == 'Male') ? 'checked' : ''; ?>> Male 
            <input type="radio" name="gender" id="gender_female" value="Female" <?php echo ($customer['GENDER'] == 'Female') ? 'checked' : ''; ?>> Female<br>
            <label for="address">Address: </label><textarea name="address" id="address"><?php echo $customer['ADDRESS']; ?></textarea><br>
            <label for="description">Description: </label><textarea name="description" id="description"><?php echo $customer['DESCRIPTION']; ?></textarea><br>
        <?php
            }
        ?>
        <button>Update</button>
    </form>
</body>
</html>