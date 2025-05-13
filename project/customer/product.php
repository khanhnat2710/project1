<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chi Tiết Sản Phẩm</title>
  <link rel="stylesheet" href="style.css">
  <style>
    /* Định dạng chung */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f5f5f5;
      color: #333;
      display: flex;
      flex-direction: column;
      min-height: 100vh; /* Đảm bảo chiều cao tối thiểu của trang là 100% chiều cao màn hình */
    }

    .container {
      width: 90%;
      max-width: 1200px;
      margin: 0 auto;
    }

    /* Header */
    .main-header {
      background-color: #d70018;
      color: white;
      padding: 10px 0;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .main-header .logo {
      font-size: 24px;
      font-weight: bold;
      text-transform: uppercase;
      margin: 0;
    }

    .main-header .main-nav ul {
      list-style: none;
      padding: 0;
      margin: 0;
      display: flex;
    }

    .main-header .main-nav ul li {
      margin-left: 20px;
    }

    .main-header .main-nav ul li a {
      color: white;
      text-decoration: none;
      font-size: 16px;
      padding: 5px 10px;
      transition: background-color 0.3s ease;
    }

    .main-header .main-nav ul li a:hover {
      background-color: #b00014;
      border-radius: 5px;
    }

    /* Nội dung chính */
    .product-detail {
      flex: 1; /* Đẩy footer xuống dưới cùng */
      padding: 50px 0;
      background-color: #fff;
    }

    .product-detail-wrapper {
      display: flex;
      gap: 30px;
      align-items: flex-start;
    }

    .product-image img {
      max-width: 100%;
      height: 400px; /* Đặt chiều cao cụ thể cho ảnh */
      object-fit: cover; /* Đảm bảo ảnh không bị méo */
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .product-info {
      flex: 1;
    }

    .product-name {
      font-size: 28px;
      margin-bottom: 10px;
      color: #333;
    }

    .price {
      font-size: 24px;
      color: #d70018;
      font-weight: bold;
      margin-bottom: 20px;
    }

    .description {
      font-size: 16px;
      margin-bottom: 20px;
      color: #555;
    }

    .features {
      list-style: none;
      padding: 0;
      margin: 0 0 20px 0;
    }

    .features li {
      font-size: 16px;
      margin-bottom: 10px;
    }

    .features li strong {
      color: #333;
    }

    .action-buttons {
      display: flex;
      gap: 15px;
    }

    .action-buttons button {
      background-color: #d70018;
      color: white;
      border: none;
      padding: 10px 20px;
      font-size: 16px;
      cursor: pointer;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    .action-buttons button:hover {
      background-color: #b00014;
    }

    /* Footer */
    .main-footer {
      background-color: #333;
      color: white;
      text-align: center;
      padding: 20px 0;
      margin-top: auto; /* Đảm bảo footer luôn nằm ở dưới cùng */
      clear: both; /* Xóa ảnh hưởng của các phần tử float */
    }

    .main-footer p {
      margin: 0;
      font-size: 14px;
    }

    /* Float Contact */
    .float-contact {
      position: fixed; /* Định vị cố định */
      bottom: 20px; /* Cách đáy 20px */
      right: 20px; /* Cách phải 20px */
      z-index: 9999; /* Đảm bảo nó nằm trên các phần tử khác */
    }

    .float-contact div {
      margin-bottom: 10px; /* Khoảng cách giữa các nút */
    }

    .float-contact img {
      display: block; /* Đảm bảo ảnh không bị inline */
      width: 50px; /* Kích thước ảnh */
      height: 50px;
      border-radius: 50%; /* Bo tròn ảnh */
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Hiệu ứng bóng đổ */
      transition: transform 0.3s ease; /* Hiệu ứng khi hover */
    }

    .float-contact img:hover {
      transform: scale(1.1); /* Phóng to nhẹ khi hover */
    }
  </style>
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
    <div class="container">
      <h1 class="logo">SalephoneS</h1>
      <nav class="main-nav">
        <ul>
          <li><a href="menu.php">Trang chủ</a></li>
          <li><a href="#">Sản phẩm</a></li>
          <li><a href="#">Khuyến mãi</a></li>
          <li><a href="#">Liên hệ</a></li>
        </ul>
      </nav>
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
            <button class="add-cart">Thêm vào giỏ hàng</button>
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
      <p>&copy; 2025 SalephoneS | Hỗ trợ: support@salephones.com</p>
    </div>
  </footer>
</body>
</html>