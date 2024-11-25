@extends ('admin.app')

@section('title', 'Data Asisten')

@section('content')
    <div class="container mt-3">
        <h1 class="mb-4">Data Asisten</h1>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <button class="btn btn-dark mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#formTambahAsisten" aria-expanded="false" aria-controls="formTambahAsisten">
            Tambah
        </button>

        <div class="collapse" id="formTambahAsisten">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Form Tambah Asisten</h5>
                    <form action="{{ route('data.asistens.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="npm" class="form-label">NPM</label>
                            <select name="npm" class="form-select" id="npm" required>
                                <option value="">Pilih Mahasiswa</option>
                                @foreach ($mahasiswa as $mhs)
                                    <option value="{{ $mhs->npm }}">{{ $mhs->npm }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Asisten" required readonly>
                        </div>
                        <div class="mb-3">
                            <label for="photo" class="form-label">Foto</label>
                            <input type="file" name="photo" class="form-control" id="photo" accept="image/*">
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
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>

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
                        <th>Foto</th>
                        <th>NPM</th>
                        <th>Nama Lengkap</th>
                        <th>No. HP</th>
                        <th>Kelas</th>
                        <th>Ket</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($asistens as $index => $asisten)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            @if($asisten->photo)
                                <img src="{{ asset('uploads/photos/' . $asisten->photo) }}" alt="{{ $asisten->nama }}" width="100">
                            @else
                                <span>Tidak ada foto tersedia</span>
                            @endif
                        </td>
                        <td>{{ $asisten->npm }}</td>
                        <td>{{ $asisten->nama }}</td>
                        <td>{{ $asisten->mahasiswa->no_hp }}</td>
                        <td>
                            @if($asisten->kelas->isEmpty())
                                <span>Tidak ada kelas</span>
                            @else
                                @foreach($asisten->kelas as $k)
                                    <span class="badge bg-primary">{{ $k->nama_kelas }} ({{ $k->mata_proyek }})</span>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('asistens.edit', $asisten->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('asistens.destroy', $asisten->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#npm').change(function() {
                const npm = $(this).val();

                if (npm) {
                    fetch(`/asisten/nama?npm=${npm}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.nama) {
                                $('#nama').val(data.nama);
                            } else {
                                $('#nama').val('');
                            }
                        })
                        .catch(error => console.error('Error fetching name:', error));
                } else {
                    $('#nama').val('');
                }
            });
        });

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