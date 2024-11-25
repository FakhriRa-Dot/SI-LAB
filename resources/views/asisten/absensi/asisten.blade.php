@extends('asisten.app')

@section('title', 'Absensi Asisten')

@section('content')
    <div class="container">
        <h1>Absensi Asisten Dosen</h1>
        <form action="{{ route('absensi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" id="tanggal" value="{{ old('tanggal') }}" required>
                @error('tanggal')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="kelas" class="form-label">Kelas</label>
                <select name="kelas" id="kelas" class="form-select" required>
                    <option value="" disabled selected>Pilih Kelas</option>
                    @foreach ($kelas as $k)
                        <option value="{{ $k->id_kelas }}" {{ old('kelas') == $k->id_kelas ? 'selected' : '' }}>
                            {{ $k->nama_kelas }} - {{ $k->mata_proyek}}
                        </option>
                    @endforeach
                </select>
                @error('kelas')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="npm" class="form-label">NPM</label>
                <input type="text" name="npm" class="form-control" id="npm" value="{{ old('npm') }}" required>
                @error('npm')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" id="nama" value="{{ old('nama', session('nama_asisten', '')) }}" readonly>
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                <input type="file" name="foto" class="form -control" id="foto" accept=".jpg,.jpeg,.png">
                @error('foto')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-dark">SEND</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.getElementById('npm').addEventListener('input', function() {
            const npm = this.value;

            if (npm.length >= 5) {
                fetch(`/asisten/nama?npm=${npm}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.nama) {
                            document.getElementById('nama').value = data.nama;
                        } else {
                            document.getElementById('nama').value = '';
                        }
                    })
                    .catch(error => console.error('Error fetching name:', error));
            } else {
                document.getElementById('nama').value = '';
            }
        });
    </script>
@endsection