<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quick Count | Kawal Pilkada Batu Bara</title>
    
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    
    
    <style>
        /* Custom scrollbar for Webkit browsers (Chrome, Safari) */
        .table-responsive::-webkit-scrollbar {
            width: 0px; /* Hide scrollbar */
            background: transparent; /* Optional: make scrollbar area transparent */
        }
        
        /* Custom scrollbar for Firefox */
        .table-responsive {
            scrollbar-width: none; /* Hide scrollbar */ 
            -ms-overflow-style: none;  /* Internet Explorer 10+ */
        }
        #hasilSuaraChart {
            height: 400px;
        }
    </style>
</head>
<body>
    <div class="bg-primary text-light text-center mb-4">
        <p class="p-3 h4 d-none d-md-block">Hasil Kemenangan Pilkada Batu Bara 2024</p>
        <p class="p-3 h6 d-block d-md-none">Hasil Kemenangan Pilkada Batu Bara 2024</p>
    </div>
    <div class="container-fluid">
        
        <div class="row">
            <div class="col-md-7">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Grafik Hasil Hitung Suara</h6>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <canvas id="hasilSuaraChart"></canvas>
                            </div>
                            <div class="col">
                                <div id="chartLabels" class="chart-labels-container"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Persentase Suara Perkecamatan</h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive" id="table-container" style="max-height: 440px; font-size: 2vh">
                            <table class="table table-bordered table-striped" width="100%" cellspacing="0">
                                <thead class="thead-dark" style="position: sticky; top: 0;">
                                    <tr>
                                        <th>Kecamatan</th>
                                        <th>Darwis</th>
                                        <th>Baharuddin</th>
                                        <th>Zahir</th>
                                    </tr>
                                </thead>
                                
                                <tbody id="vote-table-body">
                                    <tr>
                                        <td>nama kecamatan</td>
                                        <td>%</td>
                                        <td>%</td>
                                        <td>%</td>
                                    </tr>
                                </tbody>
                                
                                <tfoot class="bg-dark text-light" style="position: sticky; bottom: 0;">
                                    <tr id="total-votes">
                                        
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <div class="bg-primary text-light text-center py-3">
        <div class="copyright">
            <span>Copyright Intrn &copy; Darwis Oky 2024</span>
        </div>
    </div>
    
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <!-- Tambahkan Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        let chartInstance; // Variabel global untuk menyimpan instance grafik
        
        async function loadChartData() {
            try {
                // Memanggil endpoint data() melalui AJAX
                const response = await fetch('/api/total-suara'); // Sesuaikan dengan URL endpoint Anda
                const result = await response.json();
                
                // Nama-nama pasangan calon dan suara mereka
                const labels = ['Darwis - Oky', 'Baharuddin - Syafrizal', 'Zahir - Aslam'];
                const dataSuara = [
                result.darwis_oky,
                result.baharuddin_syafrizal,
                result.zahir_aslam
                ];
                
                // Jika grafik sudah ada, hapus terlebih dahulu
                if (chartInstance) {
                    chartInstance.destroy();
                }
                
                // Membuat grafik di canvas #hasilSuaraChart
                const ctx = document.getElementById('hasilSuaraChart').getContext('2d');
                chartInstance = new Chart(ctx, {
                    type: 'pie', // Tipe grafik, bisa diubah ke 'line', 'pie', dll.
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Total Suara',
                            data: dataSuara,
                            backgroundColor: ['#0000FF', '#FFFF00', '#FF0000'], // Warna tiap bar
                            borderColor: '#fff',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        animation: {
                            duration: 1000,
                            easing: 'easeInOutQuad'
                        },
                        tooltips: {
                            backgroundColor: "rgb(255,255,255)",
                            bodyFontColor: "#858796",
                            borderColor: '#dddfeb',
                            borderWidth: 1,
                            xPadding: 15,
                            yPadding: 15,
                            displayColors: false,
                            caretPadding: 10,
                        },
                        legend: {
                            display: false
                        },
                        cutoutPercentage: 0,
                    }
                });
            } catch (error) {
                console.error('Error loading chart data:', error);
            }
        }
        
        // Muat data pertama kali dan update setiap 10 detik
        loadChartData();
        setInterval(loadChartData, 10000);
        
    </script>
    
    <script>
        const backgroundColors = ['#0000FF', '#FFFF00', '#FF0000'];
        
        function updateChartData() {
            $.ajax({
                url: '/api/persentase-paslon',
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    $('#persentase_darwis').text(data.persentaseDarwis + ' %');
                    $('#persentase_baharuddin').text(data.persentaseBaharuddin + ' %');
                    $('#persentase_zahir').text(data.persentaseZahir + ' %');
                    
                    let tfoot = $('#total-votes');
                    
                    tfoot.empty();
                    tfoot.append(`
                    <td>Total</td>
                    <td>${data.persentaseDarwis}%</td>
                    <td>${data.persentaseBaharuddin}%</td>
                    <td>${data.persentaseZahir}%</td>
                    `);
                    
                    const persentase = [
                    data.persentaseDarwis,
                    data.persentaseBaharuddin,
                    data.persentaseZahir,
                    ];
                    
                    updateLabels(persentase);
                }
            });
            
            function updateLabels(persentase) {
                let labelsHTML = '';
                
                const candidateNames = ['Darwis - Oky', 'Baharuddin - Syafrizal', 'Zahir - Aslam'];
                
                candidateNames.forEach((name, index) => {
                    labelsHTML += `
                    <div class="label-item mt-2">
                        <i class="fas fa-square pr-1" style="color: ${backgroundColors[index % backgroundColors.length]};"></i> 
                        ${name} : ${persentase[index]}%
                    </div>
                    `;
                });
                $('#chartLabels').html(labelsHTML);
            }
            
            $.ajax({
                url: '/api/persentase-per-kecamatan',
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    let tbody = $('#vote-table-body');
                    
                    // Kosongkan tabel terlebih dahulu
                    tbody.empty();
                    
                    // Loop data untuk mengisi tabel
                    $.each(data, function (kecamatan, nilai) {
                        // Buat array untuk persentase
                        const percentages = [
                        nilai.persentase_darwis,
                        nilai.persentase_baharuddin,
                        nilai.persentase_zahir
                        ];
                        
                        // Temukan persentase tertinggi, abaikan jika semuanya 0
                        const maxValue = percentages.every(value => value === 0) ? null : Math.max(...percentages);
                        
                        // Tambahkan baris ke tabel
                        tbody.append(`
                        <tr>
                            <td>${kecamatan}</td>
                            <td class="${nilai.persentase_darwis === maxValue ? 'bg-success text-white' : ''}">
                                ${nilai.persentase_darwis.toFixed(2)}%
                            </td>
                            <td class="${nilai.persentase_baharuddin === maxValue ? 'bg-success text-white' : ''}">
                                ${nilai.persentase_baharuddin.toFixed(2)}%
                            </td>
                            <td class="${nilai.persentase_zahir === maxValue ? 'bg-success text-white' : ''}">
                                ${nilai.persentase_zahir.toFixed(2)}%
                            </td>
                        </tr>
                        `);
                    });
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });
        }
        
        updateChartData();
        setInterval(updateChartData, 10000);
    </script>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tableContainer = document.getElementById('table-container');
            let scrollAmount = 1; // Kecepatan scroll
            let scrollInterval = 20; // Interval scroll dalam ms
            
            function scrollTable() {
                if (!tableContainer) return;
                
                // Jika sudah sampai bawah, ubah arah scroll menjadi ke atas
                if (tableContainer.scrollTop + tableContainer.clientHeight >= tableContainer.scrollHeight) {
                    scrollAmount = -1;
                }
                
                // Jika sudah sampai atas, ubah arah scroll menjadi ke bawah
                if (tableContainer.scrollTop <= 0) {
                    scrollAmount = 1;
                }
                
                // Lakukan scroll
                tableContainer.scrollTop += scrollAmount;
            }
            
            // Jalankan fungsi scrollTable setiap interval yang telah ditentukan
            setInterval(scrollTable, scrollInterval);
        });
    </script>
    
    <script>
        function updateTime() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const currentTime = `${hours}:${minutes}:${seconds}`;
            document.getElementById('jam').textContent = currentTime;
        }
        
        // Perbarui jam setiap detik
        setInterval(updateTime, 1000);
        // Panggil sekali untuk menampilkan jam segera
        updateTime();
    </script>
</body>
</html>

