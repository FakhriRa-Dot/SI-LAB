@extends('asisten.app')

@section('title', 'Detail Absensi Mahasiswa')

@section('content')
    <div class="container">
        <h6>Absensi Mahasiswa</h6>
        <div class="row mb-3 mt-3">
            <div class="d-flex justify-content-between w-100">
                <h2 class="mata-proyek">{{ $kelas->mata_proyek }}</h2>
                <h2 class="kelas">{{ $kelas->nama_kelas }}</h2>
            </div>
        </div>

        <ul class="nav nav-tabs" id="sessionTabs" role="tablist">
            @for ($i = 1; $i <= 8; $i++)
                <li class="nav-item" role="presentation">
                    <button class="tab-layout nav-link {{ $i === 1 ? 'active' : '' }}" 
                            id="session{{ $i }}-tab" 
                            data-bs-toggle="tab" 
                            data-bs-target="#session{{ $i }}" 
                            type="button"
                            role="tab"
                            aria-controls="session{{ $i }}"
                            aria-selected="{{ $i === 1 ? 'true' : 'false' }}">
                            {{ $i }}
                    </button>
                </li>
            @endfor
        </ul>

        <div class="tab-content" id="sessionTabContent">
            @for ($i = 1; $i <= 8; $i++)
                <div class="tab-pane fade {{ $i === 1 ? 'show active' : '' }}" 
                    id="session{{ $i }}" 
                    role="tabpanel" 
                    aria-labelledby="session{{ $i }}-tab">
                    <form action="{{ route('asisten.absensi.konfirmasi') }}" method="POST">
                        @csrf
                        <div class="form-group mt-3 row">
                            <div class="col-md-1">
                                <label for="date{{ $i }}" class="fs-5">Tanggal</label>
                            </div>
                            <div class="col-md-3">
                                <input type="date" name="tanggal" id="date{{ $i }}" class="form-control" required>
                                <input type="hidden" name="pertemuan" value="{{ $i }}">
                                <input type="hidden" name="id_kelas" value="{{ $kelas->id_kelas }}">
                            </div>
                        </div>

                        <table class="table mt-3">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NPM</th>
                                    <th>Nama</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mahasiswas as $index => $mahasiswa)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            {{ $mahasiswa->npm }}
                                            <input type="hidden" name="npm[]" value="{{ $mahasiswa->npm }}">
                                        </td>
                                        <td>{{ $mahasiswa->nama }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <input type="radio" class="btn-check" name="keterangan[{{ $mahasiswa->npm }}]" id="status{{ $i }}_{{ $mahasiswa->npm }}_h" value="HADIR" autocomplete="off" required>
                                                <label class="btn btn-outline-primary btn-sm" for="status{{ $i }}_{{ $mahasiswa->npm }}_h">H</label>

                                                <input type="radio" class="btn-check" name="keterangan[{{ $mahasiswa->npm }}]" id="status{{ $i }}_{{ $mahasiswa->npm }}_s" value="SAKIT" autocomplete="off" required>
                                                <label class="btn btn-outline-primary btn-sm" for="status{{ $i }}_{{ $mahasiswa->npm }}_s">S</label>

                                                <input type="radio" class="btn-check" name="keterangan[{{ $mahasiswa->npm }}]" id="status{{ $i }}_{{ $mahasiswa->npm }}_i" value="IZIN" autocomplete="off" required>
                                                <label class="btn btn-outline-primary btn-sm" for="status{{ $i }}_{{ $mahasiswa->npm }}_i">I</label>

                                                <input type="radio" class="btn-check" name="keterangan[{{ $mahasiswa->npm }}]" id="status{{ $i }}_{{ $mahasiswa->npm }}_a" value="ALPA" autocomplete="off" required>
                                                <label class="btn btn-outline-primary btn-sm" for="status{{ $i }}_{{ $mahasiswa->npm }}_a">A</label>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-layout-send">Kirim</button>
                        </div>

                        @if (session('success'))
                            <div class="alert alert-success mt-3">
                                {{ session('success') }}
                            </div>
                        @endif
                    </form>
                </div>
            @endfor
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </div>
@endsection