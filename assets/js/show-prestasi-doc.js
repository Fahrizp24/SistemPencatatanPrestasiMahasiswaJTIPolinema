$(document).ready(function () {
    // Array untuk menyimpan modal dan tombol
    var modals = [
        { modal: document.getElementById("sertifikat-modal"), btn: document.getElementById("sertifikatPath") },
        { modal: document.getElementById("dokumentasi-modal"), btn: document.getElementById("dokumentasiPath") },
        { modal: document.getElementById("suratTugas-modal"), btn: document.getElementById("suratTugasPath") }
    ];

    // Fungsi untuk membuka modal
    modals.forEach(function (item) {
        item.btn.onclick = function () {
            item.modal.style.display = "block";
        };
    });

    // Fungsi untuk menutup modal
    function closeModal(modal) {
        modal.style.display = "none";
    }

    // Menambahkan event listener untuk tombol close
    var closeButtons = document.getElementsByClassName("close");
    Array.from(closeButtons).forEach(function (closeBtn, index) {
        closeBtn.onclick = function () {
            closeModal(modals[index].modal);
        };
    });

    // Menutup modal jika pengguna mengklik di luar modal
    window.onclick = function (event) {
        modals.forEach(function (item) {
            if (event.target == item.modal) {
                closeModal(item.modal);
            }
        });
    };
})