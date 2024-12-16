$(document).ready(function () {
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

    // $('#submit-point').submit(function (event) {
    //     event.preventDefault();
    //     var idPrestasi = $('#idPrestasi').val();
    //     var poin = $('#poin').val();
    //     $('#')
    //     $.ajax({
    //         url: '../controller/process-form',
    //         type: 'POST',
    //         data: {
    //             action: 'updatePoinAdmin', // Parameter untuk menentukan fungsi yang dipanggil
    //             idPrestasi: idPrestasi,
    //             poin: poin,
    //         },
    //         success: function (response) {
    //             var data = JSON.parse(response);
    //             if (data.status === 'success') {
    //                 window.location.href = '../view/index'; // window refresh
    //             } else {
    //                 $('#status').html(data.message);
    //             }
    //         },
    //         error: function () {
    //             console.error(error);
    //             alert('Proses Error.');
    //         }
    //     });
    // });

});

