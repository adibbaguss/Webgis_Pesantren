@extends('layouts.app')

@section('content')
<div class="containter-fluid mt-5 pt-5">
    <h2 class="mb-4 text-secondary ">{{ 'Data Statistik Pondok Pesantren' }}</h2>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm mb-4"  style="user-select: none;">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <h6 class="m-0 fw-bold text-success">{{ 'Pertumbuhan Pondok Pesantren' }}</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas class="w-100" id="chartPonpes"></canvas>
                    </div>
                </div>
                <div class="card-footer bg-light">
                    <small class="text-secondary">Diagram jumlah penambahan Pondok Pesantren 10 tahun terakhir berdasarkan tahun berdiri Pondok Pesantren</small>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4 " style="user-select: none;">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3">
                <h6 class="m-0 fw-bold text-success">{{ 'Pemetaan Pondok Pesantren' }}</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area ">
                    <div class="border-3" id="map"></div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm mb-4"  style="user-select: none;">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <h6 class="m-0 fw-bold text-success">{{ 'Jumlah Pondok Pesantren' }}</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas class="w-100" id="chartJumlahPonpes"></canvas>
                    </div>
                </div>
                <div class="card-footer bg-light">
                    <small class="text-secondary">Diagram jumlah kategori/jenis Pondok Pesantren berdasarkan kecamatan</small>
                </div>
            </div>
        </div>



        <div class="col-md-6">
            <div class="card shadow-sm mb-4"  style="user-select: none;">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <h6 class="m-0 fw-bold text-success">{{ 'Jumlah Santri di Kabupaten Batang' }}</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas class="w-100" id="chartStudent"></canvas>
                    </div>
                </div>
                <div class="card-footer bg-light">
                    <small class="text-secondary">Diagram jumlah santri di Kabupaten Batang 10 tahun terakhir berdasarkan data inputan dari  Pondok Pesantren</small>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection


@push('javascript')
<script>
    // Mendapatkan data chart dari controller
    var ChartDataPonpes = @json($ChartDataPonpes);

    // Membuat chart menggunakan Chart.js
    var ctx = document.getElementById('chartPonpes').getContext('2d');
    var DataPonpesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ChartDataPonpes.labels,
            datasets: [{
                    label: 'Total Per-Tahun',
                    data: ChartDataPonpes.total_count,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Penambahan Per-Tahun',
                    data: ChartDataPonpes.count,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    min: 0,

                    ticks: {
                        // forces step size to be 50 units
                        stepSize: 1
                    }
                },
            }
        }
    });
</script>


<script>
    // Mendapatkan data chart dari controller
    var ChartDataJumlahPonpes = @json($ChartDataJumlahPonpes);

    // Membuat chart menggunakan Chart.js
    var ctx = document.getElementById('chartJumlahPonpes').getContext('2d');
    var JumlahPonpesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ChartDataJumlahPonpes.labels,
            datasets: [{
                    label: 'Salafiyah',
                    data: ChartDataJumlahPonpes.salafiyah,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)', 
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Khalafiyah',
                    data: ChartDataJumlahPonpes.khalafiyah,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)', 
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Kombinasi',
                    data: ChartDataJumlahPonpes.kombinasi,
                    backgroundColor: 'rgba(255, 205, 86, 0.2)',
                    borderColor: 'rgba(255, 205, 86, 1)',  
                    borderWidth: 1
                },
                {
                    label: 'Total',
                    data: ChartDataJumlahPonpes.total,
                    backgroundColor: 'rgba(48, 255, 145, 0.2)', 
                    borderColor: 'rgba(48, 255, 145, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    min: 0,
                    ticks: {
                        // forces step size to be 50 units
                        stepSize: 1
                    }
                },
            }
        }
    });
</script>


<script>
    // Fetch your chart data from Laravel
    var chartData = @json($ChartDataStudent);

    // Get the canvas element
    var ctx = document.getElementById('chartStudent').getContext('2d');

    // Create the chart
    var studentChart = new Chart(ctx, {
        type: 'bar', // You can choose other types such as line, pie, etc.
        data: {
            labels: chartData.labels,
            datasets: [
                {
                    label: 'Santri Mukim',
                    data: chartData.male_resident_count,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)', 
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Santriwati Mukim',
                    data: chartData.female_resident_count,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)', 
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Santri Tidak Mukim',
                    data: chartData.male_non_resident_count,
                    backgroundColor: 'rgba(255, 205, 86, 0.2)',
                    borderColor: 'rgba(255, 205, 86, 1)',  
                    borderWidth: 1
                },
                {
                    label: 'Santriwati Tidak Mukim',
                    data: chartData.female_non_resident_count,
                    backgroundColor: 'rgba(48, 255, 145, 0.2)', 
                    borderColor: 'rgba(48, 255, 145, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Total',
                    data: chartData.total,
                    backgroundColor: 'rgba(0, 62, 128, 0.2)', 
                    borderColor: 'rgba(0, 62, 128, 1)',
                    borderWidth: 1
                },
            ],
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    min: 0,
                    ticks: {
                        // forces step size to be 50 units
                        stepSize: 1
                    }
                },
            }
        }
    });
</script>

    
@endpush