<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>customers</title>
    <link rel="stylesheet" href="../../layouts/style.css">
</head>
<body>
    <?php
        include_once "../../layouts/header.php";
    ?>
    <?php
        //mở kết nối
        include_once "../connection/open.php";
        //viết sql
        $sql = "SELECT * FROM customers";
        //chạy query
        $customers = mysqli_query($connection, $sql);
        //đóng kết nối
        include_once "../connection/close.php";
        //hiển thị dữ liệu
    ?>
    <a href="create.php">
        <button class="button-name" role="button">Add new customer</button>
    </a>
    <table class="table table-striped table-hover">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>email</th>
            <th>gender</th>
            <th>phone</th>
            <th>address</th>
            <th>description</th>
            <th></th>
            <th></th>
        </tr>
        <?php
            foreach ($customers as $customer) {
        ?>
            <tr>
                <td>
                    <?php echo $customer['CUS_ID']; ?>
                </td>
                <td>
                    <?php echo $customer['NAME']; ?>
                </td>
                <td>
                    <?php echo $customer['EMAIL']; ?>
                </td>
                <td>
                    <?php echo $customer['GENDER'];?>
                </td>
                <td>
                    <?php echo $customer['PHONE_NUMBER']; ?>
                </td>
                <td>
                    <?php echo $customer['ADDRESS']; ?>
                </td>
                <td>
                    <?php echo $customer['DESCRIPTION']; ?>
                </td>
                <td>
                    <a href="edit.php?id=<?php echo $customer['CUS_ID']; ?>">
                        <button class="vista-button"><div>Edit</div></button>
                    </a>
                </td>
                <td>
                    <a href="delete.php?id=<?php echo $customer['CUS_ID']; ?>">
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