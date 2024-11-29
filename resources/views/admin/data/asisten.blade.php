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

        <!-- Button Tambah Asisten -->
        <button class="btn" style="background-color: #21ded8; color: white;" type="button" data-bs-toggle="collapse" data-bs-target="#formTambahAsisten" aria-expanded="false" aria-controls="formTambahAsisten">
            Tambah
        </button>
        <br><br>

        <!-- Form Tambah Asisten -->
        <div class="collapse" id="formTambahAsisten">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Form Tambah Asisten</h5>
                    <form action="{{ route('data.asistens.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- NPM -->
                        <div class="mb-3">
                            <label for="npm" class="form-label">NPM</label>
                            <select name="npm" class="form-select" id="npm" required>
                                <option value="">Pilih Mahasiswa</option>
                                @foreach ($mahasiswa as $mhs)
                                    <option value="{{ $mhs->npm }}">{{ $mhs->npm }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Nama -->
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Asisten" required>
                        </div>

                        <!-- Foto -->
                        <div class="mb-3">
                            <label for="photo" class="form-label">Foto</label>
                            <input type="file" name="photo" class="form-control" id="photo" accept="image/*">
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" name="password" class="form-control" placeholder="Password" required id="password-field">
                                <button type="button" class="btn btn-outline-secondary" id="toggle-password">👁️</button>
                            </div>
                        </div>

                        <!-- Kelas -->
                        <div id="kelas-container">
                            <div class="mb-3">
                                <label for="kelas_id[]" class="form-label">Kelas</label>
                                <select class="form-select" name="kelas_id[]" required>
                                    <option value="">Pilih Kelas</option>
                                    @foreach($kelas as $k)
                                        <option value="{{ $k->id_kelas }}">{{ $k->nama_kelas }} - {{ $k->mata_proyek }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Tombol Tambah Kelas -->
                        <button type="button" class="btn btn-success mt-2" id="add-kelas-button">Tambah Kelas</button>

                        <!-- Tombol Simpan & Batal -->
                        <button type="submit" class="btn" style="background-color: #6a0dad; color: white; font-family: 'Arial', sans-serif;">Simpan</button>
                        <button type="button" class="btn" style="background-color: #dbd9d9; font-family: 'Arial', sans-serif;" data-bs-toggle="collapse" data-bs-target="#formTambahAsisten" aria-expanded="false">Batal</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Table Data Asisten -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped" style="font-family: 'Arial', sans-serif;">
                <thead class="table-dark" style="background-color: #0446b0; color: white;">
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
                                <img src="{{ asset('uploads/photos/' . $asisten->photo) }}" alt="{{ $asisten->nama }}" style="width: 60px; height: 60px; object-fit: cover;">
                            @else
                                <span>Tidak ada foto tersedia</span>
                            @endif
                        </td>
                        <td>{{ $asisten->npm }}</td>
                        <td>{{ $asisten->nama }}</td>
                        <td>{{ $asisten->mahasiswa->no_hp }}</td>
                        <td>
                            @foreach($asisten->kelas as $k)
                                <span class="badge bg-primary">{{ $k->nama_kelas }} ({{ $k->mata_proyek }})</span>
                            @endforeach
                        </td>
                        <td class="text-center">
                            <!-- Edit Button with Icon -->
                            <a href="{{ route('asistens.edit', $asisten->id) }}" class="btn btn-warning btn-sm text-dark" style="font-size: 14px; display: inline-flex; align-items: center;">
                                <i class="fas fa-edit" style="color: rgb(25, 24, 24);"></i> Edit
                            </a>
                            
                            <!-- Delete Button -->
                            <form action="{{ route('asistens.destroy', $asisten->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
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

    <!-- Link ke Font Awesome untuk ikon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- JavaScript untuk Toggle Password -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Mengambil data kelas dari variabel PHP dan mengubahnya menjadi JSON di JavaScript
        const kelasData = @json($kelas);

        document.getElementById('add-kelas-button').addEventListener('click', function() {
            const kelasContainer = document.getElementById('kelas-container');
            const newField = document.createElement('div');
            newField.classList.add('mb-3');
            newField.innerHTML = `
                <label for="kelas_id[]" class="form-label">Kelas</label>
                <select class="form-select" name="kelas_id[]" required>
                    <option value="">Pilih Kelas</option>
                    ${kelasData.map(kelas => `
                        <option value="${kelas.id_kelas}">
                            ${kelas.nama_kelas} - ${kelas.mata_proyek}
                        </option>
                    `).join('')}
                </select>
                <button type="button" class="btn btn-danger btn-sm mt-2 remove-kelas-button">Hapus</button>
            `;
            kelasContainer.appendChild(newField);

            newField.querySelector('.remove-kelas-button').addEventListener('click', function() {
                newField.remove();
            });
        });

        // Toggle password visibility
        $('#toggle-password').click(function() {
            const passwordField = $('#password-field');
            const type = passwordField.attr('type') === 'password' ? 'text' : 'password';
            passwordField.attr('type', type);
        });
    </script>
@endsection
