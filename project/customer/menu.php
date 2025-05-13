<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SalephoneS - Trang Chủ</title>
  <link rel="stylesheet" href="style.css">
  <style>
    /* Định dạng chung */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f5f5f5;
      color: #333;
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

    .main-header .main-nav ul li a:hover,
    .main-header .main-nav ul li a.active {
      background-color: #b00014;
      border-radius: 5px;
    }

    /* Banner Section */
    .banner-section {
      margin: 20px 0;
      text-align: center;
    }

    .banner-section .main-banner {
      max-width: 100%;
      height: auto;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    /* Sản phẩm nổi bật */
    .products {
      padding: 50px 0;
      background-color: #fff;
    }

    .products h2 {
      text-align: center;
      font-size: 28px;
      margin-bottom: 30px;
    }

    .product-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
    }

    .product {
      text-align: center;
      background-color: #f9f9f9;
      border: 1px solid #ddd;
      border-radius: 5px;
      padding: 20px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      text-decoration: none;
      color: #333;
    }

    .product img {
      max-width: 100%;
      height: auto;
      margin-bottom: 15px;
      border-radius: 5px;
    }

    .product h3 {
      font-size: 18px;
      margin-bottom: 10px;
    }

    .product .price {
      font-size: 16px;
      color: #d70018;
      font-weight: bold;
    }

    .product:hover {
      transform: translateY(-5px);
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    /* Footer */
    .main-footer {
      background-color: #333;
      color: white;
      text-align: center;
      padding: 20px 0;
    }

    .main-footer p {
      margin: 0;
      font-size: 14px;
    }

    .float-contact {
      position: fixed;
      bottom: 60px;
      right: 20px;
      z-index: 99999;
    }
    .chat-zalo, .chat-facebook, .call-hotline {
      display: block;
      margin-bottom: 6px;
      line-height: 0;
    }
  </style>
</head>
<body>
  <?php
        // Mở kết nối đến DB
        include_once "../admin/Connection/open.php";
        // Viết SQL lấy dữ liệu
        $sql = "SELECT products.*, brands.NAME AS brand_name, types.NAME AS type_name FROM products INNER JOIN brands ON brands.BRAND_ID = products.BRAND_ID INNER JOIN types ON types.TYPE_ID = products.TYPE_ID";
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
          <li><a href="menu.php" class="active">Trang chủ</a></li>
          <li><a href="#">Sản phẩm</a></li>
          <li><a href="#">Khuyến mãi</a></li>
          <li><a href="#">Liên hệ</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <!-- Banner Section -->
  <section class="banner-section">
    <div class="container">
      <img src="../admin/image/banner1.png" alt="Banner chính" class="main-banner">
    </div>
  </section>

  <!-- Sản phẩm nổi bật -->
  <section id="products" class="products">
    <div class="container">
      <h2>Sản phẩm nổi bật</h2>
      <div class="product-grid">
        <?php foreach ($products as $product) { ?>
          <a href="product.php?id=<?php echo $product["PRD_ID"]; ?>" class="product">
            <img src="../admin/image/<?php echo $product['IMAGE']; ?>" alt="Ảnh sản phẩm">
            <h3><?php echo $product['NAME']; ?></h3>
            <p class="price"><?php echo number_format($product['PRICE'], 0, ',', '.'); ?> đ</p>
          </a>
        <?php } ?>
      </div>
    </div>
  </section>

  <div class='float-contact'>
 <div class='chat-zalo'>
 <a href='https://zalo.me/0869733436' target='_blank'>
  <img title='Chat Zalo' src='../admin/image/zalo.png' width='40' height='40' />
  </a>
 </div>

 <div class="chat-facebook">
  <a href="https://www.facebook.com/khanh.nguyen.293038" target="_blank">
  <img title="Chat Facebook" src="../admin/image/mess.png" alt="facebook-icon" width="40" height="40" /></a>
 </div>
 <div class="call-hotline">
  <a href="tel:0869733436"><img title="Call Hotline" src="../admin/image/call2.png" alt="phone-icon" width="40" height="40" /></a>
 </div>

</div>

  <!-- Footer -->
  <footer class="main-footer">
    <div class="container">
      <p>&copy; 2025 SalephoneS | Hỗ trợ: support@salephones.com</p>
    </div>
  </footer>

  <script src="script.js"></script>
</body>
</html>