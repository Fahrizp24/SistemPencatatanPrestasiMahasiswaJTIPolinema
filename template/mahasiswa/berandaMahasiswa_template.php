<?php
// require_once 'assets/component/check_login.php';
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPPM POLINEMA</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Poppins:wght@300;400;600&display=swap"
        rel="stylesheet">
    <script src="assets/js/jquery-3.7.1.js"></script>
    <script src="assets/js/jquery-form.js"></script>
    <link rel="stylesheet" href="assets/css/homeStyles.css">
    <link rel="icon" href="assets/img/SPPMicon.png">
</head>

<body>
    <div class="container">
        <?php require_once 'assets/component/header.html' ?>
        <?php require_once 'assets/component/sidebarMahasiswa.html' ?>
        <div class="content">
            <div class="main-content">
                <div class="status">
                    <h2 class="sub-judul">
                        Status Pengajuan
                        <hr class="separator">
                    </h2>
                    <p>Berikut adalah jumlah dokumen pengajuan anda dalam bentuk angka :</p>
                    <div class="status-cards">
                        <div class="status-card red">
                            <div class="status-card-red icon">
                                <img src="assets/img/ditolak.png" alt="ditolak">
                            </div>
                            <div class="status-card-red info">
                                <h3>
                                    <?= $status['ditolak'] ?>
                                </h3>
                                <h5>
                                    DITOLAK
                                </h5>
                            </div>
                        </div>
                        <div class="status-card yellow">
                            <div class="status-card-yellow icon">
                                <img src="assets/img/diproses.png" alt="diproses">
                            </div>
                            <div class="status-card-yellow info">
                                <h3>
                                    <?= $status['diproses'] ?>
                                </h3>
                                <h5>
                                    DIPROSES
                                </h5>
                            </div>
                        </div>
                        <div class="status-card green">
                            <div class="status-card-green icon">
                                <img src="assets/img/diterima.png" alt="diterima">
                            </div>
                            <div class="status-card-green info">
                                <h3>
                                    <?= $status['diterima'] ?>
                                </h3>
                                <h5>
                                    DITERIMA
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="detail">
                    <h2 class="sub-judul">
                        Detail
                        <hr class="separator">
                    </h2>
                    <table>
                        <tr>
                            <th>Tanggal <br>Pengajuan</th>
                            <th>Nama Perlombaan</th>
                            <th>Bidang</th>
                            <th>Dosen Pembimbing</th>
                            <th>Poin</th>
                            <th>Status</th>
                            <th>Detail</th>
                        </tr>
                        <?php
                        foreach ($daftarPrestasi as $row) {
                            if ($row['status'] == 'diterimaAdmin') {
                                $row['status'] = 'diterima';
                            } else if ($row['status'] == 'diterimaDosen') {
                                $row['status'] = 'diproses';
                            } else if ($row['status'] == 'diproses') {
                                $row['status'] = 'diproses';
                            }
                            ?>
                            <tr>
                                <td><?php echo $row['tanggalPengajuan']; ?></td>
                                <td><?php echo $row['namaLomba']; ?></td>
                                <td><?php echo $row['bidang']; ?></td>
                                <td><?php echo $row['nama']; ?></td>
                                <td><?php echo $row['poin']; ?></td>
                                <td>
                                    <span class="status-label <?php echo strtolower($row['status']); ?>">
                                        <?php echo ucwords($row['status']) ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="detailPrestasiMahasiswa?idPrestasi=<?php echo urlencode($row['idPrestasi']); ?>"
                                        class="detail-button">Lihat Detail</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
            <div class="footer">
                ©2024 | SPPM JTI POLINEMA
                <img src="assets/img/LogoPolinema.png" alt="logo POLINEMA" width="20" height="20">
            </div>
        </div>
    </div>
</body>

</html>
<script>

</script>