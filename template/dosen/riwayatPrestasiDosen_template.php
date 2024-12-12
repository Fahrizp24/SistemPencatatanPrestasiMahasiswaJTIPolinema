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
    <link rel="icon" href="img/logoJTI.png">
</head>

<body>
    <div class="container">
        <?php require_once 'assets/component/header.html' ?>
        <?php require_once 'assets/component/sidebarDosen.html' ?>
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
                        <h3>Dokumentasi</h3>
                        <ul class="file-list">
                            <li>
                                <p>Sertifikat</p>
                                <button id="sertifikatPath">Lihat</button>
                                <div id="sertifikat-modal">
                                    <div class="modal-content">
                                        <span class="close">&times;</span>
                                        <h2>Sertifikat</h2>
                                        <hr class="separator">
                                        <img class="modal-image" src="<?php echo $prestasi['sertifikatPath']; ?>"
                                            alt="<?php echo $prestasi['sertifikatPath']; ?>">
                                    </div>
                                </div>
                            </li>
                            <li>
                                <p>Dokumentasi</p>
                                <button id="dokumentasiPath">Lihat</button>
                                <div id="dokumentasi-modal">
                                    <div class="modal-content">
                                        <span class="close">&times;</span>
                                        <h2>Dokumentasi</h2>
                                        <hr class="separator">
                                        <img class="modal-image" src="<?php echo $prestasi['dokumentasiPath']; ?>"
                                            alt="<?php echo $prestasi['dokumentasiPath']; ?>">
                                    </div>
                                </div>
                            </li>
                            <li>
                                <p>Surat Tugas</p>
                                <button id="suratTugasPath">Lihat</button>
                                <div id="suratTugas-modal">
                                    <div class="modal-content">
                                        <span class="close">&times;</span>
                                        <h2>Surat Tugas</h2>
                                        <hr class="separator">
                                        <img class="modal-image" src="<?php echo $prestasi['suratTugasPath']; ?>"
                                            alt="<?php echo $prestasi['suratTugasPath']; ?>">
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <?php
                        if ($prestasi['status'] == 'ditolak') {
                            $prestasi['status'] = 'ditolak';
                        } else if ($prestasi['status'] == 'diterimaAdmin') {
                            $prestasi['status'] = 'diterima';
                        } else if ($prestasi['status'] == 'diproses') {
                            $prestasi['status'] = 'diproses';
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
                <div class="back-button">
                    <a href="berandaDosen"> <button><i class="fas fa-arrow-left"></i>Kembali</button></a>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="footer">
        ©2024 | SPPM JTI POLINEMA
        <img src="assets/view/img/LogoPolinema.png" alt="logo POLINEMA" width="20" height="20">
    </div>
    </div>
    <script>
        // Array untuk menyimpan modal dan tombol
        var modals = [
            { modal: document.getElementById("sertifikat-modal"), btn: document.getElementById("sertifikatPath") },
            { modal: document.getElementById("dokumentasi-modal"), btn: document.getElementById("dokumentasiPath") },
            { modal: document.getElementById("suratTugas-modal"), btn: document.getElementById("suratTugasPath") }
        ];

        // Fungsi untuk membuka modal
        modals.forEach(function (item) {
            item.btn.onclick = function () {
                item.modal.style.display = "block";
            };
        });

        // Fungsi untuk menutup modal
        function closeModal(modal) {
            modal.style.display = "none";
        }

        // Menambahkan event listener untuk tombol close
        var closeButtons = document.getElementsByClassName("close");
        Array.from(closeButtons).forEach(function (closeBtn, index) {
            closeBtn.onclick = function () {
                closeModal(modals[index].modal);
            };
        });

        // Menutup modal jika pengguna mengklik di luar modal
        window.onclick = function (event) {
            modals.forEach(function (item) {
                if (event.target == item.modal) {
                    closeModal(item.modal);
                }
            });
        };
    </script>
</body>

</html>