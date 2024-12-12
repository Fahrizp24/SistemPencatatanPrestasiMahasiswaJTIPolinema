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
    <link rel="stylesheet" href="assets/css/berandaAdminStyle.css">
    <script src="assets/js/jquery-3.7.1.js"></script>
    <script src="assets/js/jquery-form.js"></script>
    <link rel="icon" href="assets/img/SPPMicon.png">
</head>

<body>
    <header>
        <div class="logo-container">
            <img src="assets/img/jtiSppmPolinema.png" alt="SPPM POLINEMA Logo" />
        </div>
        <div class="menu-toggle" id="menu-toggle">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </header>
    <div id="sidebar-container"></div>
    <div class="container">
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
                        <th>Aksi</th>
                    </tr>
                    <?php
                    foreach ($antrian as $row) {
                        echo "<tr>";
                        echo "<td>" . $row['nama'] . "</td>";
                        echo "<td>" . $row['role'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['username'] . "</td>";
                        echo "<td>" . $row['prodi'] . "</td>";
                        echo "<td class='action-buttons' id='" . $row['username'] . "'> <a class='btn btn-terima'>Terima</a> <a class='btn btn-tolak'>Tolak</a></td>";
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
    <script>
        document.querySelectorAll('.btn-terima').forEach((btnTerima) => {
            btnTerima.addEventListener('click', () => {
                const usernameAkun = btnTerima.closest('.action-buttons').id;
                if (confirm(`Apakah Anda yakin menerima akun?`)) {
                    // Kirim data menggunakan AJAX
                    $.ajax({
                        url: 'kontrolAkunAdmin/kelolaAkun',
                        method: 'POST',
                        data: {
                            username: usernameAkun,
                            status: 'diterima',
                            action: 'updateAkun'
                        },
                        success: function (response) {
                            try {
                                const result = JSON.parse(response);
                                if (result.status === 'success') {
                                    alert('Akun berhasil diterima');
                                    // Refresh halaman atau hapus baris
                                    location.reload();
                                } else {
                                    alert('Gagal menolak Akun: ' + result.message);
                                }
                            } catch (e) {
                                console.error('Error parsing response:', e);
                                alert('Terjadi kesalahan dalam memproses respon');
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan dalam mengirim data');
                        }
                    });
                }
            });
        });

        // Action untuk tombol Tolak
        document.querySelectorAll('.btn-tolak').forEach((btnTolak) => {
            btnTolak.addEventListener('click', () => {
                const usernameAkun = btnTolak.closest('.action-buttons').id;

                if (confirm(`Apakah Anda yakin menolak akun?`)) {
                    // Kirim data menggunakan AJAX
                    $.ajax({
                        url: 'kontrolAkunAdmin/kelolaAkun',
                        method: 'POST',
                        data: {
                            username: usernameAkun,
                            status: 'ditolak',
                            action: 'updateAkun'
                        },
                        success: function (response) {
                            try {
                                const result = JSON.parse(response);
                                if (result.status === 'success') {
                                    alert('Akun berhasil ditolak dan dihapus');
                                    // Refresh halaman atau hapus baris
                                    location.reload();
                                } else {
                                    alert('Gagal menolak Akun: ' + result.message);
                                }
                            } catch (e) {
                                console.error('Error parsing response:', e);
                                alert('Terjadi kesalahan dalam memproses respon');
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan dalam mengirim data');
                        }
                    });
                }

            });
        });

        const menuToggle = document.getElementById('menu-toggle');
        const sidebarContainer = document.getElementById('sidebar-container');
        fetch('assets/component/sidebarAdmin.html')
            .then(response => response.text())
            .then(html => {
                sidebarContainer.innerHTML = html;
                const sidebar = document.getElementById('sidebar');

                // Menambahkan event listener setelah sidebar dimuat
                menuToggle.addEventListener('click', () => {
                    sidebar.classList.toggle('active');
                });
            })
            .catch(error => console.error('Error loading sidebar:', error));
    </script>
</body>

</html>