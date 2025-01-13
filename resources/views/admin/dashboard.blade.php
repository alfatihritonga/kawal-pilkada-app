@extends('layouts.admin.app')

@section('title', 'Admin | Dashboard')

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
    #myPieChart {
        height: 400px;
    }
</style>

@section('content')
<h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
<p class="mb-4 text-gray-500">Halaman Untuk Melihat Dashboard</p>

<div class="row">
    <div class="col">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daerah Pemilihan</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6 mb-3">
                        <div class="card bg-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="h5 mb-0 font-weight-bold text-white">KABUPATEN <br> BATU BARA</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-map fa-2x text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body position-relative">
                                <a href="{{ route('kecamatan.index') }}" class="stretched-link"></a>
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Kecamatan</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="jlh_kecamatan">0</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-database fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 mb-3">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body position-relative">
                                <a href="{{ route('kelurahan-desa.index') }}" class="stretched-link"></a>
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Kelurahan / Desa</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="jlh_kelurahan_desa">0</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-database fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body position-relative">
                                <a href="{{ route('tps.index') }}" class="stretched-link"></a>
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">TPS</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="jlh_tps">0</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-database fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Persentase Suara Paslon</h6>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <td>Paslon</td>
                            <td>%</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Darwis - Oky</td>
                            <td id="persentase_darwis">%</td>
                        </tr>
                        <tr>
                            <td>Baharuddin - Syafrizal</td>
                            <td id="persentase_baharuddin">%</td>
                        </tr>
                        <tr>
                            <td>Zahir - Aslam</td>
                            <td id="persentase_zahir">%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Grafik Hasil Hitung Suara</h6>
            </div>
            <div class="card-body">
                <canvas id="hasilSuaraChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Persentase Suara Perkecamatan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive" id="table-container" style="max-height: 470px;">
                    <table class="table table-bordered table-striped" width="100%" cellspacing="0">
                        <thead class="thead-dark" style="position: sticky; top: 0;">
                            <tr>
                                <th>Kecamatan</th>
                                <th>Darwis - Oky</th>
                                <th>Baharuddin - Syafrizal</th>
                                <th>Zahir - Aslam</th>
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


@endsection

@section('scripts')
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    $(document).ready(function() {
        // Lakukan request AJAX untuk mengambil data dari endpoint
        $.ajax({
            url: '/api/total-dapil',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                // Ubah isi elemen berdasarkan data yang diterima
                $('#jlh_kecamatan').text(data.jlhKecamatan);
                $('#jlh_kelurahan_desa').text(data.jlhKelurahanDesa);
                $('#jlh_tps').text(data.jlhTps);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching data:', error);
            }
        });
        
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
            }
        });
        
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
                    tbody.append(`
                    <tr>
                        <td>${kecamatan}</td>
                        <td>${nilai.persentase_darwis.toFixed(2)}%</td>
                        <td>${nilai.persentase_baharuddin.toFixed(2)}%</td>
                        <td>${nilai.persentase_zahir.toFixed(2)}%</td>
                    </tr>
                    `);
                });
            },
            error: function (xhr, status, error) {
                console.error('Error fetching data:', error);
            }
        });
        
    });
</script>

<script>
    // Fungsi untuk memuat data dan membuat grafik
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
            
            // Membuat grafik di canvas #hasilSuaraChart
            const ctx = document.getElementById('hasilSuaraChart').getContext('2d');
            new Chart(ctx, {
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
    
    // Memanggil fungsi loadChartData setelah halaman selesai dimuat
    document.addEventListener('DOMContentLoaded', loadChartData);
</script>

@endsection
