<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPPM POLINEMA</title>
    <link rel="stylesheet" href="assets/css/landingStyle.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <link rel="icon" href="assets/img/SPPMicon.png">

</head>

<body>
    <header>
        <img src="assets/img/logoSPPM.png" alt="SPPM logo">
        <div class="login">
            <a href="index">
                <button type="submit" class="login">Login</button>
            </a>
        </div>
    </header>
    <main>
        <div class="news-container">
            <img class="news-image" src="<?=$newsData['dokumentasiPath']?>" alt="">
            <div class="news-label">
                <img src="assets/img/breaking-news.png" alt="">
                <div class="news-content" style="display: block;">

                    <div class="news-title"><?=$newsData['namaLomba']?></div>
                    <div class="news-ticker">
                        <div class="news-wrapper">
                            <div class="news-item">
                                <?=$newsData['nama']?> memenangkan Juara 1 pada Lomba <?=$newsData['namaLomba']?> di bidang <?=$newsData['bidang']?> tanggal <?=$newsData['waktu']?>
                            </div>
                            <!-- <div class="news-item">Berita 2: Update Teknologi</div>
                            <div class="news-item">Berita 3: Lomba IT Nasional</div>
                            <div class="news-item">Berita 4: Acara Kampus</div> -->
                            <!-- Duplikat elemen untuk ilusi ticker -->
                            <!-- <div class="news-item">Berita 1: Informasi Penting</div>
                            <div class="news-item">Berita 2: Update Teknologi</div>
                            <div class="news-item">Berita 3: Lomba IT Nasional</div>
                            <div class="news-item">Berita 4: Acara Kampus</div> -->
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="leaderboard">
            <div class="title"> PAPAN PERINGKAT</div>
            <div class="list">
                <div class="item">
                    <div class="rank-nama">
                        <div class="rank">
                            1
                        </div>
                        <div class="nama">
                            Hanifah Kurniasari
                        </div>
                    </div>
                    <div class="points">
                        50 points | Teknik Informatika
                    </div>
                    <div class="rank-nama">
                        <div class="rank">
                            2
                        </div>
                        <div class="nama">
                            Hanifah Kurniasari
                        </div>
                    </div>
                    <div class="points">
                        50 points | Teknik Informatika
                    </div>
                    <div class="rank-nama">
                        <div class="rank">
                            3
                        </div>
                        <div class="nama">
                            Hanifah Kurniasari
                        </div>
                    </div>
                    <div class="points">
                        50 points | Teknik Informatika
                    </div>
                    <div class="rank-nama">
                        <div class="rank">
                            4
                        </div>
                        <div class="nama">
                            Hanifah Kurniasari
                        </div>
                    </div>
                    <div class="points">
                        50 points | Teknik Informatika
                    </div>
                    <div class="rank-nama">
                        <div class="rank">
                            5
                        </div>
                        <div class="nama">
                            Hanifah Kurniasari
                        </div>
                    </div>
                    <div class="points">
                        50 points | Teknik Informatika
                    </div>
                    <div class="rank-nama">
                        <div class="rank">
                            6
                        </div>
                        <div class="nama">
                            Hanifah Kurniasari
                        </div>
                    </div>
                    <div class="points">
                        50 points | Teknik Informatika
                    </div>
                    <div class="rank-nama">
                        <div class="rank">
                            7
                        </div>
                        <div class="nama">
                            Hanifah Kurniasari
                        </div>
                    </div>
                    <div class="points">
                        50 points | Teknik Informatika
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php require_once 'assets/component/footer.html' ?>
    <script>
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

    </script>
</body>

</html>