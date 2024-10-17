@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

    <div class="row mb-5">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-success">
                    <h5 class="text-white text-center">JUMLAH SELURUH SISWA</h5>
                </div>
                <div class="card-body">
                    <h3 class="text-center">{{ $siswa }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-warning">
                    <h5 class="text-white text-center">JUMLAH SELURUH PEGAWAI</h5>
                </div>
                <div class="card-body">
                    <h3 class="text-center">{{ $guru }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-info">
                    <h5 class="text-white text-center">JUMLAH MAPEL</h5>
                </div>
                <div class="card-body">
                    <h3 class="text-center">{{ $mapel }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-6 mt-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="text-center">JUMLAH SISWA PER KELAS</h5>
                </div>
                <div class="card-body">
                    <canvas id="siswaPerKelasChart" class="chart-canvas"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6 mt-4">
            <div class="card">
                <div class="card-header bg-warning text-white">
                    <h5 class="text-center">PEGAWAI BERDASARKAN STATUS</h5>
                </div>
                <div class="card-body d-flex justify-content-center align-items-center">
                    <canvas id="pegawaiStatusChart" class="pie-chart-canvas"></canvas>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <!-- Load Chart.js before initializing the chart -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Siswa per Kelas Chart
            var siswaCtx = document.getElementById('siswaPerKelasChart').getContext('2d');
            var siswaPerKelasChart = new Chart(siswaCtx, {
                type: 'bar',
                data: {
                    labels: @json($kelas),
                    datasets: [{
                        label: 'Jumlah Siswa',
                        data: @json($jumlahSiswa),
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Pegawai Status Chart
            var pegawaiCtx = document.getElementById('pegawaiStatusChart').getContext('2d');
            var pegawaiStatusChart = new Chart(pegawaiCtx, {
                type: 'pie',
                data: {
                    labels: @json($statuses),
                    datasets: [{
                        label: 'Jumlah Pegawai',
                        data: @json($jumlahPegawai),
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.label + ': ' + tooltipItem.raw;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
@endpush

@push('style')
    <style>
        .chart-canvas {
            width: 100% !important;
            /* Make canvas full width */
            height: 300px !important;
            /* Adjust height automatically */
        }

        .pie-chart-canvas {
            width: 300px !important;
            /* Set a fixed width for pie chart */
            height: 300px !important;
            /* Set a fixed height for pie chart */
        }
    </style>
@endpush
