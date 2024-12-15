
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
                <h3>Tanggal Final</h3>
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
                <img src="${data[7]}"  alt="Sertifikat">
                </div>
                <div class="modal-section">
                <h3>Foto Dokumentasi</h3>
                <img src="${data[8]}" alt="Dokumentasi">
                </div>
                <div class="modal-section">
                <h3>Foto Surat Tugas</h3>
                <img src="${data[9]}" alt="Surat Tugas">
            </div>
            `;

            // Tampilkan modal
            modal.style.display = "block";
            alasanSection.style.display = "none"; // Sembunyikan kolom alasan
        });
    });

    // Event untuk menutup modal
    closeModal.addEventListener("click", () => {
        location.reload();
    });

    // Tombol "Teruskan ke Admin"
    teruskanButton.addEventListener("click", () => {
        $.ajax({
            url: 'teruskanDosen',
            type: 'POST',
            data: {
                idPrestasi: currentIdPrestasi,
                status: 'diterimaDosen',
                keterangan: ''
            },
            success: function (response) {
                try {
                    const result = JSON.parse(response);
                    if (result.status === 'success') {
                        alert('Prestasi berhasil diterima');
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

    // Tombol "Tolak Verifikasi"
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

    // Menutup modal jika area di luar modal diklik
    window.addEventListener("click", (event) => {
        if (event.target == modal) {
            location.reload();
        }
    });
});