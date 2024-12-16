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
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Poppins:wght@300;400;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="assets/css/pengaturan.css">
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
                <div class="form-group">
                    <div>
                        <button id="tingkatLombaButton" onclick="toggleMenu('tingkatLomba')">Tingkat Lomba</button>
                    </div>
                    <div>
                        <button id="kategoriLombaButton" class="inactive" onclick="toggleMenu('kategoriLomba')">Kategori
                            Lomba</button>
                    </div>
                </div>
                <div class="tingkat-lomba">
                    <div class="existing-levels">
                        <h2>Tingkat yang Sudah Ada</h2>
                        <hr class="separator">

                        <div class="level-buttons">
                            <?php
                            foreach ($tingkat as $row) { ?>
                                <div class="level-item">
                                    <?= $row['namaTingkat'] ?>
                                    <form class="hapusTingkat">
                                        <input type="text" id="idTingkat" value="<?= $row['idTingkat'] ?>" hidden>
                                        <button type="submit">x</button>
                                    </form>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="add-level">+ Tambah Tingkat</div>
                    <form id="tambahTingkat">
                        <div class="add-level-form">
                            <input type="text" name="nama" id="nama" placeholder="Masukkan nama tingkat baru" required>
                        </div>
                        <div class="action-buttons-tingkat">
                            <button type="reset" class="cancel-button">Batal</button>
                            <button type="submit" name="submit">Tambah</button>
                        </div>
                    </form>
                </div>
                <div class="kategori-lomba">
                    <div class="existing-category">
                        <h2>Kategori yang Sudah Ada</h2>
                        <hr class="separator">

                        <div class="category-buttons">
                            <?php
                            foreach ($kategori as $row) { ?>
                                <div class="category-item">
                                    <?= $row['namaKategori'] ?>
                                    <form class="hapusKategori">
                                        <input type="text" id="idKategori" value="<?= $row['idKategori'] ?>" hidden>
                                        <button type="submit">x</button>
                                    </form>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="add-category">+ Tambah kategori</div>
                    <form id="tambahKategori">
                        <div class="add-category-form">
                            <input type="text" name="nama" id="nama" placeholder="Masukkan nama kategori baru" required>
                            <input type="number" name="poin" id="poin" placeholder="Masukkan poin kategori" required>
                        </div>
                        <div class="action-buttons-category">
                            <button type="reset" class="cancel-button">Batal</button>
                            <button type="submit" name="submit">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="footer">
                ©2024 | SPPM JTI POLINEMA
                <img src="assets/img/LogoPolinema.png" alt="logo POLINEMA" width="20" height="20">
            </div>
        </div>
    </div>
</body>
<script>
    function toggleMenu(menu) {
        const tingkatLombaButton = document.getElementById('tingkatLombaButton');
        const kategoriLombaButton = document.getElementById('kategoriLombaButton');
        const tingkatLomba = document.querySelector('.tingkat-lomba');
        const kategoriLomba = document.querySelector('.kategori-lomba');
        const addLevel = document.querySelector('.add-level');
        const addLevelForm = document.querySelector('.add-level-form');

        if (menu === 'tingkatLomba') {
            tingkatLombaButton.classList.remove('inactive');
            kategoriLombaButton.classList.add('inactive');
            tingkatLomba.style.display = 'block';
            kategoriLomba.style.display = 'none';


        } else if (menu === 'kategoriLomba') {
            tingkatLombaButton.classList.add('inactive');
            kategoriLombaButton.classList.remove('inactive');
            tingkatLomba.style.display = 'none';
            kategoriLomba.style.display = 'block';

        }
    }
</script>

</html>