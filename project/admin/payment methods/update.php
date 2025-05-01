<?php
    //Lấy dữ liệu
    $id = $_POST['id'];
    $name = $_POST['name'];
    //Mở kết nối
    include_once "../Connection/open.php";
    //Viết query
    $sql = "UPDATE payment_methods SET name = '$name' WHERE PAY_ID = '$id'";
    //Chạy query
    mysqli_query($connection, $sql);
    //Đóng kết nối
    include_once "../Connection/close.php";
    //Quay về danh sách
    header("Location: index.php");
?>