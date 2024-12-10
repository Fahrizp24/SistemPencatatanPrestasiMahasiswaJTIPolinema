<?php 
require_once 'assets/component/check_login.php';

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
    <link rel="stylesheet" href="assets/css/PermintaanStyle.css">
    <script src="assets/js/jquery-3.7.1.js"></script>
    <script src="assets/js/jquery-form.js"></script>
    <link rel="icon" href="assets/img/SPPMicon.png">
</head>

<body>
    <div class="container">
        <?php require_once 'assets/component/header.html' ?>
        <?php require_once 'assets/component/sidebarDosen.html' ?>
        <div class="content">
            <div class="main-content">
                <h2>
                    Daftar Permintaan Pengajuan Prestasi
                </h2>
                <hr class="separator">
                <p>
                    Berikut adalah daftar Permintaan Pengajuan Prestasi, setelah anda setujui dokumen akan di teruskan
                    kepada Admin untuk penilaian.
                </p>
                <table>
                    <tr>
                        <th>Tanggal Pengajuan</th>
                        <th>Nama Mahasiswa</th>
                        <th>Nama Perlombaan</th>
                        <th>Bidang</th>
                        <th>Juara</th>
                        <th>Tingkat</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                    <?php
                    foreach ($prestasi as $row) {
                        if ($row['status'] == 'ditolak') {
                            $row['status'] = 'ditolak';
                        } else if ($row['status'] == 'diterimaAdmin') {
                            $row['status'] = 'diterima';
                        } else if ($row['status'] == 'diproses') {
                            $row['status'] = 'diproses';
                        }
                        echo "<tr>";
                        echo "<td>" . $row['tanggalPengajuan'] . "</td>";
                        echo "<td>" . $row['nama'] . "</td>";
                        echo "<td>" . $row['namaLomba'] . "</td>";
                        echo "<td>" . $row['bidang'] . "</td>";
                        echo "<td>" . $row['jenis'] . "</td>";
                        echo "<td>" . $row['tingkat'] . "</td>";
                        echo "<td><span class='status status-" . $row['status'] . "'>" . ucwords($row['status']) . "</span></td>";
                        echo "<td style='display:none'>" . $row['sertifikatPath'] . "</td>";
                        echo "<td style='display:none'>" . $row['dokumentasiPath'] . "</td>";
                        echo "<td style='display:none'>" . $row['suratTugasPath'] . "</td>";
                        echo "<td><a href=''><a href='detailPrestasiDosen.php?idPrestasi=" . urlencode($row['idPrestasi']) .
                            "' class='detail-button'>Proses</a></a></td>";
                        echo "<td style='display:none;'>" . $row['idPrestasi'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
                <div id="modal" class="modal">
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <h2>Detail Prestasi</h2>
                        <hr class="separator">
                        <div id="modal-detail">
                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    const modal = document.getElementById("modal");
                                    const closeModal = document.querySelector(".close");
                                    const alasanSection = document.getElementById("alasan-section");
                                    const tolakButton = document.getElementById("tolak-verifikasi");
                                    const teruskanButton = document.getElementById("teruskan-admin");
                                    let currentIdPrestasi;

                                    // Event untuk membuka modal
                                    document.querySelectorAll(".detail-button").forEach(button => {
                                        button.addEventListener("click", (event) => {
                                            event.preventDefault();
                                            const row = event.target.closest("tr");
                                            const data = Array.from(row.children).map(cell => cell.textContent);
                                            currentIdPrestasi = data[11];
                                            // Isi modal dengan detail data
                                            document.getElementById("modal-detail").innerHTML = `
                                            <div class="modal-section">
                                                <h3>Nama Lomba</h3>
                                                <p>${data[2]}</p>
                                                <h3>Nama Mahasiswa</h3>
                                                <p>${data[1]}</p>
                                                <h3>Tanggal Final (dd/MM/YY)</h3>
                                                <p>${data[0]}</p>
                                                <h3>Dosen Pembimbing</h3>
                                                <p>${data[5]}</p>
                                                <h3>Kategori</h3>
                                                <p>${data[4]}</p>
                                                <h3>Tingkat</h3>
                                                <p>${data[6]}</p>
                                                <h3>Bidang</h3>
                                                <p>${data[3]}</p>
                                            </div>
                                            <div class="modal-section">
                                                <h3>Foto Sertifikat</h3>
                                                <img src="assets/filemedia/sertifikat/${data[7]}"  alt="Sertifikat">
                                                </div>
                                                <div class="modal-section">
                                                <h3>Foto Dokumentasi</h3>
                                                <img src="assets/filemedia/dokumentasi/${data[8]}" alt="Dokumentasi">
                                                </div>
                                                <div class="modal-section">
                                                <h3>Foto Surat Tugas</h3>
                                                <img src="assets/filemedia/suratTugas/${data[9]}" alt="Surat Tugas">
                                            </div>
                                            `;

                                            // Tampilkan modal
                                            modal.style.display = "block";
                                            alasanSection.style.display = "none"; // Sembunyikan kolom alasan
                                        });
                                    });

                                    // Event untuk menutup modal
                                    closeModal.addEventListener("click", () => {
                                        modal.style.display = "none";
                                    });

                                    // Tombol "Tolak Verifikasi"
                                    tolakButton.addEventListener("click", () => {
                                        alasanSection.style.display = "block"; // Tampilkan kolom alasan
                                        teruskanButton.style.display = "none"; // Sembunyikan tombol "Teruskan ke Admin"

                                        tolakButton.textContent = "Kirim Penolakan"; // Ubah teks tombol
                                        tolakButton.addEventListener("click", () => {
                                            const alasan = document.getElementById("alasan").value;
                                            if (alasan.trim() === "") {
                                                alert("Harap masukkan alasan penolakan.");
                                            } else {
                                                alert("Pengajuan telah ditolak dengan alasan: " + alasan);
                                                modal.style.display = "none"; // Tutup modal
                                            }
                                        });
                                    });

                                    // Tombol "Teruskan ke Admin"
                                    teruskanButton.addEventListener("click", () => {
                                        alert("Pengajuan berhasil diteruskan ke Admin.");
                                        modal.style.display = "none"; // Tutup modal
                                    });

                                    // Menutup modal jika area di luar modal diklik
                                    window.addEventListener("click", (event) => {
                                        if (event.target == modal) {
                                            modal.style.display = "none";
                                        }
                                    });


                                    tolakButton.addEventListener("click", () => {
                                        alasanSection.style.display = "block"; // Tampilkan kolom alasan
                                        teruskanButton.style.display = "none"; // Sembunyikan tombol "Teruskan ke Admin"

                                        tolakButton.addEventListener("click", () => {
                                            const alasan = document.getElementById("alasan").value;
                                            if (alasan.trim() === "") {
                                                alert("Harap masukkan alasan penolakan.");
                                            } else {
                                                $.ajax({
                                                    url: 'tolakDosen',
                                                    type: 'POST',
                                                    data: {
                                                        action: 'updateDosen',
                                                        idPrestasi: currentIdPrestasi,
                                                        status: 'ditolak',
                                                        keterangan: alasan
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
                                                    error: function () {
                                                        alert("Terjadi kesalahan saat mengirim data.");
                                                    }
                                                });
                                            }
                                        });
                                    });

                                    teruskanButton.addEventListener("click", () => {
                                        $.ajax({
                                            url: 'teruskanDosen',
                                            type: 'POST',
                                            data: {
                                                action: 'updateDosen',
                                                idPrestasi: currentIdPrestasi,
                                                status: 'diterimaDosen',
                                                keterangan: ''
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
                                            error: function () {
                                                alert("Terjadi kesalahan saat mengirim data.");
                                            }
                                        });
                                    });
                                });
                            </script>

                        </div>
                        <div class="alasan-section" id="alasan-section" style="display: none;">
                            <label for="alasan">Masukkan Alasan Dokumen Tidak Sesuai:</label>
                            <textarea id="alasan" name="alasan" rows="4" style="width: 100%;"></textarea>
                        </div>
                        <div class="modal-buttons">
                            <button id="tolak-verifikasi">Tolak Verifikasi</button>
                            <button id="teruskan-admin">Teruskan ke Admin</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer">
                ©2024 | SPPM JTI POLINEMA
                <img src="assets/img/LogoPolinema.png" alt="logo POLINEMA" width="20" height="20">
            </div>
        </div>
    </div>
    </div>
</body>

</html>

