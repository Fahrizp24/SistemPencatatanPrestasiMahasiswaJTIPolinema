$(document).ready(function () {
    $('#login').submit(function (event) {
        event.preventDefault();
        var username = $('#username').val();
        var password = $('#password').val();

        $.ajax({
            url: 'LoginController',
            type: 'POST',
            data: {
                login: 'login',
                username: username,
                password: password
            },
            success: function (response) {
                var data = JSON.parse(response);
                if (data.status === 'success') {
                    if (data.role === 'mahasiswa') {
                        window.location.href = 'berandaMahasiswa';
                    } else if (data.role === 'admin') {
                        window.location.href = 'berandaAdmin'
                    } else {
                        window.location.href = 'berandaDosen'
                    }
                } else {
                    $('#status').html(data.message);
                }
            },
            error: function () {
                console.error(error);
                alert('Proses Error.');
            }
        });
    });

    $('#registerForm').submit(function (event) {
        event.preventDefault();
        var username = $('#username').val();
        var password = $('#password').val();
        var role = $('#role').val();

        var nama = $('#nama').val();
        var notelp = $('#notelp').val();
        var prodi = '';
        if (role === 'mahasiswa') {
            prodi = $('input[name="prodi"]:checked').val();   
        }
        var email = $('#email').val();

        $.ajax({
            url: 'registerAkun',
            type: 'POST',
            data: {
                action: 'register', // Parameter untuk menentukan fungsi yang dipanggil
                username: username,
                password: password,
                role: role,

                nama: nama,
                notelp: notelp,
                prodi: prodi,
                email: email
            },
            success: function (response) {
                var data = JSON.parse(response);
                if (data.status === 'success') {
                    window.location.href = 'index'; // Redirect jika register berhasil
                } else {
                    $('#status').html(data.message);
                }
            },
            error: function () {
                console.error(error);
                alert('Proses Error.');
            }
        });
    });

    $('#updateProfilForm').submit(function (event) {
        event.preventDefault();
        var formData = new FormData(this);
        var url = (formData.get('role') == 'Dosen') ? 'updateProfilDsn' :'updateProfilMhs';

        formData.append('updateProfil', 'updateProfil');

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                var data = JSON.parse(response);
                if (data.status === 'success') {
                    window.location.reload();
                } else {
                    $('#status').html(data.message);
                }
            }
        });
    })

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


    $('#logout').click(function () {
        var formData = new FormData();
        formData.append('action', 'logout');
        $.ajax({
            url: 'logout',
            type: 'GET'
        });
        window.location.href = 'index'; e
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
    

    $('.hapusTingkat').submit(function (event) {
        event.preventDefault();
        var id = $(this).find('#idTingkat').val();
        $.ajax({
            url: 'editTingkatAndKategori',
            type: 'POST',
            data: {
                process: 'hapus',
                id: id,
                table: 'tingkat',
                name:''
            },
            success: function (response) {
                var data = JSON.parse(response);
                if (data.status === 'success') {
                    window.location.reload();
                } else {
                    $('#status').html(data.message);
                }
            }
        });

    })

    $('.hapusKategori').submit(function (event) {
        event.preventDefault();
        var id = $(this).find('#idKategori').val();
        $.ajax({
            url: 'editTingkatAndKategori',
            type: 'POST',
            data: {
                process: 'hapus',
                id: id,
                table:'kategori',
                name: ''
            },
            success: function (response) {
                var data = JSON.parse(response);
                if (data.status === 'success') {
                    window.location.reload();
                } else {
                    $('#status').html(data.message);
                }
            }
        });
    })

    $('#tambahTingkat').submit(function (event) {
        event.preventDefault();
        var nama = $(this).find('#nama').val();

        $.ajax({
            url: 'editTingkatAndKategori',
            type: 'POST',
            data: {
                process: 'tambah',
                name: nama,
                table: 'tingkat',
                id : 0
            },
            success: function (response) {
                var data = JSON.parse(response);
                if (data.status === 'success') {
                    window.location.reload();
                } else {
                    $('#status').html(data.message);
                }
            }
        });
    })

    $('#tambahKategori').submit(function (event) {
        event.preventDefault();
        var nama = $(this).find('#nama').val();

        $.ajax({
            url: 'editTingkatAndKategori',
            type: 'POST',
            data: {
                process: 'tambah',
                name: nama,
                table: 'kategori',
                id: 0
            },
            success: function (response) {
                var data = JSON.parse(response);
                if (data.status === 'success') {
                    window.location.reload();
                } else {
                    $('#status').html(data.message);
                }
            }
        });
    })

    //TODO : nih dibawah buat apa yak

    $('#submit-point').submit(function (event) {
        event.preventDefault();
        var idPrestasi = $('#idPrestasi').val();
        var poin = $('#poin').val();
        $('#')
        $.ajax({
            url: '../controller/process-form',
            type: 'POST',
            data: {
                action: 'updatePoinAdmin', // Parameter untuk menentukan fungsi yang dipanggil
                idPrestasi: idPrestasi,
                poin: poin,
            },
            success: function (response) {
                var data = JSON.parse(response);
                if (data.status === 'success') {
                    window.location.href = '../view/index'; // window refresh
                } else {
                    $('#status').html(data.message);
                }
            },
            error: function () {
                console.error(error);
                alert('Proses Error.');
            }
        });
    });

});

