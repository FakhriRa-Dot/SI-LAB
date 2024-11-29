@extends('admin.app')

@section('title', 'Edit Mahasiswa')

@section('content')
<div class="container mt-3">
    <h1>Edit Data Mahasiswa</h1>

    <form action="{{ route('data.mahasiswas.update', $mahasiswa->npm) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="npm" class="form-label">NPM</label>
            <input type="text" class="form-control" id="npm" name="npm" value="{{ old('npm', $mahasiswa->npm) }}" required readonly>
        </div>

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $mahasiswa->nama) }}" required>
        </div>

        <div class="mb-3">
            <label for="no_hp" class="form-label">No. HP</label>
            <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ old('no_hp', $mahasiswa->no_hp) }}" required>
        </div>

        <div id="kelas-container">
            <div class="mb-3">
                <label for="kelas_id[]" class="form-label">Kelas</label>
                <select class="form-select" name="kelas_id[]" required>
                    <option value="">Pilih Kelas</option>
                    @foreach($kelas as $k)
                        <option value="{{ $k->id_kelas }}" 
                            @foreach($mahasiswa->kelas as $mk)
                                {{ $mk->id_kelas == $k->id_kelas ? 'selected' : '' }}
                            @endforeach
                        >
                            {{ $k->nama_kelas }} - {{ $k->mata_proyek }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <button type="button" class="btn btn-success mt-2" id="add-kelas-button">Tambah Kelas</button>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('data.mahasiswas.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>

<script>
    document.getElementById('add-kelas-button').addEventListener('click', function() {
        // Temukan container untuk input kelas
        const kelasContainer = document.getElementById('kelas-container');
        const newField = document.createElement('div'); // Buat elemen baru untuk input
        newField.classList.add('mb-3');
        newField.innerHTML = `
            <label for="kelas_id[]" class="form-label">Kelas</label>
            <select class="form-select" name="kelas_id[]" required>
                <option value="">Pilih Kelas</option>
                @foreach($kelas as $k)
                    <option value="{{ $k->id_kelas }}">
                        {{ $k->nama_kelas }} - {{ $k->mata_proyek }}
                    </option>
                @endforeach
            </select>
            <button type="button" class="btn btn-danger btn-sm mt-2 remove-kelas-button">Hapus</button>
        `;

        // Tambahkan elemen baru ke dalam container
        kelasContainer.appendChild(newField);

        // Tambahkan event listener untuk tombol hapus
        newField.querySelector('.remove-kelas-button').addEventListener('click', function() {
            newField.remove();
        });
    });
</script>
@endsection
