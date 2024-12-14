<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Akun</title>
    <link rel="stylesheet" href="assets/css/registerStyle.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="assets/img/SPPMicon.png">
    <script src="assets/js/jquery-3.7.1.js"></script>
    <script src="assets/js/register.js"></script>
</head>

<body>
    <header>
        <img src="assets/img/logoSPPM.png" alt="SPPM logo">
        <div class="login"></div>
    </header>
    <main>
        <div class="container">
            <form class="register" id="registerForm">
                <div>
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" placeholder=" Masukkan nama lengkap anda" required>
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder=" Masukkan password" required>
                </div>
                <div>
                    <label for="username">NIM/NIP</label>
                    <input type="text" name="username" id="username"
                        placeholder=" Masukkan NIM/NIP yang sudah terdaftar" required>
                </div>
                <div>
                    <label for="role">Role</label>
                    <select name="role" id="role" onchange="setProdiPicker()">
                        <option value="mahasiswa">Mahasiswa</option>
                        <option value="dosen">Dosen</option>
                    </select>
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder=" Masukkan email anda" required>
                </div>
                <div>
                    <label for="pick-prodi" id="label-pick-prodi">Pilih Prodi</label>
                    <div>
                        <div class="pick-prodi" id="pick-prodi">
                            <input type="radio" id="prodi-sib" name="prodi" value="Sistem Informasi Bisnis">
                            <label for="prodi-sib">Sistem Informasi Bisnis</label>
                        </div>
                        <div class="pick-prodi" id="pick-prodi">
                            <input type="radio" id="prodi-ti" name="prodi" value="Teknik Informatika">
                            <label for="prodi-ti">Teknik Informatika</label>
                        </div>
                    </div>
                </div>
                <div>
                    <input type="button" value="Kembali ke halaman Login" onclick="location.href='login'">
                </div>
                <div>
                    <input type="submit" value="Daftar">
                </div>
                <span style="text-align:center" width="100%">
                    <p style="color:red" id="status"></p>
                </span>
            </form>
        </div>
    </main>
    <?php require_once 'assets/component/footer.html' ?>
</body>
</html>