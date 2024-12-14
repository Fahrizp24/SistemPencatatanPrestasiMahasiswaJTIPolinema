$(document).ready(function () {
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
})

function openPickProdi() {
    document.getElementById("label-pick-prodi").style.display = "flex";
    const radio = document.querySelectorAll(".pick-prodi input[type='radio']");
    radio.forEach(element => {
        element.disabled = false;
        const label = document.querySelector(`label[for='${element.id}']`);
        label.style.color = "#000000";
    });
}

function hidePickProdi() {
    const radio = document.querySelectorAll("#pick-prodi input[type='radio']");
    radio.forEach(elements => {
        elements.checked = false;
        elements.disabled = true;
        const label = document.querySelector(`label[for='${elements.id}']`); // Ganti element dengan elements
        label.style.color = "grey";
    });
}

function setProdiPicker() {
    const role = document.getElementById('role').value;

    if (role === "mahasiswa") {
        openPickProdi();
    } else {
        hidePickProdi();
    }
}