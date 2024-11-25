@extends('asisten.app')

@section('title', 'Arsip Praktikum')

@section('content')
    <div class="container">
        <h1>Arsip Praktikum</h1>
        <button id="addButton" class="btn btn-primary">Add</button>

        <div id="formContainer" class="mt-4" style="display: none;">
            <div class="card">
                <div class="card-body">
                    <form id="arsipForm" method="POST" action="{{ route('arsip.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="mata_kuliah" class="col-sm-2 col-form-label">Mata Kuliah</label>
                            <div class="col-sm-10">
                                <select id="mata_kuliah" name="mata_kuliah" class="form-select" required>
                                    <option selected disabled>Pilih Mata Kuliah</option>
                                    @foreach ($kelas as $kls)
                                        <option value="{{ $kls->mata_proyek }}">{{ $kls->mata_proyek }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                            <div class="col-sm-10">
                                <input type="text" id="judul" name="judul" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                            <div class="col-sm-10">
                                <textarea id="deskripsi" name="deskripsi" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="link" class="col-sm-2 col-form-label">Link</label>
                            <div class="col-sm-10">
                                <input type="text" id="link" name="link" class="form-control">
                            </div>
                        </div>
                        <div class=" d-flex justify-content-end">
                            <button type="button" id="cancelButton" class="btn btn-secondary me-2">Batal</button>
                            <button type="submit" class="btn btn-success">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Mata Kuliah</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Lampiran</th>
                    </tr>
                </thead>
                <tbody>
                    @if($arsipPraks->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center text-danger">No Entry Data</td>
                        </tr>
                    @else
                        @foreach ($arsipPraks as $index => $arsip)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $arsip->mata_proyek }}</td>
                                <td>{{ $arsip->judul }}</td>
                                <td>{{ $arsip->deskripsi }}</td>
                                <td><a href="{{ $arsip->link }}" target="_blank">View Link</a></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const addButton = document.getElementById('addButton');
        const formContainer = document.getElementById('formContainer');
        const cancelButton = document.getElementById('cancelButton');

        addButton.addEventListener('click', () => {
            formContainer.style.display = 'block';
        });

        cancelButton.addEventListener('click', () => {
            formContainer.style.display = 'none';
        });
    </script>
@endsection