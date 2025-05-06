<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Điện Thoại Store - Trang Chủ</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <?php
        //Mở kết nối đến DB
        include_once "../admin/Connection/open.php";
        //Viết sql lấy dữ liệu
        $sql = "SELECT products.*, brands.NAME AS brand_name, types.NAME AS type_name FROM products INNER JOIN brands ON brands.BRAND_ID = products.BRAND_ID INNER JOIN types ON types.TYPE_ID = products.TYPE_ID";
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

  <!-- Hero Section -->
  <section class="hero">
    <h2>Ưu đãi mùa lễ hội</h2>
    <p>Mua ngay những mẫu điện thoại hot nhất với giá ưu đãi!</p>
    <button onclick="window.location.href='#'">Xem sản phẩm</button>
  </section>

  <!-- Sản phẩm nổi bật -->
        <?php
            foreach ($products as $product){
        ?>
  <section class="products">
    <h2>Sản phẩm nổi bật</h2>
    <div class="product-grid">
      <!-- Mỗi sản phẩm được bọc trong thẻ <a> chuyển hướng tới trang chi tiết tương ứng -->
      <a href="product.php?id=<?php echo $product["PRD_ID"]; ?>" class="product">
        <img src="<?php echo $product['IMAGE'] ?>" >
        <h3><?php echo $product['NAME'] ?></h3>
        <p><?php echo $product['PRICE']; ?></p>
      </a>
      
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