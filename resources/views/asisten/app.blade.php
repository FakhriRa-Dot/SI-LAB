<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MSI LAB - @yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arima:wght@100..700&family=Itim&family=Lato:wght@400;700&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=Sour+Gummy:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    @stack('styles')

    <style>
        body {
            font-family: "Sour Gummy", serif;
            margin: 0;
        }

        .sidebar {
            height: 100vh;
            position: sticky;
            top: 0;
        }

        .main-content {
            padding: 20px;
            overflow-x: hidden;
        }
    </style>
</head>
<body>
    <div id="app" class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar layout-bg flex-shrink-0 p-3" style="width: 250px;">
            <h2 class="text-center">
                <img src="{{ asset('img/logo-unib.png') }}" alt="Logo UNIB" class="img-fluid w-25 h-25">
            </h2>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link font-layout" href="{{ route('asisten.dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-layout" href="{{ route('asisten.absensi.mahasiswa') }}">Absensi Mahasiswa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-layout" href="{{ route('absensi.create') }}">Absensi Asisten</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-layout" href="{{ route('asisten.nilai') }}">Nilai Mahasiswa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-layout" href="{{ route('asisten.arsip') }}">Arsip Praktikum</a>
                </li>
            </ul>
            
            <div class="logout-link">
                <a class="nav-link text-danger" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content flex-grow-1">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    @stack('scripts')
    @yield('scripts')
</body>
</html>