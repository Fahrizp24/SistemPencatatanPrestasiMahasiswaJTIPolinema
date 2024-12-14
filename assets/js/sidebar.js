$(document).ready(function () {
    const menuToggle = document.getElementById('menu-toggle');
    const sidebar = document.getElementById('sidebar');

    // Menambahkan event listener
    menuToggle.addEventListener('click', () => {
        sidebar.classList.toggle('active');
    });

    // Mendapatkan URL path halaman saat ini
    var currentPath = window.location.pathname;
    $('.sidebar a').each(function () {
        var linkPath = $(this).attr('href');
        // Jika URL path cocok dengan href, tambahkan class 'active'
        if (currentPath.includes(linkPath)) {
            $('.sidebar a').removeClass('on'); // Hilangkan class 'active' dari link lainnya
            $(this).addClass('on'); // Tambahkan class 'active' pada link yang sesuai
        }
    });

    $('#logout').click(function () {
        var formData = new FormData();
        formData.append('action', 'logout');
        $.ajax({
            url: 'logout',
            type: 'GET'
        });
        window.location.href = 'index'; e
    });

});