<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa kiểu máy</title>

</head>
<body>
    <?php
        include_once "../../layouts/header.php";
    ?>
    <?php
        //Lấy id
        $id = $_GET['id'];
        //Kết nối db
        include_once "../Connection/open.php";
        //Viết sql
        $sql = "SELECT * FROM types WHERE TYPE_ID = '$id'";
        //Chạy sql
        $types = mysqli_query($connection, $sql);
        //Đóng kết nối
        include_once "../Connection/close.php";
        //Hiển thị dữ liệu lấy được
    ?>
    <form method="post" action="update.php">
        <?php
            foreach ($types as $row){
        ?>
            <label for="id">ID: </label><input type="text" name="id" id="id" readonly value="<?php echo $row['TYPE_ID']; ?>"><br>
            <label for="name">Tên kiểu máy: </label><input type="text" name="name" id="name" value="<?php echo $row['NAME']; ?>"><br>
        <?php
            }
        ?>
        <button>Add</button>
    </form>
    <!-- <?php
        include_once "../../layouts/footer.php";
    ?> -->
</body>
</html>