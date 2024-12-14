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
})