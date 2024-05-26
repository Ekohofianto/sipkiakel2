@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Dashboard') }}</h1>

    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <!-- Start Card -->

    <div class="row">

        <!-- Data Ibu -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('ibu') }}" class="card border-bottom-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Data (Ibu)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $widget['total_ibu'] }}</div>
                            <!-- Mengakses total data ibu dari array data_ibu -->
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-person-breastfeeding fa-3x text-success"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>


        <!-- Pemeriksaan Ibu -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('p_ibu') }}" class="card border-bottom-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pemeriksaan (Ibu)</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $widget['total_p_ibu'] }}
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 10%"
                                            aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-hospital-user fa-3x text-warning"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Data Balita -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('balita') }}" class="card border-bottom-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Data (Balita)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $widget['total_balita'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-children fa-3x text-danger"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>


        <!-- Pemeriksaan Balita -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('p_balita') }}" class="card border-bottom-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                {{ __('Pemeriksaan (Balita)') }}</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $widget['total_p_balita'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-hands-holding-child fa-3x text-info"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- End Card -->

    <div class="card-body">
        <div class="row">
            <!-- Bagian Grafik -->
            <div class="col-lg-8 mb-4">
                <div class="card border-bottom-primary shadow h-100 py-2">
                    <div class="card-header">
                        Grafik Total Per Bulan
                    </div>
                    <div class="card-body">
                        <canvas id="garfik_e" width="800" height="400"></canvas>
                    </div>
                </div>
            </div>
            <!-- Bagian Illustrasi -->
            <div class="col-lg-4 mb-4">
                <div class="card border-bottom-primary shadow h-100 py-2 shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Semangat Melayani Masyarakat</h6>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 20rem;" src="img/svg/medical.svg"
                                alt="...">
                        </div>
                        <p>Dalam perjalanan menuju kesuksesan, penting untuk mengutamakan kesehatan. Kesehatan yang baik
                            adalah kunci untuk mencapai potensi penuh dan memberikan yang terbaik dalam pekerjaan. Jangan
                            lupakan istirahat yang cukup, makan makanan bergizi, dan tetap aktif secara fisik!</p>
                        <a target="_blank" rel="nofollow"
                            href="https://www.rskariadi.co.id/news/171/Kenapa-Harus-Istirahat-Cukup/Artikel#:~:text=Dengan%20istirahat%20yang%20cukup%20tubuh,memperhatikan%20jalan%20juga%20akan%20menurun.">Jangan
                            Lupa Untuk Istirahat &rarr;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var labels = [];
        var totalIbuData = [];
        var totalBalitaData = [];
        var totalPIbuData = [];
        var totalPBalitaData = [];

        // Buat label untuk 12 bulan
        var monthNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober',
            'November', 'Desember'
        ];
        var currentYear = new Date().getFullYear();

        for (var i = 0; i < 12; i++) {
            labels.push(monthNames[i] + ' ' + currentYear);
            totalIbuData.push(0); // Inisialisasi dengan nilai 0
            totalBalitaData.push(0); // Inisialisasi dengan nilai 0
            totalPIbuData.push(0); // Inisialisasi dengan nilai 0
            totalPBalitaData.push(0); // Inisialisasi dengan nilai 0
        }

        // Isi data berdasarkan bulan
        @foreach ($totalIbuMonthly as $data)
            var monthIndex = new Date("{{ $data->month }}").getMonth();
            totalIbuData[monthIndex] = {{ $data->total_ibu }};
        @endforeach

        @foreach ($totalBalitaMonthly as $data)
            var monthIndex = new Date("{{ $data->month }}").getMonth();
            totalBalitaData[monthIndex] = {{ $data->total_balita }};
        @endforeach

        @foreach ($totalPIbuMonthly as $data)
            var monthIndex = new Date("{{ $data->month }}").getMonth();
            totalPIbuData[monthIndex] = {{ $data->total_p_ibu }};
        @endforeach

        @foreach ($totalPBalitaMonthly as $data)
            var monthIndex = new Date("{{ $data->month }}").getMonth();
            totalPBalitaData[monthIndex] = {{ $data->total_p_balita }};
        @endforeach

        var ctx = document.getElementById('garfik_e').getContext('2d');
        var garfik_e = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels, // Gunakan labels yang sudah diisi
                datasets: [{
                        label: 'Total Ibu',
                        data: totalIbuData,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                    },
                    {
                        label: 'Total Balita',
                        data: totalBalitaData,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                    },
                    {
                        label: 'Total Pemeriksaan Ibu',
                        data: totalPIbuData,
                        backgroundColor: 'rgba(255, 206, 86, 0.2)',
                        borderColor: 'rgba(255, 206, 86, 1)',
                    },
                    {
                        label: 'Total Pemeriksaan Balita',
                        data: totalPBalitaData,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
