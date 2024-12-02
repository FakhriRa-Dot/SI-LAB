<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SI-LAB - @yield('title')</title>

    <!-- CSS (Urutkan CSS terlebih dahulu) -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    {{-- <link rel="preconnect" href="https://fonts.googleapis.com"> --}}
    {{-- <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> --}}
    {{-- <link href="https://fonts.googleapis.com/css2?family=Arima:wght@100..700&family=Itim&family=Lato:wght@400;700&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=Sour+Gummy:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ asset('vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('js/select.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vertical-layout-light/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('css/sidebarasisten.css') }}">
    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">





    <!-- Style Kustom -->
    @stack('styles')

    <style>
        body {

            font-family: "Sour Gummy", serif;

        }

        #sidebar-wrapper {
            height: 100vh;

            width: 200px;
            position: sticky;

            top: 0;
            left: 0;
            width: 250px;
            background: #f8f9fa;
            overflow-y: auto;
            transition: width 0.3s ease-in-out;
        }

        .sidebar.collapsed {
            width: 80px;
        }

        .sidebar .nav-link {
            display: flex;
            align-items: center;
        }

        .sidebar .nav-link span {
            margin-left: 10px;
            transition: opacity 0.3s ease-in-out;
        }

        .sidebar.collapsed .nav-link span {
            opacity: 0;
            visibility: hidden;
        }

        .sidebar.collapsed .logo img {
            width: 40px;
            height: 40px;
        }

        .sidebar .toggle-btn {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            cursor: pointer;
        }

        .sidebar .logo {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar .logo img {
            width: 50px;
            height: 50px;
        }

        .main-content {
            padding: 20px;
            margin-left: 250px;
            transition: margin-left 0.3s ease-in-out;
        }

        .main-content.collapsed {
            margin-left: 80px;
        }

        .nav-link.active {
            font-weight: bold;
            color: #0d6efd;
        }

        .logout-link {
            margin-top: auto;
        }
    </style>
</head>

<body>

    <div class="container-scroller">
        <!-- Navbar dan Sidebar -->
        @include('partials.navbarasisten') <!-- Pastikan navbar di-include dengan benar -->

        <div class="container-fluid page-body-wrapper">
            <!-- Sidebar -->
            @include('partials.sidebarasisten') <!-- Pastikan sidebar di-include dengan benar -->

            <div class="main-content flex-grow-1">
                @yield('content') <!-- Isi konten utama halaman -->
            </div>
        </div>
    </div>
    
    
    <!-- JS (Letakkan script di bagian bawah, pastikan Popper.js ada sebelum Bootstrap JS) -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Script Kustom -->
    @stack('scripts')
    @yield('scripts')
</body>

</html>
