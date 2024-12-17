
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
                const pointInput = modal.querySelector("#poin").value;
                const poinKategori = parseInt(modal.querySelector("#poinKategori").value, 10);
                var point = 0;

                //Memberikan poin kategori ke point
                point += poinKategori;

                switch (pointInput) {
                    case 'A':
                        point += 15;
                        break;
                    case 'B':
                        point += 10;
                        break;
                    case 'C':
                        point += 5;
                        break;
                    default:
                        point += 0;
                        break;
                }

                console.log(point)

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