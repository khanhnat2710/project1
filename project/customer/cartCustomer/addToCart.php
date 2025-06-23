<?php
    session_start(); 
    //Lấy id của sản phẩm được thêm vào giỏ hàng
    $id = $_GET['id'];

    // Kết nối CSDL để kiểm tra tồn kho
    include_once "../../admin/connection/open.php";
    $sql_check = "SELECT QUANTITY FROM products WHERE PRD_ID = $id";
    $result = mysqli_query($connection, $sql_check);
    $row = mysqli_fetch_assoc($result);

    // Xác định số lượng muốn thêm vào giỏ
    $desired_quantity = 1;
    if(isset($_SESSION['cart_customer'][$id])) {
        $desired_quantity = $_SESSION['cart_customer'][$id] + 1;
    }

    if ($row['QUANTITY'] < $desired_quantity) {
        echo "<script>
            alert('Sản phẩm vượt quá số lượng trong kho.');
            window.location.href='../cartCustomer/index.php';
        </script>";
    }

    //Kiểm tra giỏ hàng đã tồn tại hay chưa
    if(isset($_SESSION['cart_customer'])){
        //Kiểm tra sản phẩm đã tồn tại trên giỏ hàng chưa
        if(isset($_SESSION['cart_customer'][$id])){
            $_SESSION['cart_customer'][$id]++;
        } else {
            $_SESSION['cart_customer'][$id] = 1;
        }
    } else {
        $_SESSION['cart_customer'] = array();
        $_SESSION['cart_customer'][$id] = 1;
    }
    include_once "../../admin/connection/close.php";
    //Chuyển sang danh sách sản phẩm trong giỏ hàng
    header("Location: ../cartCustomer/index.php");
?>