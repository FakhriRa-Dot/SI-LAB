<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MSI LAB - @yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Arima:wght@100..700&family=Itim&family=Lato:wght@400;700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=Sour+Gummy:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    @stack('styles')

    <style>
        body {
            font-family: "Poppins", serif;
            margin: 0;
        }

        .sidebar {
            height: 100vh;
            position: fixed;
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
    </style>
</head>
<body>
    <div id="app" class="d-flex">
        <!-- Sidebar -->
        <div id="sidebar" class="sidebar layout-bg">
            <div class="toggle-btn">
                <div class="logo">
                    <img src="{{ asset('img/logo-unib.png') }}" alt="Logo UNIB" id="toggle-sidebar">
                </div>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link font-layout" href="{{ route('asisten.dashboard') }}">
                        <i class="bi bi-house"></i><span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-layout" href="{{ route('asisten.absensi.mahasiswa') }}">
                        <i class="bi bi-check2-square"></i><span>Absensi Mahasiswa</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-layout" href="{{ route('absensi.create') }}">
                        <i class="bi bi-pencil-square"></i><span>Absensi Asisten</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-layout" href="{{ route('asisten.nilai') }}">
                        <i class="bi bi-clipboard"></i><span>Nilai Mahasiswa</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-layout" href="{{ route('asisten.arsip') }}">
                        <i class="bi bi-folder"></i><span>Arsip Praktikum</span>
                    </a>
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
        <div id="main-content" class="main-content flex-grow-1">
            @yield('content')
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const toggleSidebar = document.getElementById('toggle-sidebar');

            toggleSidebar.addEventListener('click', () => {
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('collapsed');
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    @stack('scripts')
    @yield('scripts')
</body>
</html>