<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chi Tiết Sản Phẩm</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <?php
        //Mở kết nối đến DB
        include_once "../admin/Connection/open.php";
        //lấy sản phẩm theo id
        $id = $_GET['id'];
        //Viết sql lấy dữ liệu
        $sql = "SELECT products.*, brands.NAME AS brand_name, types.NAME AS type_name FROM products 
        INNER JOIN brands ON brands.BRAND_ID = products.BRAND_ID 
        INNER JOIN types ON types.TYPE_ID = products.TYPE_ID
        WHERE products.PRD_ID = '$id'";
        //Chạy query
        $products = mysqli_query($connection, $sql);
        //Đóng kết nối đến DB
        include_once "../admin/Connection/close.php";
        //Hiển thị dữ liệu
    ?>
  <!-- Header giống trang chủ -->
  <header>
    <h1>Điện Thoại Store</h1>
    <nav>
      <ul>
        <li><a href="menu.php">Trang chủ</a></li>
        <li><a href="#">Sản phẩm</a></li>
        <li><a href="#">Khuyến mãi</a></li>
        <li><a href="#">Liên hệ</a></li>
      </ul>
    </nav>
  </header>

  <!-- Nội dung chi tiết sản phẩm -->
        <?php
            foreach ($products as $product){
        ?>
  <section class="product-detail">
    <div class="product-image">
      <img src="<?php echo $product['IMAGE'] ?>" alt="Samsung Galaxy S24 Ultra">
    </div>
    <div class="product-info">
      <h2><?php echo $product['NAME'] ?></h2>
      <p class="price"><?php echo $product['PRICE']; ?></p>
      <p class="description">
        
      </p>
      <ul class="features">
        <li>Ram: <?php echo $product['RAM'] ?></li>
        <li>Chip: <?php echo $product['CHIP']; ?></li>
        <li>Bộ Nhớ trong: <?php echo $product['ROM']; ?></li>
        <li>Kích thước màn hình: <?php echo $product['SCREEN_SIZE']; ?></li>
        <li>Độ phân giải camera: <?php echo $product['CAMERA']; ?></li>
        <li>Màu sắc: <?php echo $product['COLOR']; ?></li>
        <li>Số lượng hàng còn lại: <?php echo $product['QUANTITY']; ?></li>
      </ul>
      <button class="buy-now">Mua ngay</button>
      <button class="add-cart">Thêm vào giỏ hàng</button>
    </div>
  </section>
        <?php 
            }
        ?>
  <!-- Footer -->
  <footer>
    <p>&copy; 2025 Điện Thoại Store | Hỗ trợ: support@dienthoaistore.com</p>
  </footer>
</body>
</html>