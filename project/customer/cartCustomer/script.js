document.addEventListener("DOMContentLoaded", function () {
    const menuBtn = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebarMenu');

    sidebar.addEventListener('show.bs.offcanvas', function () {
        menuBtn.style.display = 'none';
    });

    sidebar.addEventListener('hidden.bs.offcanvas', function () {
        menuBtn.style.display = 'block';
    });
});