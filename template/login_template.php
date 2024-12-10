<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pencatatan Prestasi Mahasiswa JTI</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="assets/css/loginStyle.css">
    <link rel="icon" href="assets/img/SPPMicon.png">
    <script src="assets/js/jquery-3.7.1.js"></script>
    <script src="assets/js/jquery-form.js"></script>
</head>

<body>
    <header>
        <img src="assets/img/logoSPPM.png" alt="SPPM logo">
        <div class="login"></div>
    </header>
    <main class="main-content">
        <div class="login-form">
            <h2>MASUK</h2>
            <hr class="separator">
            <form id="login" method="POST">
                <label for="username">Nama Pengguna</label>
                <input type="text" id="username" placeholder="Masukkan NIM/NIP yang terdaftar">

                <label for="password">Kata Sandi</label>
                <input type="password" id="password" placeholder="Masukkan Password">
                <div class="tombol">
                    <button type="reset">Batal</button>
                    <button type="submit">Masuk</button>
                </div>
                <div>
                    <p id="status" style="color:red"></p>
                </div>

                <p>Belum punya akun? <a href="register.php">daftar disini</a></p>

            </form>
        </div>
    </main>
    <?php require_once 'assets/component/footer.html' ?>
</body>

</html>