<?php require_once 'assets/component/check_login.php';

?>

<!DOCTYPE html>
<html lang="id">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        SPPM POLINEMA
    </title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/PermintaanStyle.css">
    <script src="assets/js/jquery-3.7.1.js"></script>
    <script src="assets/js/jquery-form.js"></script>
    <link rel="icon" href="assets/img/SPPMicon.png">
</head>

<body>
<header>
        <div class="logo-container">
        <img src="assets/img/jtiSppmPolinema.png" alt="SPPM POLINEMA Logo" />
        </div>
        <div class="menu-toggle" id="menu-toggle">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </header>
    <div id="sidebar-container"></div>
    <div class="container">
        <?php require_once 'assets/component/sidebarDosen.html' ?>
        <div class="content">
            <div class="main-content">
                <h2>Daftar Riwayat Pengajuan Prestasi</h2>
                <hr class="separator">
                <p>Berikut adalah daftar Riwayat Prestasi yang anda bimbing.</p>
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
                    foreach ($table as $row) {
                        if ($row['status'] == 'ditolak') {
                            $row['status'] = 'ditolak';
                        } else if ($row['status'] == 'diterimaDosen') {
                            $row['status'] = 'diproses';
                        } else if ($row['status'] == 'diproses') {
                            $row['status'] = 'diproses';
                        }else if ($row['status'] == 'diterimaAdmin') {
                            $row['status'] = 'diterima';
                        }
                        echo "<tr>";
                        echo "<td>" . $row['tanggalPengajuan'] . "</td>";
                        echo "<td>" . $row['nama'] . "</td>";
                        echo "<td>" . $row['namaLomba'] . "</td>";
                        echo "<td>" . $row['bidang'] . "</td>";
                        echo "<td>" . $row['jenis'] . "</td>";
                        echo "<td>" . "Nasional" . "</td>";
                        echo "<td><span class='status status-" .  $row['status'] . "'>" . ucwords($row['status'])  . "</span></td>";
                        echo "<td><a href=''><a href='riwayatPrestasiDosen?idPrestasi=" . urlencode($row['idPrestasi']) . 
                                        "' class='detail-button'>Lihat</a></a></td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
            <div class="footer">
            ©2024 | SPPM JTI POLINEMA
                <img src="assets/img/LogoPolinema.png" alt="logo POLINEMA" width="20" height="20">
            </div>
        </div>
    </div>
</body>
<script>
    const menuToggle = document.getElementById('menu-toggle');
    const sidebarContainer = document.getElementById('sidebar-container');
    fetch('assets/component/sidebarDosen.html')
    .then(response => response.text())
    .then(html => {
        sidebarContainer.innerHTML = html;
        const sidebar = document.getElementById('sidebar');
        
        // Menambahkan event listener setelah sidebar dimuat
        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });
    })
    .catch(error => console.error('Error loading sidebar:', error));
</script>
</html>