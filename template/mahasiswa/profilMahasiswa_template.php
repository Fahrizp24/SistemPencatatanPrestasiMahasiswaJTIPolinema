<?php
// require_once '../component/check_login.php';

?>

<html>

<head>
    <title>
        SPPM POLINEMA
    </title>
    <script src="assets/js/jquery-3.7.1.js"></script>
    <script src="assets/js/jquery-form.js"></script>
    <link rel="stylesheet" href="assets/css/profileStyle.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="icon" href="assets/img/SPPMicon.png">
</head>

<body>
    <div class="container">
        <?php require_once 'assets/component/header.html' ?>
        <?php require_once 'assets/component/sidebarMahasiswa.html' ?>
        <div class="content">
            <div class="main-content">
                <h2 class="sub-judul">Profil Mahasiswa
                    <hr class="separator">
                </h2>
                <button class="edit-profile-btn" id="editProfileBtn">Edit Profil</button>
                <div class="profile-card-bg">
                    <div class="profile-card">
                        <div class="info">
                            <h2><?php echo $profile[0]['nama'] ?></h2>
                            <p><?php echo $profile[0]['nim'] ?></p>
                            <p><?php echo $profile[0]['email'] ?></p>
                            <p>
                                D-IV <span style="color: #ff7f00;"><?php echo $profile[0]['namaProdi'] ?></span>
                            </p>
                            <p>Jurusan Teknologi Informasi</p>
                        </div>
                        <img alt="Profile Picture" src="<?=$foto?>?>" />
                    </div>
                </div>
            </div>
            <div class="footer">
                ©2024 | SPPM JTI POLINEMA
                <img src="assets/img/LogoPolinema.png" alt="logo POLINEMA" width="20" height="20">
            </div>
        </div>
    </div>
</body>


<div id="editProfileModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Edit Profil</h2>
        <hr class="separator">
        <form class="form-group" id="updateProfilForm">
            <div class="profile-pic-container">
                <img id="previewImage" src="<?=$foto?>" alt="Preview Gambar" class="profile-pic">
                <div class="edit-overlay">
                    <span class="edit-icon">✎</span>
                </div>
            </div>
            <input type="file" id="profilePicture" name="profilePicture" accept="image/*" style="display: none;">
            <label for="name">
                Nama:
            </label><br>
            <input type="text" id="nama" name="nama" value="<?php echo $profile[0]['nama'] ?>"><br><br>
            <label for="nim">
                NIM:
            </label><br>
            <input disabled="" type="text" id="username" name="username" value="<?php echo $profile[0]['nim'] ?>"><br><br>
            <label for="email">
                Email:
            </label><br>
            <input type="email" id="email" name="email" value="<?php echo $profile[0]['email'] ?>"><br><br>
            <label for="prodi">
                Program Studi:
            </label><br>
            <input disabled="" type="text" id="prodi" name="prodi" value="<?php echo $profile[0]['namaProdi'] ?>"><br><br>
            <input type="text" name="role" id="role" value="Mahasiswa" hidden>
            <button class="btn" type="submit">Simpan</button>
        </form>
    </div>
</div>
<script src="assets/js/profil.js"></script>

</html>
