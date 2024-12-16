window.onload = () => {
    const newsWrapper = document.querySelector('.news-wrapper');
    const newsItems = document.querySelectorAll('.news-item');

    // Gandakan berita untuk menciptakan ilusi aliran tak terputus
    newsItems.forEach(item => {
        const clone = item.cloneNode(true);
        newsWrapper.appendChild(clone);
    });

    // Tunggu sampai layout sepenuhnya selesai
    setTimeout(() => {
        // Menghitung panjang total berita
        let totalWidth = 0;
        document.querySelectorAll('.news-item').forEach(item => {
            totalWidth += item.offsetWidth + 50; // Tambahkan margin antar item
        });

        // Sesuaikan durasi animasi berdasarkan panjang konten
        const animationDuration = totalWidth / 50; // Semakin besar pembagi, semakin lambat
        newsWrapper.style.animationDuration = `${animationDuration}s`;
    }, 100); // Penundaan 100ms untuk memastikan render selesai
};