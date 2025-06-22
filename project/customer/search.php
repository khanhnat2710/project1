<?php
session_start();
?>
<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <title>Kết quả tìm kiếm</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="stylesea.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    html,
    body {
      height: 100%;
      margin: 0;
      padding: 0;
    }

    body {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .main-footer {
      margin-top: auto;
    }
  </style>
</head>

<body>
  <!-- Header -->
  <header class="main-header">
    <div class="container" style="display: flex; align-items: center;">
      <h1 class="logo" style="margin-left: 20px;">SalephoneS</h1>
      <nav class="main-nav" style="margin-left: 40px;">
        <ul>
          <li><a href="menu.php" class="active">Trang chủ</a></li>
          <li><a href="productList.php">Sản phẩm</a></li>
          <li><a href="contact.php">Liên hệ</a></li>
        </ul>
      </nav>
      <!-- Thanh tìm kiếm -->
      <div style="margin-left:auto;">
        <form action="search.php" method="get" class="search-box">
          <input type="text" name="keyword" placeholder="Tìm kiếm..."
            value="<?php echo isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : ''; ?>"
            class="search-input">
          <button type="submit" class="search-button">
            <i class="fas fa-search"></i>
          </button>
        </form>
      </div>

      <div style="margin-left:auto; display:flex; align-items:center;">
        <?php if (isset($_SESSION['CUS_ID'])): ?>
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

  <?php
  //Mở kết nối đến DB
  include_once "../admin/Connection/open.php";
  $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
  $products = [];
  if ($keyword !== '') {
    $sql = "SELECT products.*, brands.NAME AS brand_name, types.NAME AS type_name 
                    FROM products 
                    INNER JOIN brands ON brands.BRAND_ID = products.BRAND_ID 
                    INNER JOIN types ON types.TYPE_ID = products.TYPE_ID
                    WHERE products.NAME LIKE '%$keyword%'";
    $result = mysqli_query($connection, $sql);
    if ($result) {
      $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
  }
  include_once "../admin/Connection/close.php";
  ?>
  <div class="container">
    <h2 class="search-result-title">
      Kết quả tìm kiếm cho: <span style="color:#333"><?php echo htmlspecialchars($keyword); ?></span>
    </h2>
    <div class="product-grid">
      <?php if (!empty($products)) { ?>
        <?php foreach ($products as $product) { ?>
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
        <?php } ?>
      <?php } else { ?>
        <p style="grid-column: 1/-1; text-align:center; color:#888;">Không tìm thấy sản phẩm phù hợp.</p>
      <?php } ?>
    </div>
    <div style="text-align:center; margin:30px 0;">
      <a href="menu.php" class="back-home-btn">Quay lại trang chủ</a>
    </div>
  </div>

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
    <p>&copy; 2025 SalephoneS | Hotline: 0869 733 436 | <a href="mailto:support@salephones.com"
        style="color:#ffd600;">support@salephones.com</a></p>
  </footer>
</body>

</html>