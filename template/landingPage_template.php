<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPPM POLINEMA</title>
    <link rel="stylesheet" href="assets/css/landingStyle.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="assets/img/SPPMicon.png">
    <script src="assets/js/landing-page.js"></script></head>

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
        <?php $count = 1?>
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
                <?php 
                foreach ($leaderboard as $row) {?>
                    <div class="rank-nama">            
                        <div class="rank">
                            <?php echo $count?>
                        </div>
                        <div class="nama">
                            <?php echo $row['nama']?>
                        </div>
                    </div>
                    <div class="points">
                        <?php echo $row['total_poin']?> points | <?php echo $row['namaProdi']?>
                    </div>
                    <?php $count+=1?>
                    <?php }?>
                        
                </div>
            </div>
        </div>
    </main>
    <?php require_once 'assets/component/footer.html' ?>
</body>

</html>