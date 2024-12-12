<?php
require_once 'assets/component/check_login.php';
?>

<html>

<head>
    <title>
        SPPM POLINEMA
    </title>
    <link rel="stylesheet" href="assets/css/detailPrestasi.css">
    <script src="assets/js/jquery-3.7.1.js"></script>
    <script src="assets/js/jquery-form.js"></script>
    <link rel="icon" href="assets/img/SPPMicon.png">
</head>

<body>
    <div class="container">
        <?php require_once 'assets/component/header.html' ?>
        <?php require_once 'assets/component/sidebarAdmin.html' ?>
        <div class="content">
            <div class="main-content">
                <h1>Detail Prestasi</h1>
                <hr class="separator">
                <div class="isi-form">
                    <div class="form-group">
                        <div>
                            <label>Nama Lomba</label>
                            <p><?php echo $prestasi['namaLomba']; ?></p>
                            <label>Penyelenggara</label>
                            <p><?php echo $prestasi['penyelenggara']; ?></p>
                            <label>Bidang</label>
                            <p><?php echo $prestasi['bidang']; ?></p>
                            <label>Tanggal Final (YY//MM/DD)</label>
                            <p><?php echo $prestasi['waktu']; ?></p>
                            <label>Dosen Pembimbing</label>
                            <p><?php echo $prestasi['nipDosenPembimbing']; ?></p>
                            <label>Jenis</label>
                            <p><?php echo $prestasi['jenis']; ?></p>
                        </div>
                    </div>

                    <div class="document-form">
                        <div class="documentation">
                            <h3>Dokumentasi</h3>
                            <ul class="file-list">
                                <div class="form-group">
                                    <label>Dokumentasi</label>
                                </div>
                                <li>
                                    <p>Sertifikat</p>
                                    <button id="sertifikat-<?php echo $prestasi['sertifikatPath']; ?>">Lihat</button>
                                </li>
                                <li>
                                    <p>Dokumentasi</p>
                                    <button id="dokumentasi-<?php echo $prestasi['dokumentasiPath']; ?>">Lihat</button>
                                </li>
                                <li>
                                    <p>Surat Tugas</p>
                                    <button id="<?php echo $prestasi['suratTugasPath']; ?>">Lihat</button>
                                </li>
                            </ul>
                            <?php
                            if ($prestasi['status'] == 'diterimaDosen') {
                                $prestasi['status'] = 'diproses';
                            } else if($prestasi['status'] == 'diterimaAdmin') {
                                $prestasi['status']='diterima';
                            } 
                            ?>
                            <div class="statusPrestasi">
                                <span>Status:</span>
                                <span class="statusPrestasi status-<?php echo $prestasi['status'] ?>">
                                    <?php echo ucwords($prestasi['status']); ?>
                                </span>
                            </div>
                            <div class="keterangan">
                                <label for="keterangan" style="font-weight: bold;">Keterangan :</label>
                                <textarea id="keterangan" readonly></textarea>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="back-button">
                    <a href="berandaAdmin"> <button><i class="fas fa-arrow-left"></i>Kembali</button></a>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="footer">
    ©2024 | SPPM JTI POLINEMA
        <img src="assets/img/LogoPolinema.png" alt="logo POLINEMA" width="20" height="20">
    </div>
    </div>

</body>

</html>