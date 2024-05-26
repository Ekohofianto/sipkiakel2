<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Laravel SB Admin 2">
    <meta name="author" content="Alejandro RH">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS from CDN -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Data Tables CSS from CDN -->
    <link href="https://cdn.datatables.net/v/bs4/dt-2.0.7/r-3.0.2/sc-2.4.2/datatables.min.css" rel="stylesheet">

    <!-- Custom CSS (optional) -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Rubik:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon" type="image/png">

</head>

<body
    style="background-image: url('img/welcome/bgputih2.png'); background-size: cover; background-position: top-center; background-repeat: no-repeat;">
    <header>
        <nav class="navbar navbar-expand-lg topbar static-top bg-gradient-hijau-c1">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('img/sipkia.png') }}"
                        alt="Logo SipKia" width="100"></a>
                <button aria-controls="navbarSupportedContent10" aria-expanded="false" aria-label="Toggle navigation"
                    class="navbar-toggler" data-bs-target="#navbarSupportedContent10" data-bs-toggle="collapse"
                    type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent10">
                    <ul class="navbar-nav ml-auto my-2 my-lg-0">
                        <li class="nav-item d-flex align-items-center me-4">
                            <a class="nav-link text-white" href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="nav-item d-flex align-items-center me-4">
                            <a class="nav-link text-white" href="{{ url('/') }}#About">About</a>
                        </li>
                        <li class="nav-item d-flex align-items-center me-4">
                            <a class="nav-link text-white" href="{{ url('/') }}#Contact">Contact</a>
                        </li>
                        <li class="nav-item d-flex align-items-center me-4">
                            <a class="nav-link text-white" href="{{ url('/') }}#Tutorial">Tutorial</a>
                        </li>
                        <li class="nav-item d-flex align-items-center">
                            <div class="dropdown">
                                <button class="btn btn-outline-primaryn dropdown-toggle" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Masuk
                                </button>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{ route('login') }}">
                                        <i class="fas fa-user fa-sm fa-fw mr-2"></i> Petugas
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ url('/') }}#CekPemeriksaan">
                                        <i class="fa-solid fa-stethoscope fa-sm fa-fw mr-2"></i> Cek Pemeriksaan
                                    </a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="content">
        @yield('content')
    </div>

    <!-- jQuery (pastikan jQuery dimuat pertama) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Bootstrap JS from CDN -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/v/bs4/dt-2.0.7/r-3.0.2/sc-2.4.2/datatables.min.js"></script>

    <!-- Custom JS (optional) -->
    <script src="{{ asset('js/app.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>

    <!-- Chart JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>

    <!-- jQuery Easing -->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- SB Admin 2 JS -->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <!-- SweetAlert script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Ambil elemen dengan id pagecontact
        const pageContact = document.getElementById('pagecontact');
    </script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>

    @yield('scripts')
</body>

</html>
