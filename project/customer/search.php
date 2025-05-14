<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Kết quả tìm kiếm</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .search-result-title {
            text-align: center;
            margin: 30px 0 20px 0;
            font-size: 22px;
            color: #d70018;
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
            transition: transform 0.3s, box-shadow 0.3s;
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
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .main-header {
            background-color: #d70018;
            color: white;
            padding: 10px 0;
        }
        .main-header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .main-header .logo {
            font-size: 24px;
            font-weight: bold;
        }
        .main-nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            gap: 20px;
        }
        .main-nav a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            transition: color 0.2s;
        }
        .main-nav a:hover, .main-nav a.active {
            color: #ffd600;
        }
        .main-footer {
            background: #222;
            color: #fff;
            text-align: center;
            padding: 20px 0;
            margin-top: 40px;
        }
        .main-footer p {
            margin: 0;
            font-size: 14px;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }
        .back-home-btn {
            display: inline-block;
            background: #d70018;
            color: #fff !important;
            padding: 12px 32px;
            border-radius: 25px;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            box-shadow: 0 2px 8px rgba(215,0,24,0.08);
            transition: background 0.3s, transform 0.2s;
            margin-top: 10px;
        }
        .back-home-btn:hover {
            background: #b00014;
            color: #ffd600 !important;
            transform: translateY(-2px) scale(1.04);
            text-decoration: none;
        }
    </style>
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