<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MSI LAB - @yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arima:wght@100..700&family=Itim&family=Lato:wght@400;700&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=Sour+Gummy:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

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
        }

        .main-content {
            padding: 20px;
            overflow-x: hidden;
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
    <div id="app" class="d-flex">

        <div class="bg-light border-right" id="sidebar-wrapper">
            <div class="sidebar-heading text-center">
                <h2>Logo</h2>
            </div>
            <div class="list-group list-group-flush">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('data.mahasiswas.index') }}">Data Mahasiswa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('data.asistens.index') }}">Data Asisten</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('jadwal-praktikum.index') }}">Jadwal Praktikum</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('jadwal-praktikum.index') }}">Jadwal Praktikum</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.hasil-absensi.index') }}">Absensi Mahasiswa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.rekap') }}">Absensi Asisten</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.arsip') }}">Arsip Praktikum</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.nilai') }}">Arsip Nilai Praktikum</a>
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
        </div>

        <div class="main-content flex-grow-1">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @stack('scripts')
    @yield('scripts')
</body>
</html>