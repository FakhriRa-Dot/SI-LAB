<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('data.mahasiswas.index') }}">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Data Mahasiswa</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('data.asistens.index') }}">
                <i class="icon-columns menu-icon"></i>
                <span class="menu-title">Data Asisten</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('jadwal-praktikum.index') }}">
                <i class="icon-columns menu-icon"></i>
                <span class="menu-title">Jadwal Praktikum</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="icon-bar-graph menu-icon"></i>
                <span class="menu-title">Absensi</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.hasil-absensi.index') }}">Absensi Mahasiswa</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.rekap') }}">Absensi Asisten</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basis" aria-expanded="false" aria-controls="ui-basis">
                <i class="icon-bar-graph menu-icon"></i>
                <span class="menu-title">Arsip</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basis">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.arsip') }}">Arsip Praktikum</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.nilai') }}">Arsip Nilai Praktikum</a></li>
                </ul>
            </div>
        </li>
    </ul>
</nav>
