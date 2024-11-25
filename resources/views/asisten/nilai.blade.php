@extends ('asisten.app')

@section('title', 'Nilai')

@section('content')
    <div class="container mt-3">
        <h2>Nilai Mahasiswa</h2>
        <button id="showUploadForm" class="btn btn-dark mb-3">Upload</button>

        <div id="uploadForm" class="border p-4 mb-3" style="display: none;">
            <form id="formUpload" enctype="multipart/form-data" method="post" action="{{ route('upload.nilai') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="semester" class="form-label">Semester</label>
                            <select id="semester" name="semester" class="form-select">
                                <option selected disabled>Pilih Semester</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="mata_kuliah" class="form-label">Mata Kuliah</label>
                            <select id="mata_kuliah" name="mata_kuliah" class="form-select">
                                <option selected disabled>Pilih Mata Kuliah</option>
                                @foreach ($kelas as $kls)
                                    <option value="{{ $kls->mata_proyek }}">{{ $kls->mata_proyek }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="kelas" class="form-label">Kelas</label>
                            <select id="kelas" name="kelas" class="form-select">
                                <option selected disabled>Pilih Kelas</option>
                                @foreach ($kelas as $kls)
                                    <option value="{{ $kls->nama_kelas }}">{{ $kls->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="text" id="tanggal" name="tanggal" class="form-control" placeholder="DD/MM/YY" value="{{ now()->format('d/m/Y') }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="file" class="form-label">Lampiran</label>
                            <input type="file" id="file" name="file" class="form-control" accept=".xls, .xlsx">
                            <small class="form-text text-muted">*file maks. 4MB</small>
                        </div>
                        <div id="filePreview" class="border p-2 text-center" style="height: 200px; overflow: auto;">
                            <span class="text-muted">PREVIEW FILE</span>
                        </div>
                    </div>
                </div>
                <button type="button" id="cancelUpload" class="btn btn-secondary">Batal</button>
                <button type="submit" class="btn btn-dark">Upload</button>
            </form>
        </div>

        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Mata Kuliah</th>
                    <th>Kelas</th>
                    <th>Lampiran</th>
                </tr>
            </thead>
            
            <tbody>
                @forelse ($nilaiMahasiswa as $nilai)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $nilai->tanggal }}</td>
                        <td>{{ $nilai->mata_kuliah }}</td>
                        <td>{{ $nilai->kelas }}</td>
                        <td><a href="{{ asset('storage/' . $nilai->lampiran) }}" target="_blank">Download</a></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No entry data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#showUploadForm').click(function() {
                $('#uploadForm').show();
            });

            $('#cancelUpload').click(function() {
                $('#uploadForm').hide();
            });

            $('#file').change(function(event) {
                let file = event.target.files[0];
                if (file) {
                    $('#filePreview').html('<p>' + file.name + '</p>');
                } else {
                    $('#filePreview').html('<span class="text-muted">PREVIEW FILE</span>');
                }
            });
        });
    </script>
@endsection