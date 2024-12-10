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
                    foreach ($prestasi as $row) {
                        echo "<div id='modal-" . $row['idPrestasi'] . "' class='modal'>
                            <div class='modal-content'>
                                <span class='close'>&times;</span>
                                <h2>Detail Prestasi</h2>
                                <hr class='separator'>
                                <div id='modal-detail'>
                                    <div class='modal-section'>
                                        <p id='" . $row['idPrestasi'] . "' style='display:none;'>
                                        <h3>Nama Lomba</h3>
                                        <p>" . $row['namaLomba'] . "</p>
                                        <h3>Nama Mahasiswa</h3>
                                        <p>" . $row['mahasiswa'] . "</p>
                                        <h3>Tanggal Final (dd/MM/YY)</h3>
                                        <p>" . $row['waktu'] . "</p>
                                        <h3>Dosen Pembimbing</h3>
                                        <p>" . $row['dosen'] . "</p>
                                        <h3>Kategori</h3>
                                        <p>" . $row['jenis'] . "</p>
                                        <h3>Tingkat</h3>
                                        <p>" . $row['tingkat'] . "</p>
                                        <h3>Bidang</h3>
                                        <p>" . $row['bidang'] . "</p>
                                    </div>
                                    <div class='modal-section'>
                                        <h3>Foto Sertifikat</h3>
                                        <img src='" . $row['sertifikatPath'] . "' alt='Sertifikat'>
                                    </div>
                                    <div class='modal-section'>
                                        <h3>Foto Dokumentasi</h3>
                                        <img src='" . $row['dokumentasiPath'] . "'' alt='Dokumentasi'>
                                    </div>
                                    <div class='modal-section'>
                                        <h3>Foto Surat Tugas</h3>
                                        <img src='" . $row['suratTugasPath'] . "'' alt='Surat Tugas'>
                                    </div>
                                    <div class='point-form'>
                                        <form id='point-form " . $row['idPrestasi'] . "'>
                                            <h3>Pemberian Poin</h3>
                                            <hr class='separator'>
                                            <p>Baca ketentuan Pemberian Poin pada menu informasi. Pastikan poin yang diinputkan
                                                <span style='color:red'>sesuai dengan ketentuan yang berlaku!</span></p>
                                            <label for='poin'>Beri Poin:</label>
                                            <input type='number' id='poin' name='poin' min='0'>
                                            <button type='button' id='submit-point'>Simpan</button>
                                        </form>
                                    </div>
                                    <div id='status' style='color: red;'></div>
                                </div>

                            </div>
                        </div>";
                        echo "<tr>";
                        echo "<td>" . $row['waktu'] . "</td>";
                        echo "<td>" . $row['mahasiswa'] . "</td>";
                        echo "<td>" . $row['namaLomba'] . "</td>";
                        echo "<td>" . $row['bidang'] . "</td>";
                        echo "<td>" . $row['jenis'] . "</td>";
                        echo "<td>" . $row['dosen'] . "</td>";
                        echo "<td>" . $row['tingkat'] . "</td>";
                        echo "<td><button class='proses-btn'>Proses</button></td>";
                        echo "<td class='action-buttons' id='" . $row['idPrestasi'] . "'> <a class='btn btn-terima'>Terima</a> <a class='btn btn-tolak'>Tolak</a></td>";
                        echo "<td id='poin-" . $row['idPrestasi'] . "'>" . $row['poin'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
            <div class="footer">
                @2024 | SPPM JTI POLINEMA
                <img src="assets/img/LogoPolinema.png" alt="logo POLINEMA" width="20" height="20">
            </div>
        </div>
         //TODO: uppdatePoin
    </div>
    <script> 
        document.addEventListener("DOMContentLoaded", () => {
            // Event untuk membuka modal
            document.querySelectorAll(".proses-btn").forEach((button) => {
                button.addEventListener("click", (event) => {
                    // Temukan baris (tr) terdekat dari tombol yang diklik
                    const row = button.closest('tr');

                    // Ambil ID prestasi dari action buttons dalam baris yang sama
                    const actionButtons = row.querySelector('.action-buttons');
                    const idPrestasi = actionButtons ? actionButtons.id : null;

                    // Tampilkan modal yang sesuai
                    const modal = document.getElementById(`modal-${idPrestasi}`);
                    if (modal) {
                        modal.style.display = "block";
                    }
                });
            });

            // Event untuk menutup modal
            document.querySelectorAll(".close").forEach((closeBtn) => {
                closeBtn.addEventListener("click", () => {
                    const modal = closeBtn.closest(".modal");
                    modal.style.display = "none";
                });
            });

            // Event untuk menyimpan poin
            document.querySelectorAll("#submit-point").forEach((submitBtn) => {
                submitBtn.addEventListener("click", () => {
                    const modal = submitBtn.closest(".modal");
                    const pointInput = modal.querySelector("#poin");
                    const point = parseInt(pointInput.value, 10);

                    // Dapatkan ID prestasi dari ID modal secara langsung
                    const idPrestasi = modal.getAttribute('id').split('-')[1];

                    // Temukan action cell yang sesuai dengan ID prestasi
                    const actionCell = document.getElementById(`poin-${idPrestasi}`);

                    if (actionCell) {
                        // Update status aksi berdasarkan poin
                        actionCell.innerHTML = point > 0
                            ? point
                            : 0;
                    }
                    // Tutup modal
                    modal.style.display = "none";
                });
            });
            // Menutup modal jika area di luar modal diklik
            document.querySelectorAll(".modal").forEach((modal) => {
                modal.addEventListener("click", (event) => {
                    if (event.target === modal) {
                        modal.style.display = "none";
                    }
                });
            });

            // action untuk mengirim query update dengan parameter idPrestasi dan poin bila di klik terima
            // Action untuk tombol Terima
            document.querySelectorAll('.btn-terima').forEach((btnTerima) => {
                btnTerima.addEventListener('click', () => {
                    const idPrestasi = btnTerima.closest('.action-buttons').id;
                    const poinElement = document.getElementById(`poin-${idPrestasi}`);
                    const poin = poinElement ? parseInt(poinElement.textContent) : 0;

                    // Validasi poin
                    if (poin === 0) {
                        // Tampilkan alert khusus untuk poin 0
                        const konfirmasi = alert('Poin prestasi masih 0. Tentukan poin terlebih dahulu untuk menerima prestasi');
                            return; // Batalkan proses jika tidak dikonfirmasi
                    }

                    // Konfirmasi penerimaan prestasi
                    if (confirm(`Apakah Anda yakin menerima prestasi dengan poin ${poin}?`)) {
                        $.ajax({
                            url: 'pengajuanAdmin/kelolaPrestasi',
                            method: 'POST',
                            data: {
                                idPrestasi: idPrestasi,
                                status: 'diterimaAdmin',
                                poin: poin,
                                action: 'updatePoin',
                                keterangan:''
                            },
                            success: function (response) {
                                try {
                                    const result = JSON.parse(response);
                                    if (result.status === 'success') {
                                        alert('Prestasi berhasil diterima');
                                        // Refresh halaman atau hapus baris
                                        location.reload();
                                    } else {
                                        alert('Gagal menerima prestasi: ' + result.message);
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
                    const idPrestasi = btnTolak.closest('.action-buttons').id;

                    // Prompt untuk keterangan penolakan
                    const keterangan = prompt('Berikan alasan penolakan prestasi:');

                    // Cek apakah pengguna mengisi keterangan
                    if (keterangan !== null && keterangan.trim() !== '') {
                        // Konfirmasi sebelum submit
                        if (confirm(`Apakah Anda yakin menolak prestasi dengan alasan:\n"${keterangan}"?`)) {
                            // Kirim data menggunakan AJAX
                            $.ajax({
                                url: 'pengajuanAdmin/kelolaPrestasi',
                                method: 'POST',
                                data: {
                                    idPrestasi: idPrestasi,
                                    status: 'ditolak',
                                    poin: 0,
                                    keterangan: keterangan,
                                    action: 'updatePoin'
                                },
                                success: function (response) {
                                    try {
                                        const result = JSON.parse(response);
                                        if (result.status === 'success') {
                                            alert('Prestasi berhasil ditolak');
                                            // Refresh halaman atau hapus baris
                                            location.reload();
                                        } else {
                                            alert('Gagal menolak prestasi: ' + result.message);
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
                    } else {
                        // Jika keterangan kosong
                        alert('Harap berikan alasan penolakan');
                    }
                });
            });
        });
    </script>
</body>

</html>