<?php
require_once 'assets/component/check_login.php';

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        SPPM POLINEMA
    </title>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Poppins:wght@300;400;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="assets/css/PermintaanStyle.css">
    <script src="assets/js/jquery-3.7.1.js"></script>
    <script src="assets/js/permintaan-dosen.js"></script>
    <link rel="icon" href="assets/img/SPPMicon.png">
</head>

<body>
    <div class="container">
        <?php require_once 'assets/component/header.html' ?>
        <?php require_once 'assets/component/sidebarDosen.html' ?>
        <div class="content">
            <div class="main-content">
                <h2>
                    Daftar Permintaan Pengajuan Prestasi
                </h2>
                <hr class="separator">
                <p>
                    Berikut adalah daftar Permintaan Pengajuan Prestasi, setelah anda setujui dokumen akan di teruskan
                    kepada Admin untuk penilaian.
                </p>
                <table>
                    <tr>
                        <th>Tanggal Pengajuan</th>
                        <th>Nama Mahasiswa</th>
                        <th>Nama Perlombaan</th>
                        <th>Bidang</th>
                        <th>Juara</th>
                        <th>Tingkat</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                    <?php
                    foreach ($prestasi as $row) {
                        if ($row['status'] == 'ditolak') {
                            $row['status'] = 'ditolak';
                        } else if ($row['status'] == 'diterimaAdmin') {
                            $row['status'] = 'diterima';
                        } else if ($row['status'] == 'diproses') {
                            $row['status'] = 'diproses';
                        }
                        echo "<tr>";
                        echo "<td>" . date('d-m-Y', strtotime($row['tanggalPengajuan'])) . "</td>";
                        echo "<td>" . $row['nama'] . "</td>";
                        echo "<td>" . $row['namaLomba'] . "</td>";
                        echo "<td>" . $row['bidang'] . "</td>";
                        echo "<td>" . $row['jenis'] . "</td>";
                        echo "<td>" . $row['tingkat'] . "</td>";
                        echo "<td><span class='status status-" . $row['status'] . "'>" . ucwords($row['status']) . "</span></td>";
                        echo "<td style='display:none'>" . $row['sertifikatPath'] . "</td>";
                        echo "<td style='display:none'>" . $row['dokumentasiPath'] . "</td>";
                        echo "<td style='display:none'>" . $row['suratTugasPath'] . "</td>";
                        echo "<td><a href=''><a href='detailPrestasiDosen?idPrestasi=" . urlencode($row['idPrestasi']) .
                            "' class='detail-button'>Proses</a></a></td>";
                        echo "<td style='display:none;'>" . $row['idPrestasi'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
                <div id="modal" class="modal">
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <h2>Detail Prestasi</h2>
                        <hr class="separator">
                        <div id="modal-detail">
                        </div>
                        <div class="alasan-section" id="alasan-section" style="display: none;">
                            <label for="alasan">Masukkan Alasan Dokumen Tidak Sesuai:</label>
                            <textarea id="alasan" name="alasan" rows="4" style="width: 100%;"></textarea>
                        </div>
                        <div class="modal-buttons">
                            <button id="tolak-verifikasi">Tolak Verifikasi</button>
                            <button id="teruskan-admin">Teruskan ke Admin</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer">
                ©2024 | SPPM JTI POLINEMA
                <img src="assets/img/LogoPolinema.png" alt="logo POLINEMA" width="20" height="20">
            </div>
        </div>
    </div>
    </div>
</body>
</html>