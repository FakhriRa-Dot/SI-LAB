@extends('admin.app')

@section('title', 'Data Mahasiswa')

@section('content')
<div class="container mt-3">
    <h1>Data Mahasiswa</h1>
    
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <button class="btn btn-dark mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#formTambahMahasiswa" aria-expanded="false" aria-controls="formTambahMahasiswa">
        Tambah
    </button>

    <div class="collapse" id="formTambahMahasiswa">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Form Tambah Mahasiswa</h5>
                <form action="{{ route('data.mahasiswas.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="npm" class="form-label">NPM</label>
                        <input type="text" class="form-control" id="npm" name="npm" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="no_hp" class="form-label">No. HP</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" required>
                    </div>
                    <div id="kelas-container">
                        <div class="mb-3">
                            <label for="kelas_id[]" class="form-label">Kelas</label>
                            <select class="form-select" name="kelas_id[]" required>
                                <option value="">Pilih Kelas</option>
                                @foreach($kelas as $k)
                                    <option value="{{ $k->id_kelas }}">
                                        {{ $k->nama_kelas }} - {{ $k->mata_proyek }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="button" class="btn btn-success mt-2" id="add-kelas-button">Tambah Kelas</button>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>NPM</th>
                    <th>Nama Lengkap</th>
                    <th>No. HP</th>
                    <th>Kelas</th>
                    <th>Ket</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mahasiswa as $index => $mhs)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $mhs->npm }}</td>
                    <td>{{ $mhs->nama }}</td>
                    <td>{{ $mhs->no_hp }}</td>
                    <td>
                        @foreach($mhs->kelas as $k)
                            <span class="badge bg-primary">{{ $k->nama_kelas }} ({{ $k->mata_proyek }})</span>
                        @endforeach
                    </td>
                    <td>
                        <!-- Tambahkan aksi edit/hapus sesuai kebutuhan -->
                    </td>
                </tr> @endforeach
            </tbody>
        </table>
    </div>
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