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

function getPieChart(labels, data) {
    const ctx = document.getElementById('pieChart').getContext('2d');
    const pieChart = new Chart(ctx, {
        type: 'pie', // Jenis grafik
        data: {
            labels: labels, // Label pie chart
            datasets: [{
                data: data, // Data persentase untuk setiap label
                backgroundColor: ['#0d3b66', '#ffcc00'], // Warna pie chart
                borderColor: ['#FFFFFF', '#FFFFFF'], // Warna border
                borderWidth: 2 // Lebar border
            }]
        },
        options: {
            plugins: {
                legend: {
                    position: 'right', // Posisi legend
                }
            }
        }
    });
}
