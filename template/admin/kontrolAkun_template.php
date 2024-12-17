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
    <link rel="stylesheet" href="assets/css/berandaAdminStyle.css">
    <script src="assets/js/jquery-3.7.1.js"></script>
    <script src="assets/js/kontrol-akun.js"></script>
    <link rel="icon" href="assets/img/SPPMicon.png">
</head>

<body>
    <div class="container">
        <?php require_once 'assets/component/header.html' ?>
        <?php require_once 'assets/component/sidebarAdmin.html' ?>
        <div class="content">
            <div class="main-content">
                <h2>Kontrol Akun</h2>
                <hr class="separator">
                <table>
                    <tr>
                        <th>Nama</th>
                        <th>Role</th>
                        <th>Email</th>
                        <th>NIM/NIP</th>
                        <th>Prodi</th>
                        <th>Aksi</th>
                    </tr>
                    <?php
                    foreach ($antrian as $row) { ?>
                        <tr>
                        <td><?=$row['nama']?></td>
                        <td><?=$row['role']?></td>
                        <td><?=$row['email']?></td>
                        <td><?=$row['username']?></td>
                        <td><?=$row['prodi']?></td>
                        <td class='action-buttons' id='<?=$row['username']?>'> <a class='btn btn-terima'>Terima</a> <a class='btn btn-tolak'>Tolak</a></td>
                        </tr>
                    <?php } ?>
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