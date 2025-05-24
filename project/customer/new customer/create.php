<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo tài khoản mới</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        h1 {
            color: #007bff;
        }
    </style>
</head>
<body>

<div class="container form-container">
    <h1 class="text-center mb-4">Đăng ký tài khoản</h1>
    <form action="store.php" method="post">
        <div class="mb-3">
            <label for="name" class="form-label">Tên khách hàng</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Nhập tên khách hàng" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Nhập email" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">SĐT</label>
            <input type="text" name="phone" id="phone" class="form-control" placeholder="Nhập số điện thoại" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Mật khẩu</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Nhập mật khẩu" required>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Địa chỉ</label>
            <textarea name="address" id="address" class="form-control" rows="3" placeholder="Nhập địa chỉ"></textarea>
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
            <textarea name="description" id="description" class="form-control" rows="3" placeholder="Nhập thông tin khách hàng"></textarea>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Thêm</button>
        </div>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>