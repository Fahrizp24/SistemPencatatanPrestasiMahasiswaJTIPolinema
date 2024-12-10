<?php
// require_once 'assets/component/check_login.php';

?>
<html>

<head>
    <title>
        SPPM POLINEMA
    </title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/homeStyles.css">
    <link rel="stylesheet" href="assets/css/pengajuanStyle.css">
    <link rel="icon" href="assets/img/SPPMicon.png">
    <script src="assets/js/jquery-3.7.1.js"></script>
    <script src="assets/js/jquery-form.js"></script>
</head>

<body>
    <div class="container">
        <?php require_once 'assets/component/header.html' ?>
        <?php require_once 'assets/component/sidebarMahasiswa.html' ?>
        <div class="content">
            <div class="main-content">
                <div class="status">
                    <h2 class="sub-judul">
                        Form Pengajuan Prestasi
                        <hr class="separator">
                    </h2>
                    <p id="description">
                        Dokumen wajib yang harus anda sertakan adalah <span style="color:red">sertifikat lomba</span>,
                        <span style="color:red"> surat tugas </span> dan <span style="color:red">foto kegiatan</span>,
                        yang di kumpulkan secara terpisah.Semua data yang anda inputkan pada form ini haruslah asli dan
                        bukan rekayasa serta benar-benar dapat dipertanggungjawabkan. Data yang diinputkan harus sesuai
                        dengan isi bukti dokumen yang diupload.
                    </p>
                </div>
                <form class="pengajuan-form" id="pengajuanForm" method="POST" enctype="multipart/form-data">
                    <div class="two-form">
                        <div class="isi-pengajuan">
                            <label for="namaLomba">Nama Lomba</label>
                            <input type="text" id="namaLomba" name="namaLomba" placeholder="">

                            <label for="penyelenggara">Penyelenggara</label>
                            <input type="text" id="penyelenggara" name="penyelenggara" placeholder="">

                            <label for="bidang">Bidang</label>
                            <input type="text" id="bidang" name="bidang" placeholder="">

                            <label for="tingkat">Tingkat</label>
                            <select name="tingkat" id="tingkat">
                                <?php
                                foreach ($tingkat as $row) { ?>
                                    <option value="<?= $row['namaTingkat'] ?>">
                                        <?= $row['namaTingkat'] ?>
                                    </option>
                                <?php } ?>
                            </select>

                            <label for="kategori">Kategori</label>
                            <select name="kategori" id="kategori">
                                <?php
                                foreach ($kategori as $row) { ?>
                                    <option value="<?= $row['namaKategori'] ?>">
                                        <?= $row['namaKategori'] ?>
                                    </option>
                                <?php } ?>
                            </select>

                            <label for="waktu">Tanggal Final</label>
                            <input type="date" id="waktu" name="waktu">

                            <label for="nipDosenPembimbing">NIP Dosen Pembimbing</label>
                            <input type="text" id="nipDosenPembimbing" name="nipDosenPembimbing" placeholder="">

                            <label for="namaDosenPembimbing">Nama Dosen Pembimbing</label>
                            <input type="text" id="namaDosenPembimbing" name="namaDosenPembimbing"
                                placeholder="Cek kembali NIP Dosen!" disabled>

                        </div>
                        <div class="file-pengajuan">
                            <div>
                                <h7>Dokumentasi Wajib</h7>
                                <hr>
                                <p id="pengajuan-detail">Pilih File yang sesuai untuk melengkapi berkas anda</p>
                            </div>
                            <div class="input-image">
                                <div class="file-card">
                                    <div class="file-icon">
                                        <img src="assets/img/upload.png" alt="Upload Icon" />
                                    </div>
                                    <div class="file-info">
                                        <p class="file-label">Sertifikat Lomba</p>
                                        <p class="file-description" id="description-sertifikatLomba">JPG, JPEG atau PNG,
                                            ukuran file tidak lebih dari 2MB
                                        </p>
                                        <input type="file" id="sertifikatLomba" name="sertifikatLomba"
                                            accept=".jpg, .jpeg, .png">
                                    </div>
                                    <label class="upload-button" for="sertifikatLomba">Pilih Dokumen</label>
                                </div>

                                <div class="file-card">
                                    <div class="file-icon">
                                        <img src="assets/img/upload.png" alt="Upload Icon" />
                                    </div>
                                    <div class="file-info">
                                        <p class="file-label">Dokumentasi Lomba</p>
                                        <p class="file-description" id="description-dokumentasiLomba">JPG, JPEG atau
                                            PNG, ukuran file tidak lebih dari 2MB
                                        </p>
                                        <input type="file" id="dokumentasiLomba" name="dokumentasiLomba"
                                            accept=".jpg, .jpeg, .png">
                                    </div>
                                    <label class="upload-button" for="dokumentasiLomba">Pilih Dokumen</label>
                                </div>

                                <div class="file-card">
                                    <div class="file-icon">
                                        <img src="assets/img/upload.png" alt="Upload Icon" />
                                    </div>
                                    <div class="file-info">
                                        <p class="file-label">Surat Tugas</p>
                                        <p class="file-description" id="description-suratTugas">JPG, JPEG atau PNG,
                                            ukuran file tidak lebih dari 2MB
                                        </p>
                                        <input type="file" id="suratTugas" name="suratTugas" accept=".jpg, .jpeg, .png">
                                    </div>
                                    <label class="upload-button" for="suratTugas">Pilih Dokumen</label>
                                </div>
                            </div>

                        </div>
                    </div>
                    <button type="submit">Kirim</button>
                    <div id="status" style="color:red"></div>
                </form>
            </div>
            <div class="footer">
            ©2024 | SPPM JTI POLINEMA
            <img src="assets/img/LogoPolinema.png" alt="logo POLINEMA" width="20" height="20">
        </div>
        </div>
        
        <script>
            const fileSertifikat = document.getElementById('sertifikatLomba'); 
            const descriptionSertifikat = document.getElementById('description-sertifikatLomba'); 

            fileSertifikat.addEventListener('change', function () {
                if (fileSertifikat.files.length > 0) {
                    const file = this.files[0];
                    if (file.size > 2 * 1024 * 1024) {
                        this.value = ""; // Reset input file
                        descriptionSertifikat.innerHTML = 'Ukuran file lebih dari 2MB';
                    } else {
                        descriptionSertifikat.innerHTML = file.name; // menampilkan nama file
                    }
                } else {
                    // Jika tidak ada file, kembalikan teks default
                    descriptionSertifikat.innerHTML = 'JPG, JPEG atau PNG, ukuran file tidak lebih dari 2MB';
                }
            });

            const fileDokumentasi = document.getElementById('dokumentasiLomba');
            const descriptionDokumentasi = document.getElementById('description-dokumentasiLomba');

            // Tambahkan event listener untuk memantau perubahan pada input file
            fileDokumentasi.addEventListener('change', function () {
                const file = this.files[0];

                if (fileDokumentasi.files.length > 0) {
                    if (file.size > 2 * 1024 * 1024) {
                        this.value = ""; // Reset input file
                        descriptionDokumentasi.innerHTML = 'Ukuran file lebih dari 2MB';
                    } else {
                        descriptionDokumentasi.innerHTML = file.name; // menampilkan nama file
                    }
                } else {
                    // Jika tidak ada file, kembalikan teks default
                    descriptionDokumentasi.innerHTML = 'JPG, JPEG atau PNG, ukuran file tidak lebih dari 2MB';
                }
            });
            const fileSuratTugas = document.getElementById('suratTugas');
            const descriptionSuratTugas = document.getElementById('description-suratTugas');

            // Tambahkan event listener untuk memantau perubahan pada input file
            fileSuratTugas.addEventListener('change', function () {
                const file = this.files[0];

                if (fileSuratTugas.files.length > 0) {
                    const file = this.files[0];
                    if (file.size > 2 * 1024 * 1024) {
                        this.value = ""; // Reset input file
                        descriptionSuratTugas.innerHTML = 'Ukuran file lebih dari 2MB';
                    } else {
                        descriptionSuratTugas.innerHTML = file.name; // menampilkan nama file
                    }
                } else {
                    // Jika tidak ada file, kembalikan teks default
                    descriptionSuratTugas.innerHTML = 'JPG, JPEG atau PNG, ukuran file tidak lebih dari 2MB';
                }
            });
        </script>
</body>

</html>