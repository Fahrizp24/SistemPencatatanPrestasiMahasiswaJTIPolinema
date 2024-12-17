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
    <link rel="stylesheet" href="assets/css/pengajuanAdmin.css">
    <script src="assets/js/jquery-3.7.1.js"></script>
    <script src="assets/js/pengajuan-admin.js"></script>

    <link rel="icon" href="assets/img/SPPMicon.png">
</head>

<body>
    <div class="container">
        <?php require_once 'assets/component/header.html' ?>
        <?php require_once 'assets/component/sidebarAdmin.html' ?>
        <div class="content">
            <div class="main-content">
                <h2>Daftar Pengajuan Prestasi</h2>
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
                        <th>Detail</th>
                        <th>Aksi</th>
                        <th>Poin</th>
                    </tr>
                    <?php
                    foreach ($prestasi as $row) { ?>
                        <div id='modal-<?=$row['idPrestasi']?>' class='modal'>
                            <div class='modal-content'>
                                <span class='close'>&times;</span>
                                <h2>Detail Prestasi</h2>
                                <hr class='separator'>
                                <div id='modal-detail'>
                                    <div class='modal-section'>
                                        <p id='<?=$row['idPrestasi']?>' style='display:none;'>
                                        <h3>Nama Lomba</h3>
                                        <p><?=$row['namaLomba']?></p>
                                        <h3>Nama Mahasiswa</h3>
                                        <p><?=$row['mahasiswa']?></p>
                                        <h3>Tanggal Final</h3>
                                        <p><?=date('d-m-Y', strtotime($row['waktu']))?></p>
                                        <h3>Dosen Pembimbing</h3>
                                        <p><?=$row['dosen']?></p>
                                        <h3>Kategori</h3>
                                        <p><?=$row['jenis']?></p>
                                        <h3>Tingkat</h3>
                                        <p><?=$row['tingkat']?></p>
                                        <h3>Bidang</h3>
                                        <p><?=$row['bidang']?></p>
                                    </div>
                                    <div class='modal-section'>
                                        <h3>Foto Sertifikat</h3>
                                        <img src='<?=$row['sertifikatPath']?>' alt='Sertifikat'>
                                    </div>
                                    <div class='modal-section'>
                                        <h3>Foto Dokumentasi</h3>
                                        <img src='<?=$row['dokumentasiPath']?>'' alt='Dokumentasi'>
                                    </div>
                                    <div class='modal-section'>
                                        <h3>Foto Surat Tugas</h3>
                                        <img src='<?=$row['suratTugasPath']?>'' alt='Surat Tugas'>
                                    </div>
                                    <div class='point-form'>
                                        <form id='point-form <?=$row['idPrestasi']?>'>
                                            <h3>Pemberian Poin</h3>
                                            <hr class='separator'>
                                            <p>Baca ketentuan Pemberian Poin pada menu informasi. Pastikan poin yang diinputkan
                                                <span style='color:red'>sesuai dengan ketentuan yang berlaku!</span></p>
                                            <label for='poin'>Beri Poin:</label>                                            
                                            <div class='select-wrapper'>
                                                <select name='poin' id='poin'>
                                                    <option value='A'>Kluster A</option>
                                                    <option value='B'>Kluster B</option>
                                                    <option value='C'>Kluster C</option>
                                                </select>
                                            </div>                           
                                            <input type='number' value='<?=$row['poinKategori']?>' id='poinKategori' name='poinKategori' hidden>
                                            <button type='button' id='submit-point'>Simpan</button>
                                        </form>
                                    </div>
                                    <div id='status' style='color: red;'></div>
                                </div>

                            </div>
                        </div>
                        <tr>
                        <td><?=date('d-m-Y', strtotime($row['waktu']))?></td>
                        <td><?=$row['mahasiswa']?></td>
                        <td><?=$row['namaLomba']?></td>
                        <td><?=$row['bidang']?></td>
                        <td><?=$row['jenis']?></td>
                        <td><?=$row['dosen']?></td>
                        <td><?=$row['tingkat']?></td>
                        <td><button class='proses-btn'>Proses</button></td>
                        <td class='action-buttons' id='<?=$row['idPrestasi']?>'> <a class='btn btn-terima'>Terima</a> <a class='btn btn-tolak'>Tolak</a></td>
                        <td id='poin-<?=$row['idPrestasi']?>'><?=$row['poin']?></td>
                        </tr>
                    <?php }?>
                </table>
            </div>
            <div class="footer">
                @2024 | SPPM JTI POLINEMA
                <img src="assets/img/LogoPolinema.png" alt="logo POLINEMA" width="20" height="20">
            </div>
        </div>
    </div>
</body>

</html>