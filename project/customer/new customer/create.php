<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo tài khoản mới</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .form-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #007bff;
        }

        /* Định dạng cho modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.3);
        }

        .modal-content {
            background: #fff;
            border-radius: 8px;
            max-width: 350px;
            margin: 120px auto;
            padding: 24px 20px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.18);
            text-align: center;
            position: relative;
        }

        .modal-content h4 {
            color: #d70018;
            margin-bottom: 12px;
        }

        .modal-content p {
            margin-bottom: 16px;
        }

        .modal-content button {
            margin-top: 16px;
            background: #5bc0de;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 8px 18px;
            font-size: 15px;
            cursor: pointer;
        }

        #openSidebar {
            background: #222;
            color: #fff;
            border-radius: 50%;
            width: 48px;
            height: 48px;
            font-size: 1.7rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.18);
            border: none;
            transition: background 0.2s, box-shadow 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }

        #openSidebar:hover {
            background: #444;
            color: #ffe082;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.28);
        }

        /* CSS cho sidebar */
        #sidebarMenu {
            position: fixed;
            top: 0;
            left: -250px;
            width: 250px;
            height: 100%;
            background: #222;
            color: #fff;
            z-index: 1050;
            transition: left 0.3s;
        }

        #sidebarMenu .close {
            color: #fff;
            opacity: 1;
            font-size: 2rem;
            background: none;
            border: none;
            float: right;
        }

        #sidebarMenu h4 {
            color: #fff;
        }

        #sidebarMenu ul {
            padding-left: 0;
        }

        #sidebarMenu ul li {
            list-style: none;
            margin: 10px 0;
        }

        #sidebarMenu ul li a {
            color: #fff;
            text-decoration: none;
        }

        #sidebarMenu ul li a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <button type="button" id="openSidebar" style="position:fixed;top:20px;left:20px;z-index:1051;">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Sidebar menu -->
    <div id="sidebarMenu" style="position:fixed;top:0;left:-250px;width:250px;height:100%;background:#222;color:#fff;z-index:1050;transition:left 0.3s;">
        <div style="padding:20px;">
            <button type="button" class="close" id="closeSidebar" style="color:#fff;opacity:1;font-size:2rem;background:none;border:none;float:right;">&times;</button>
            <h4 style="color:#fff;">Menu</h4>
            <ul class="nav nav-pills nav-stacked">
                <li><a href="../menu.php" style="color:#fff;"><i class="fa fa-home"></i> Trang chủ</a></li>
                <li><a href="../productList.php" style="color:#fff;"><i class="fa fa-th-list"></i> Sản phẩm</a></li>
                <li><a href="../login/login.php" style="color:#fff;"><i class="fa fa-sign-in-alt"></i> Đăng nhập</a></li>
            </ul>
        </div>
    </div>

    <div class="container form-container">
        <h1 class="text-center mb-4">Đăng ký tài khoản</h1>
        <form action="store.php" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Tên khách hàng</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Nhập tên khách hàng"
                    required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Nhập email" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">SĐT</label>
                <input type="text" name="phone" id="phone" class="form-control" placeholder="Nhập số điện thoại"
                    required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Mật khẩu</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Nhập mật khẩu"
                    required>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Địa chỉ</label>
                <textarea name="address" id="address" class="form-control" rows="3"
                    placeholder="Nhập địa chỉ"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label d-block">Giới tính</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="gender_male" value="Nam">
                    <label class="form-check-label" for="gender_male">Nam</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="gender_female" value="Nữ">
                    <label class="form-check-label" for="gender_female">Nữ</label>
                </div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Thông tin khách hàng</label>
                <textarea name="description" id="description" class="form-control" rows="3"
                    placeholder="Nhập thông tin khách hàng"></textarea>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Thêm</button>
            </div>
        </form>
    </div>

    <!-- Modal cảnh báo trùng email -->
    <div id="emailErrorModal" class="modal" tabindex="-1"
        style="display:none; position:fixed; z-index:9999; left:0; top:0; width:100vw; height:100vh; background:rgba(0,0,0,0.3);">
        <div
            style="background:#fff; border-radius:8px; max-width:350px; margin:120px auto; padding:24px 20px; box-shadow:0 4px 16px rgba(0,0,0,0.18); text-align:center; position:relative;">
            <h4 style="color:#d70018; margin-bottom:12px;">Lỗi đăng ký</h4>
            <p>Email này đã được sử dụng. Vui lòng chọn email khác!</p>
            <button onclick="document.getElementById('emailErrorModal').style.display='none';"
                style="margin-top:16px; background:#5bc0de; color:#fff; border:none; border-radius:5px; padding:8px 18px; font-size:15px; cursor:pointer;">Đóng</button>
        </div>
    </div>

    <?php if (isset($_GET['error']) && $_GET['error'] == 'email'): ?>
        <script>
            window.onload = function () {
                document.getElementById('emailErrorModal').style.display = 'block';
                // Xóa tham số error khỏi URL sau khi hiển thị modal
                if (window.history.replaceState) {
                    const url = new URL(window.location);
                    url.searchParams.delete('error');
                    window.history.replaceState({}, document.title, url.pathname + url.search);
                }
            }
        </script>
    <?php endif; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome JS (Thêm vào để sử dụng biểu tượng menu) -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <!-- Script điều khiển sidebar -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var openBtn = document.getElementById('openSidebar');
            var closeBtn = document.getElementById('closeSidebar');
            var sidebar = document.getElementById('sidebarMenu');

            openBtn.onclick = function(e) {
                sidebar.style.left = '0';
                openBtn.style.display = 'none';
                e.stopPropagation(); 
            };
            closeBtn.onclick = function(e) {
                sidebar.style.left = '-250px';
                openBtn.style.display = 'flex';
                e.stopPropagation();
            };

            // Chỉ đóng sidebar khi click ra ngoài sidebar và không phải nút open
            document.addEventListener('click', function(e) {
                if (
                    sidebar.style.left === '0px' &&
                    !sidebar.contains(e.target) &&
                    e.target !== openBtn
                ) {
                    sidebar.style.left = '-250px';
                    openBtn.style.display = 'flex';
                }
            });

            // Ngăn sự kiện click bên trong sidebar làm đóng sidebar
            sidebar.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        });
    </script>
</body>

</html>