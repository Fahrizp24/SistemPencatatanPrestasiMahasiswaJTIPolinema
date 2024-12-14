$(document).ready(function () {
    const fileSertifikat = document.getElementById('sertifikatLomba');
    const descriptionSertifikat = document.getElementById('description-sertifikatLomba');

    fileSertifikat.addEventListener('change', function () {
        if (fileSertifikat.files.length > 0) {
            const file = this.files[0];
            if (file.size > 2 * 1024 * 1024) {
                this.value = ""; // Reset input file
                descriptionSertifikat.innerHTML = 'Ukuran file lebih dari 2MB';
            } else {
                descriptionSertifikat.innerHTML = file.name; // menampilkan nama file
            }
        } else {
            // Jika tidak ada file, kembalikan teks default
            descriptionSertifikat.innerHTML = 'JPG, JPEG atau PNG, ukuran file tidak lebih dari 2MB';
        }
    });

    const fileDokumentasi = document.getElementById('dokumentasiLomba');
    const descriptionDokumentasi = document.getElementById('description-dokumentasiLomba');

    // Tambahkan event listener untuk memantau perubahan pada input file
    fileDokumentasi.addEventListener('change', function () {
        const file = this.files[0];

        if (fileDokumentasi.files.length > 0) {
            if (file.size > 2 * 1024 * 1024) {
                this.value = ""; // Reset input file
                descriptionDokumentasi.innerHTML = 'Ukuran file lebih dari 2MB';
            } else {
                descriptionDokumentasi.innerHTML = file.name; // menampilkan nama file
            }
        } else {
            // Jika tidak ada file, kembalikan teks default
            descriptionDokumentasi.innerHTML = 'JPG, JPEG atau PNG, ukuran file tidak lebih dari 2MB';
        }
    });
    const fileSuratTugas = document.getElementById('suratTugas');
    const descriptionSuratTugas = document.getElementById('description-suratTugas');

    // Tambahkan event listener untuk memantau perubahan pada input file
    fileSuratTugas.addEventListener('change', function () {
        const file = this.files[0];

        if (fileSuratTugas.files.length > 0) {
            const file = this.files[0];
            if (file.size > 2 * 1024 * 1024) {
                this.value = ""; // Reset input file
                descriptionSuratTugas.innerHTML = 'Ukuran file lebih dari 2MB';
            } else {
                descriptionSuratTugas.innerHTML = file.name; // menampilkan nama file
            }
        } else {
            // Jika tidak ada file, kembalikan teks default
            descriptionSuratTugas.innerHTML = 'JPG, JPEG atau PNG, ukuran file tidak lebih dari 2MB';
        }
    });

    $('#pengajuanForm').submit(function (event) {
        event.preventDefault();
        var formData = new FormData(this); // Ambil data dari form termasuk file

        // Menambahkan data 'action' ke dalam formData
        formData.append('pengajuan', 'pengajuanForm');

        $.ajax({
            url: 'submitPengajuan',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log("Server Response: ", response); // Debug response
                try {
                    var data = JSON.parse(response);  // Pastikan response JSON valid
                    console.log("Parsed Data: ", data);
                    if (data.status === 'success') {
                        document.getElementById("pengajuanForm").reset();
                        $('#status').html(data.message);
                    } else {
                        $('#status').html(data.message);
                    }
                } catch (e) {
                    console.error("Error parsing JSON", e);
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", error);
                alert('Proses Error.');
            }
        });
    });

    $('#nipDosenPembimbing').on('keyup', function () {
        let nip = $(this).val();
        if (nip !== "") {
            $.ajax({
                url: 'getDosen',
                type: 'POST',
                data: { 
                    nip: nip 
                },
                dataType: "json",
                success: function (response) {
                    console.log(response.status);
                    if (response.status === 'success') {
                        $('#namaDosenPembimbing').val(response.data);
                    } else {
                        $('#namaDosenPembimbing').val("Cek Kembali NIP Dosen!");
                    }
                },
                error: function () {
                    $('#namaDosenPembimbing').val("Cek Kembali NIP Dosen!");
                }
            });
        } else {
            $('#namaDosenPembimbing').html("");
        }
    });
})