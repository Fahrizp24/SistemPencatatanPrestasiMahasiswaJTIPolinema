$(document).ready(function () {
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
})