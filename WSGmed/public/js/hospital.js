// public/js/hospital.js
document.addEventListener('DOMContentLoaded', () => {
    const toggleBtn = document.getElementById('sidebarToggle');
    const sidebar = document.querySelector('.sidebar');
    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('collapsed');
    });
});
