<?php require_once 'assets/component/check_login.php';

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <title>
        SPPM POLINEMA
    </title>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Poppins:wght@300;400;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="assets/css/berandaAdminStyle.css">
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
                <h2>Pengaturan</h2>
                <hr class="separator">
                <table>
                    <tr>
                        <th>Nama</th>
                        <th>Role</th>
                        <th>Email</th>
                        <th>NIM/NIP</th>
                        <th>Prodi</th>
                    </tr>
                    <?php
                    foreach ($antrian as $row) {
                        echo "<tr>";
                        echo "<td>" . $row['nama'] . "</td>";
                        echo "<td>" . $row['role'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['username'] . "</td>";
                        echo "<td>" . $row['prodi'] . "</td>";
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

</html>