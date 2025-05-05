<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Điện Thoại Store - Trang Chủ</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
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
  <section class="products">
    <h2>Sản phẩm nổi bật</h2>
    <div class="product-grid">
      <!-- Mỗi sản phẩm được bọc trong thẻ <a> chuyển hướng tới trang chi tiết tương ứng -->
      <a href="product.php" class="product">
        <img src="samsung.jpg" alt="Samsung Galaxy S24 Ultra">
        <h3>Samsung Galaxy S24 Ultra</h3>
        <p>28,000,000 VNĐ</p>
      </a>
      <a href="#" class="product">
        <img src="iphone.jpg" alt="iPhone 15 Pro Max">
        <h3>iPhone 15 Pro Max</h3>
        <p>32,000,000 VNĐ</p>
      </a>
      <a href="#" class="product">
        <img src="pixel.jpg" alt="Google Pixel 8 Pro">
        <h3>Google Pixel 8 Pro</h3>
        <p>21,000,000 VNĐ</p>
      </a>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <p>&copy; 2025 Điện Thoại Store | Hỗ trợ: support@dienthoaistore.com</p>
  </footer>
</body>
</html>