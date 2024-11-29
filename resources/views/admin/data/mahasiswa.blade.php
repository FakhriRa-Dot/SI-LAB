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
                    <th style="background-color: #0446b0">No</th>
                    <th style="background-color: #0446b0">NPM</th>
                    <th style="background-color: #0446b0">Nama Lengkap</th>
                    <th style="background-color: #0446b0">No. HP</th>
                    <th style="background-color: #0446b0">Kelas</th>
                    <th style="background-color: #0446b0">Ket</th>
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
                        <!-- Edit Button -->
                        <a href="{{ route('data.mahasiswas.edit', $mhs->npm) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        
                        <!-- Delete Button -->
                        <form action="{{ route('data.mahasiswas.destroy', $mhs->npm) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus mahasiswa ini?')">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr> 
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    document.getElementById('add-kelas-button').addEventListener('click', function() {
        const kelasContainer = document.getElementById('kelas-container');
        const newField = document.createElement('div');
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
        kelasContainer.appendChild(newField);

        newField.querySelector('.remove-kelas-button').addEventListener('click', function() {
            newField.remove();
        });
    });
</script>

@endsection
