$(document).ready(function () {
    // Mengakses elemen pertama dari array jumlahPrestasi karena nilai yang didapat dari json_encode adalah sebuah array
    const teknikInformatika = jumlahPrestasi[0].TeknikInformatika;
    const sistemInformasiBisnis = jumlahPrestasi[0].SistemInformasiBisnis;

    const th1 = tahunAjaran[0].th1;
    const th2 = tahunAjaran[0].th2;

    getPieChart(
        ['Teknik Informatika', 'Sistem Informasi Bisnis'],
        [teknikInformatika, sistemInformasiBisnis],
        'pieChart'
    );

    getPieChart(
        ['T.A. 2023/2024', 'T.A. 2024/2025'],
        [th1, th2],
        'pieChartTahunAjaran'
    );
})

function getPieChart(labels, data, id) {
    const ctx = document.getElementById(id).getContext('2d');
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
            responsive:true,
            maintainAspectRatio:false,
            plugins: {
                legend: {
                    position: 'right', // Posisi legend
                }
            }
        }
    });
}
