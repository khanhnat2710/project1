<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SalephoneS - Trang Chủ</title>
  <link rel="stylesheet" href="style2.css">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    html, body {
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
        background: #333;
        text-align: center;
        padding: 20px 0;
    }
  </style>
</head>
<body>
  <?php
    // Mở kết nối đến DB
    include_once "../admin/Connection/open.php";
    //Lấy giá trị đang tìm kiếm
    if(isset($_GET['keyword'])){
        $keyword = $_GET['keyword'];
    } else {
        $keyword = '';
    }
    // Viết SQL lấy dữ liệu
    $sql = "SELECT products.*, brands.NAME AS brand_name, types.NAME AS type_name 
            FROM products INNER JOIN brands 
            ON brands.BRAND_ID = products.BRAND_ID INNER JOIN types 
            ON types.TYPE_ID = products.TYPE_ID
            WHERE products.NAME LIKE '%$keyword%'";
    // Chạy query
    $products = mysqli_query($connection, $sql);
    // Đóng kết nối đến DB
    include_once "../admin/Connection/close.php";
  ?>

  <!-- Header -->
  <header class="main-header">
    <div class="container" style="display: flex; align-items: center;">
      <h1 href="menu.php" class="logo" style="margin-left: 20px;">SalephoneS</h1>
      <nav class="main-nav" style="margin-left: 40px;">
        <ul>
          <li><a href="menu.php" >Trang chủ</a></li>
          <li><a href="productList.php">Sản phẩm</a></li>
          <li><a href="contact.php" class="active">Liên hệ</a></li>
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
      <input type="text" name="keyword" placeholder="Tìm kiếm sản phẩm..." value="<?php echo isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : ''; ?>">
      <button type="submit">Tìm kiếm</button>
    </form>
  </div>

    <!-- Contact section -->
    <section class="contact-section">
        <div class="container">
            <h1>Trụ sở chính</h1>
            <iframe src="https://www.google.com/maps/embed?pb=!1m13!1m8!1m3!1d522.5584594068139!2d106.485939!3d20.40314!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMjDCsDI0JzEyLjAiTiAxMDbCsDI5JzA5LjYiRQ!5e1!3m2!1svi!2s!4v1748484692330!5m2!1svi!2s" 
                width="625" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
    <div class="container map">
      <p>&copy; 2025 SalephoneS | Hotline: 0869 733 436 | <a href="mailto:support@salephones.com" style="color:#ffd600;">support@salephones.com</a></p>
    </div>
  </footer>

  <script src="script.js"></script>
</body>
</html>