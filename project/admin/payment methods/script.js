// Hàm hiển thị modal
function showModal(deleteUrl) {
    const modal = document.getElementById('deleteModal');
    const confirmButton = document.getElementById('confirmDelete');

    // Hiển thị modal
    modal.style.display = 'block';

    // Gắn URL xóa vào nút xác nhận
    confirmButton.onclick = function () {
        window.location.href = deleteUrl;
    };
}

// Hàm đóng modal
function closeModal() {
    const modal = document.getElementById('deleteModal');
    modal.style.display = 'none';
}