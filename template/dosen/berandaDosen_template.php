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
    <script src="assets/js/jquery-form.js"></script>
    <link rel="icon" href="assets/img/SPPMicon.png">
</head>

<body>
    <div class="container">
        <?php require_once 'assets/component/header.html' ?>
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
                        } else if ($row['status'] == 'diterimaAdmin') {
                            $row['status'] = 'diterima';
                        } ?>
                        <tr>
                            <td> 
                                <?= date('d-m-Y', strtotime($row['tanggalPengajuan']))?>
                            </td>
                            <td> <?= $row['nama']?></td>
                            <td> <?= $row['namaLomba']?></td>
                            <td> <?= $row['bidang']?></td>
                            <td> <?= $row['jenis']?></td>
                            <td> <?= $row['tingkat']?></td>
                            <td> <span class="status status-<?=$row['status']?>"> <?=ucwords($row['status'])?> </span></td>
                            <td> <a href=''><a href="riwayatPrestasiDosen?idPrestasi=<?=urlencode($row['idPrestasi'])?>" class="detail-button">Lihat</a></a></td>
                        </tr>
                    <?php }?>
                </table>
            </div>
            <div class="footer">
                ©2024 | SPPM JTI POLINEMA
                <img src="assets/img/LogoPolinema.png" alt="logo POLINEMA" width="20" height="20">
            </div>
        </div>
    </div>
</body>

</html>