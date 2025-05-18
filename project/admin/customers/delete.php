<?php
//Lấy id từ URL
$id = $_GET['id'];
//Kết nối cơ sở dữ liệu
include_once "../connection/open.php";
//Xóa khách hàng với ID tương ứng
$sql = "DELETE FROM customers WHERE CUS_ID = '$id'";
mysqli_query($connection, $sql);
//Đóng kết nối cơ sở dữ liệu
include_once "../connection/close.php";
//quay lại danh sách
header(header: "Location: index.php");
?>