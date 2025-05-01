<?php
    //lấy id
    $id = $_GET['id'];
    //mở kêt nối
    include_once "../connection/open.php";
    //viết sql
    $sql = "DELETE FROM admins WHERE ADMIN_ID = '$id'";
    //chạy sql
    mysqli_query($connection, $sql);
    //đóng kết nối
    include_once "../connection/close.php";
    //quay lại danh sách
    header(header:"Location: index.php");
?>