<?php
    //lấy dữ liệu
    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $address = $_POST["address"];
    $role = $_POST["role"];
    //mở kết nối
    include_once "../connection/open.php";
    //viết sql
    $sql = "UPDATE admins SET NAME = '$name', EMAIL = '$email', USERNAME = '$username', ADDRESS = '$address', PASSWORD = '$password', ROLE = '$role' WHERE ADMIN_ID = '$id'";
    //chạy sql
    mysqli_query($connection, $sql);
    //đóng kết nối
    include_once "../connection/close.php";
    //quay về danh sách
    header("Location: index.php");
?>