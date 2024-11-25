@extends('asisten.app')

@section('title', 'Absensi Mahasiswa')

@section('content')
    <div class="container">
        <h1 class="mb-5">Absensi Mahasiswa</h1>

        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active tab-layout" data-bs-toggle="tab" href="#ganjil" role="tab">Ganjil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link tab-layout" data-bs-toggle="tab" href="#genap" role="tab">Genap</a>
            </li>
        </ul>

        <div class="tab-content mt-3">

            <div id="ganjil" class="tab-pane fade show active">
                @foreach ($proyekGanjil as $namaProyek => $proyekItems)
                    <div class="list-group">

                        <div class="list-group-item bg-items">
                            {{ $namaProyek }}
                            <div class="dropdown float-end">
                                <button class="btn btn-layout dropdown-toggle" type="button" id="dropdownMenuButton{{ $namaProyek }}" data-bs-toggle="dropdown" aria-expanded="false">
                                    Kelas
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $namaProyek }}">
                                    @foreach ($proyekItems as $kelas)
                                        <li>
                                            <a class="dropdown-item" href="{{ route('asisten.absensi.mahasiswaDetail', ['id_kelas' => $kelas->id_kelas]) }}">
                                                {{ $kelas->nama_kelas }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div id="genap" class="tab-pane fade">
                @foreach ($proyekGenap as $namaProyek => $proyekItems)
                    <div class="list-group">

                        <div class="list-group-item bg-items">
                            {{ $namaProyek }}
                            <div class="dropdown float-end">
                                <button class="btn btn-layout dropdown-toggle" type="button" id="dropdownMenuButton{{ $namaProyek }}" data-bs-toggle="dropdown" aria-expanded="false">
                                    Kelas
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $namaProyek }}">
                                    @foreach ($proyekItems as $kelas)
                                        <li>
                                            <a class="dropdown-item" href="{{ route('asisten.absensi.mahasiswaDetail', ['id_kelas' => $kelas->id_kelas]) }}">
                                                {{ $kelas->nama_kelas }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection