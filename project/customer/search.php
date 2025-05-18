<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Kết quả tìm kiếm</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="stylesea.css">
</head>
<body>
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

    <!-- Footer -->
    <footer class="main-footer">
        <p>&copy; 2025 SalephoneS | Hotline: 0869 733 436 | <a href="mailto:support@salephones.com" style="color:#ffd600;">support@salephones.com</a></p>
    </footer>
</body>
</html>