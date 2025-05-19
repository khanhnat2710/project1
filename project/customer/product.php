<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chi Tiết Sản Phẩm</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="styleprd.css">
</head>
<body>
  <?php
        // Mở kết nối đến DB
        include_once "../admin/Connection/open.php";
        // Lấy sản phẩm theo id
        $id = $_GET['id'];
        // Viết SQL lấy dữ liệu
        $sql = "SELECT products.*, brands.NAME AS brand_name, types.NAME AS type_name FROM products 
        INNER JOIN brands ON brands.BRAND_ID = products.BRAND_ID 
        INNER JOIN types ON types.TYPE_ID = products.TYPE_ID
        WHERE products.PRD_ID = '$id'";
        // Chạy query
        $products = mysqli_query($connection, $sql);
        // Đóng kết nối đến DB
        include_once "../admin/Connection/close.php";
  ?>

  <!-- Header -->
  <header class="main-header">
    <div class="container" style="display: flex; align-items: center;">
      <h1 class="logo" style="margin-left: 20px;">SalephoneS</h1>
      <nav class="main-nav" style="margin-left: 40px;">
        <ul>
          <li><a href="menu.php">Trang chủ</a></li>
          <li><a href="#">Sản phẩm</a></li>
          <li><a href="#">Khuyến mãi</a></li>
          <li><a href="#">Liên hệ</a></li>
        </ul>
      </nav>
      <div style="margin-left:auto; display:flex; align-items:center;">
        <?php
          session_start();
          // Dùng đúng tên session như menu.php
          if (isset($_SESSION['CUS_ID'])): ?>
            <a href="cartCustomer/index.php" class="cart-btn">🛒 Giỏ hàng</a>
            <a href="login/logout.php" class="login-btn" style="margin-left:20px;">Đăng xuất</a>
        <?php else: ?>
            <a href="login/login.php" class="login-btn">Đăng nhập</a>
        <?php endif; ?>
      </div>
    </div>
  </header>

  <!-- Nội dung chi tiết sản phẩm -->
  <section class="product-detail">
    <div class="container">
      <?php foreach ($products as $product) { ?>
      <div class="product-detail-wrapper">
        <div class="product-image">
          <img src="../admin/image/<?php echo $product['IMAGE']; ?>" alt="Ảnh sản phẩm">
        </div>
        <div class="product-info">
          <h2 class="product-name"><?php echo $product['NAME']; ?></h2>
          <p class="price"><?php echo number_format($product['PRICE'], 0, ',', '.'); ?> đ</p>
          <p class="description">Sản phẩm <?php echo $product['NAME']; ?> được trang bị công nghệ hiện đại, phù hợp với nhu cầu sử dụng hàng ngày.</p>
          <ul class="features">
            <li><strong>Ram:</strong> <?php echo $product['RAM']; ?></li>
            <li><strong>Chip:</strong> <?php echo $product['CHIP']; ?></li>
            <li><strong>Bộ nhớ trong:</strong> <?php echo $product['ROM']; ?></li>
            <li><strong>Kích thước màn hình:</strong> <?php echo $product['SCREEN_SIZE']; ?></li>
            <li><strong>Độ phân giải camera:</strong> <?php echo $product['CAMERA']; ?></li>
            <li><strong>Màu sắc:</strong> <?php echo $product['COLOR']; ?></li>
            <li><strong>Số lượng hàng còn lại:</strong> <?php echo $product['QUANTITY']; ?></li>
          </ul>
          <div class="action-buttons">
            <button class="buy-now">Mua ngay</button>
            <a href="cartCustomer/addToCart.php?id=<?php echo $product["PRD_ID"]; ?>">
              <button class="add-cart">Thêm vào giỏ hàng</button>
            </a>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>
  </section>

  <div class="float-contact">
    <div class="chat-zalo">
      <a href="https://zalo.me/0869733436" target="_blank">
        <img title="Chat Zalo" src="../admin/image/zalo.png" alt="Chat Zalo">
      </a>
    </div>
    <div class="chat-facebook">
      <a href="https://www.facebook.com/khanh.nguyen.293038" target="_blank">
        <img title="Chat Facebook" src="../admin/image/mess.png" alt="Chat Facebook">
      </a>
    </div>
    <div class="call-hotline">
      <a href="tel:0869733436">
        <img title="Call Hotline" src="../admin/image/call2.png" alt="Call Hotline">
      </a>
    </div>
  </div>

  <!-- Footer -->
  <footer class="main-footer">
    <div class="container">
      <p>&copy; 2025 SalephoneS | Hotline: 0869 733 436 | <a href="mailto:support@salephones.com" style="color:#ffd600;">support@salephones.com</a></p>
    </div>
  </footer>
</body>
</html>