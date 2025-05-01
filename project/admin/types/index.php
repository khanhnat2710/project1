<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>type list</title>
    <link rel="stylesheet" href="../../layouts/style.css">
</head>
<body>
    <?php
        include_once "../../layouts/header.php";
    ?>
    <?php
        //Mở kết nối đến DB
        include_once "../Connection/open.php";
        //Viết sql lấy dữ liệu
        $sql = "SELECT * FROM types";
        //Chạy query
        $types = mysqli_query($connection, $sql);
        //Đóng kết nối đến DB
        include_once "../Connection/close.php";
        //Hiển thị dữ liệu
    ?>
    <a href="create.php">
    <button class="button-name" role="button">Add new type</button>
    </a>
    <table class="table table-striped table-hover">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <td></td>
            <td></td>
        </tr>
        <?php
            foreach ($types as $row){
        ?>
            <tr>
                <td>
                    <?php echo $row['TYPE_ID']; ?>
                </td>
                <td>
                    <?php echo $row['NAME']; ?>
                </td>
                <td>
                    <a href="edit.php?id=<?php echo $row['TYPE_ID']; ?>">
                            <button class="vista-button"><div>Edit</div></button>
                    </a>
                </td>
                <td>
                    <a href="destroy.php?id=<?php echo $row['TYPE_ID']; ?>">
                        <button class="vista-button"><div>Delete</div></button>
                    </a>
                </td>
            </tr>
        <?php
            }
        ?>
    </table>
    <?php
        include_once "../../layouts/footer.php";
    ?>
</body>
</html>