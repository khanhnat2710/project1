<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>admins</title>
    <link rel="stylesheet" href="../../layouts/style.css">
</head>
<body>
    <?php
        session_start();
        if(empty($_SESSION['USERNAME'])){
            header('Location: ../login/login.php');
        }
        include_once "../../layouts/header.php";
    ?>
    <?php
        //mở kết nối
        include_once "../connection/open.php";
        //viết sql
        $sql = "SELECT * FROM admins";
        //chạy query
        $admins = mysqli_query($connection, $sql);
        //đóng kết nối
        include_once "../connection/close.php";
        //hiển thị dữ liệu
    ?>
    <a href="create.php">
        <button class="button-name" role="button">Add new admin</button>
    </a>
    <table class="table table-striped table-hover">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>email</th>
            <th>username</th>
            <th>address</th>
            <th>Role</th>
            <th></th>
            <th></th>
        </tr>
        <?php
            foreach ($admins as $admin) {
        ?>
            <tr>
                <td>
                    <?php echo $admin['ADMIN_ID']; ?>
                </td>
                <td>
                    <?php echo $admin['NAME']; ?>
                </td>
                <td>
                    <?php echo $admin['EMAIL']; ?>
                </td>
                <td>
                    <?php echo $admin['USERNAME'];?>
                </td>
                <td>
                    <?php echo $admin['ADDRESS']; ?>
                </td>
                <td>
                    <?php
                        if ($admin['ROLE'] == 0) {
                            echo "Admin";
                        } else if ($admin['ROLE'] == 1) {
                            echo "manager";
                        } else if ($admin['ROLE'] == 2) {
                            echo "storage manager";
                        } else {
                            echo "Unknown";
                        }
                    ?>
                </td>
                <td>
                    <a href="edit.php?id=<?php echo $admin['ADMIN_ID']; ?>">
                        <button class="vista-button"><div>Edit</div></button>
                    </a>
                </td>
                <td>
                    <a href="delete.php?id=<?php echo $admin['ADMIN_ID']; ?>">
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