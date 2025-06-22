<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Danh sách sản phẩm theo hãng</title>
    <!-- Link CSS giống các file trong folder customer -->
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .product-title {
            font-size: 1.15rem;
            /* Tăng kích thước chữ */
            font-weight: 700;
            margin-bottom: 10px;
            text-align: center;
            color: #222;
            letter-spacing: 0.5px;
            padding: 4px 0;
        }
    </style>
</head>

<body>
    <?php
    // Lấy brand_id từ URL nếu có, nếu không thì để rỗng
    $brandId = isset($_GET['brand_id']) ? $_GET['brand_id'] : '';
    // Mở kết nối
    include_once "../admin/connection/open.php";
    // Nếu có brand_id thì lấy tên brand và sản phẩm
    if ($brandId != '') {
        // Lấy tên brand
        $sql = "SELECT NAME FROM brands WHERE BRAND_ID = '$brandId'";
        $brands = mysqli_query($connection, $sql);
        foreach ($brands as $brand) {
            $brandName = $brand['NAME'];
        }
        // Lấy tất cả sản phẩm thuộc brand đã chọn
        $sqlProduct = "SELECT * FROM products WHERE BRAND_ID = '$brandId'";
        $products = mysqli_query($connection, $sqlProduct);
    }
    // Đóng kết nối
    include_once "../admin/connection/close.php";
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

    <div class="container my-5">
        <?php if (!empty($brandId) && isset($brandName)): ?>
            <h2 class="mb-4 text-primary">Tất cả sản phẩm của <?php echo htmlspecialchars($brandName); ?></h2>
            <div class="product-grid">
                <?php if (isset($products) && mysqli_num_rows($products) > 0): ?>
                    <?php foreach ($products as $product): ?>
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
                <?php else: ?>
                    <p>Không có sản phẩm nào thuộc hãng này.</p>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <h2>Vui lòng chọn hãng sản phẩm!</h2>
        <?php endif; ?>
    </div>

    <div class='float-contact'>
        <div class='chat-zalo'>
            <a href='https://zalo.me/0869733436' target='_blank'>
                <img title='Chat Zalo' src='../admin/image/zalo.png' width='40' height='40' />
            </a>
        </div>

        <div class="chat-facebook">
            <a href="https://www.facebook.com/khanh.nguyen.293038" target="_blank">
                <img title="Chat Facebook" src="../admin/image/mess.png" alt="facebook-icon" width="40"
                    height="40" /></a>
        </div>
        <div class="call-hotline">
            <a href="tel:0869733436"><img title="Call Hotline" src="../admin/image/call2.png" alt="phone-icon"
                    width="40" height="40" /></a>
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