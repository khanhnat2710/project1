<?php
    session_start();
    //lấy username và password từ form
    $username = $_POST["username"];
    $password = $_POST["password"];
    //Mở kết nối
    include_once "../connection/open.php";
    //viết sql
    $sql = "SELECT *, COUNT(ADMIN_ID) AS count_id FROM admins WHERE USERNAME='$username' AND PASSWORD='$password'";
    //chạy sql
    $result = mysqli_query($connection, $sql);
    //đóng kết nối
    include_once "../connection/close.php";
    //kiểm tra username và password có đúng không
    foreach ($result as $row){
        if($row['count_id'] == 0 ){
            //quay về trang login
            header("Location: login.php");
        } else {
            //lưu account lên session
            $_SESSION['ADMIN_ID'] = $row['ADMIN_ID'];
            $_SESSION['USERNAME'] = $row['USERNAME'];
            $_SESSION['PASSWORD'] = $row['PASSWORD'];
            //quay về trang admin
            header("location: ../admins/index.php");
        }
    }
?>