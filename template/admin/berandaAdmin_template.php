<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPPM POLINEMA</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Poppins:wght@300;400;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="assets/css/berandaAdminStyle.css">
    <script src="assets/js/jquery-3.7.1.js"></script>
    <script src="assets/js/beranda-admin.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="icon" href="assets/img/SPPMicon.png">
</head>

<body>
    <div class="container">
        <?php require_once 'assets/component/header.html' ?>
        <?php require_once 'assets/component/sidebarAdmin.html' ?>
        <div class="content">
            <div class="main-content">
                <h2>Grafik Jumlah Poin Berdasarkan Program Studi</h2>
                <hr class="separator">
                <p> Berikut adalah data poin terverifikasi yang telah dekelompokkan berdasarkan program studi</p>
                <div class="chart-container">
                    <div class="chart">
                        <canvas id="pieChart" width="400" height="400"
                            style="display: block; box-sizing: border-box; height: 400px; width: 444px;"></canvas>
                    </div>
                    <div class="chart">
                        <canvas id="pieChartTahunAjaran" width="400" height="400"
                            style="display: block; box-sizing: border-box; height: 400px; width: 400px;"></canvas>
                    </div>
                </div>
                <h2>Detail</h2>
                <hr class="separator">
                <table>
                    <tr>
                        <th>Tanggal Lomba</th>
                        <th>Nama Mahasiswa</th>
                        <th>Nama Perlombaan</th>
                        <th>Bidang</th>
                        <th>Juara</th>
                        <th>Dosen Pembimbing</th>
                        <th>Tingkat</th>
                        <th>Poin</th>
                        <th>Status</th>
                        <th>Detail</th>
                    </tr>
                    <?php
                    foreach ($prestasi as $row) {
                        if ($row['status'] == 'ditolak') {
                            $row['status'] = 'ditolak';
                        } else if ($row['status'] == 'diterimaAdmin') {
                            $row['status'] = 'diterima';
                        } else if ($row['status'] == 'diterimaDosen') {
                            $row['status'] = 'diproses';
                        } ?>
                        <tr>
                        <td><?=date('d-m-Y', strtotime($row['tanggalPengajuan']))?></td>
                        <td><?=$row['mahasiswa']?></td>
                        <td><?=$row['namaLomba']?></td>
                        <td><?=$row['bidang']?></td>
                        <td><?=$row['jenis']?></td>
                        <td><?=$row['dosen']?></td>
                        <td><?=$row['tingkat']?></td>
                        <td><?=$row['poin']?></td>
                        <td><span class='status status-<?=$row['status']?>'><?=ucwords($row['status'])?></span></td>
                        <td><a href=''><a href='detailPrestasiAdmin?idPrestasi=<?=urlencode($row['idPrestasi'])?>' class='detail-button'>Lihat</a></a></td>";
                        </tr>";
                    <?php } ?>
                </table>
            </div>
            <div class="footer">
                ©2024 | SPPM JTI POLINEMA
                <img src="assets/img/LogoPolinema.png" alt="logo POLINEMA" width="20" height="20">
            </div>
        </div>
    </div>
    <script>
        // Mengambil data dari PHP
        const jumlahPrestasi = <?php echo json_encode($chart); ?>;
        const tahunAjaran = <?php echo json_encode($TAChart); ?>;
    </script>
</body>

</html>