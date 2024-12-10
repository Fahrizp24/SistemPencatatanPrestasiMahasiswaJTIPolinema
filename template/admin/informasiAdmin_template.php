<?php require_once 'assets/component/check_login.php';

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <title>
        SPPM POLINEMA
    </title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/informasiAdminStyle.css">
    <script src="assets/js/jquery-3.7.1.js"></script>
    <script src="assets/js/jquery-form.js"></script>
    <link rel="icon" href="assets/image/SPPMicon.png">
</head>

<body>
    <div class="container">
        <?php require_once 'assets/component/header.html' ?>
        <?php require_once 'assets/component/sidebarAdmin.html' ?>
        <div class="content">
            <div class="main-content">
                <h2>
                    Informasi Terkait Poin SPPM
                </h2>
                <hr class="separator">
                <div class="detail">
                    <h4>Kluster A</h4>
                    <p>
                        Kompetisi Nasional atau Internasional yang diselenggarakan oleh Kementrian atau Lembaga selevel.
                        (15
                        Poin)
                        Seperti PIMNAS, GEMASTIK, KMIPN, OLIVIA dll.
                    </p>

                    <h4>Kluster B</h4>
                    <p>
                        Kompetisi Nasional yang diselenggarkaan oleh Institusi atau Universitas minimal selevel
                        Fakultas.
                        (10 Poin)
                        Seperti Compfest UI, ARKAVIDIA IT (STEI ITB), 4C FILKOM UB dll.
                    </p>

                    <h4>Kluster C</h4>
                    <p>
                        Kompetisi Nasional yang diselenggarakan oleh lembaga mahasiswa. (5 Poin)
                        Seperti IT Competition PNB, Hology
                    </p>

                </div>


            </div>
            <div class="footer">
            ©2024 | SPPM JTI POLINEMA
                <img src="assets/view/image/LogoPolinema.png" alt="logo POLINEMA" width="20" height="20">
            </div>
        </div>
    </div>
</body>

</html>