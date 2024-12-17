$(document).ready(function () {
    $('.hapusTingkat').submit(function (event) {
        event.preventDefault();
        var id = $(this).find('#idTingkat').val();
        $.ajax({
            url: 'editKategoriAndTingkat',
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
            url: 'editKategoriAndTingkat',
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
            url: 'editKategoriAndTingkat',
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
        var poin = $(this).find('#poin').val();

        $.ajax({
            url: 'editKategoriAndTingkat',
            type: 'POST',
            data: {
                process: 'tambah',
                name: nama,
                poin: poin,
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
});

function toggleMenu(menu) {
    const tingkatLombaButton = document.getElementById('tingkatLombaButton');
    const kategoriLombaButton = document.getElementById('kategoriLombaButton');
    const tingkatLomba = document.querySelector('.tingkat-lomba');
    const kategoriLomba = document.querySelector('.kategori-lomba');
    const addLevel = document.querySelector('.add-level');
    const addLevelForm = document.querySelector('.add-level-form');

    if (menu === 'tingkatLomba') {
        tingkatLombaButton.classList.remove('inactive');
        kategoriLombaButton.classList.add('inactive');
        tingkatLomba.style.display = 'block';
        kategoriLomba.style.display = 'none';


    } else if (menu === 'kategoriLomba') {
        tingkatLombaButton.classList.add('inactive');
        kategoriLombaButton.classList.remove('inactive');
        tingkatLomba.style.display = 'none';
        kategoriLomba.style.display = 'block';

    }
}