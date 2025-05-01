<?php
    //Lấy dữ liệu từ form
    $name = $_POST["name"];
    //Mở kết nối đến DB
    include_once "../Connection/open.php";
    //Viết sql
    $sql = "INSERT INTO types(name) VALUES ('$name')";
    //Chạy sql
    mysqli_query($connection, $sql);
    //Đóng kết nối
    include_once "../Connection/close.php";
    //Quay về danh sách
    header("Location: index.php");
?>