<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SalephoneS - Trang Chủ</title>
  <link rel="stylesheet" href="style2.css">
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
  <?php
  // Mở kết nối đến DB
  include_once "../admin/Connection/open.php";
  //Lấy giá trị đang tìm kiếm
  if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
  } else {
    $keyword = '';
  }
  // Viết SQL lấy dữ liệu
  // Lấy tất cả sản phẩm cùng loại
  $sql = "SELECT products.*, brands.NAME AS brand_name, types.NAME AS type_name 
            FROM products 
            INNER JOIN brands ON brands.BRAND_ID = products.BRAND_ID 
            INNER JOIN types ON types.TYPE_ID = products.TYPE_ID
            WHERE products.NAME LIKE '%$keyword%'";
  $result = mysqli_query($connection, $sql);

  // Nhóm sản phẩm theo thương hiệu (brand)
  $productsByBrand = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $productsByBrand[$row['brand_name']][] = $row;
  }
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
          <li><a href="productList.php" class="active">Sản phẩm</a></li>
          <li><a href="contact.php">Liên hệ</a></li>
        </ul>
      </nav>

      <div style="margin-left:auto; display:flex; align-items:center;">
        <?php
        session_start();
        if (isset($_SESSION['CUS_ID'])): ?>
          <!-- Dropdown menu icon user -->
          <div class="dropdown">
            <i class="fas fa-user-circle user-icon"></i>
            <div class="dropdown-content">
              <a href="cartCustomer/index.php"><i class="fas fa-shopping-cart"></i> Giỏ hàng</a>
              <a href="order/orderList.php"><i class="fa-solid fa-truck"></i> Đơn hàng của tôi</a>
              <a href="login/logout.php"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
            </div>
          </div>
        <?php else: ?>
          <a href="login/login.php" class="login-btn">Đăng nhập</a>
          <a href="new customer/create.php" class="login-btn">Đăng ký</a>
        <?php endif; ?>
      </div>
    </div>
  </header>

  <!-- Thanh tìm kiếm -->
  <div class="search-bar-container">
    <form class="search-bar-form" method="get" action="search.php">
      <input type="text" name="keyword" placeholder="Tìm kiếm sản phẩm..."
        value="<?php echo isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : ''; ?>">
      <button type="submit">Tìm kiếm</button>
    </form>
  </div>

  <!-- Sản phẩm nổi bật -->
  <section id="products" class="products">
    <div class="container">
      <h2>Các sản phẩm</h2>
      <?php foreach ($productsByBrand as $brandName => $products) { ?>
        <h3 style="margin-top:30px; color:#333;"><?php echo htmlspecialchars($brandName); ?></h3>
        <div class="product-grid">
          <?php
          $count = 0;
          foreach ($products as $product):
            if ($count >= 4)
              break;
            // Hiển thị sản phẩm
            $count++;
            ?>
            <!-- Hiển thị sản phẩm -->
            <a href="product.php?id=<?php echo $product["PRD_ID"]; ?>" class="product">
              <img src="../admin/image/<?php echo $product['IMAGE']; ?>" alt="Ảnh sản phẩm">
              <h3><?php echo $product['NAME']; ?></h3>
              <p class="price"><?php echo number_format($product['PRICE'], 0, ',', '.'); ?> đ</p>
              <div class="product-spec-info">
                <div><strong>Chip:</strong> <?php echo $product['CHIP']; ?></div>
                <div><strong>RAM:</strong> <?php echo $product['RAM']; ?></div>
                <div><strong>ROM:</strong> <?php echo $product['ROM']; ?></div>
              </div>
            </a>
          <?php endforeach; ?>
        </div>
        <?php if (count($products) > 4): ?>
          <div class="d-flex justify-content-end" style="margin-top: 10px;">
            <a href="list.php?brand_id=<?php echo $product['BRAND_ID']; ?>"
              class="btn btn-outline-danger d-flex align-items-center"
              style="border-radius: 30px; padding: 6px 16px; font-weight: 500;">
              Xem thêm <i class="fa-solid fa-arrow-right ms-2"></i>
            </a>
          </div>
        <?php endif; ?>
      <?php } ?>
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
      <a href="tel:0869733436"><img title="Call Hotline" src="../admin/image/call2.png" alt="phone-icon" width="40"
          height="40" /></a>
    </div>

  </div>

  <!-- Footer -->
  <footer class="main-footer">
    <div class="container">
      <p>&copy; 2025 SalephoneS | Hotline: 0869 733 436 | <a href="mailto:support@salephones.com"
          style="color:#ffd600;">support@salephones.com</a></p>
    </div>
  </footer>

  <script src="script.js"></script>
</body>

</html>