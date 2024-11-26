@extends('asisten.app')

@section('title', 'Edit Arsip Praktikum')

@section('content')
    <div class="container">
        <h1>Edit Arsip Praktikum</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('arsip.update', $arsip->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="mata_kuliah" class="form-label">Mata Kuliah</label>
                <select id="mata_kuliah" name="mata_kuliah" class="form-select" required>
                    @foreach ($kelas as $kls)
                        <option value="{{ $kls->mata_proyek }}" {{ $arsip->mata_proyek == $kls->mata_proyek ? 'selected' : '' }}>
                            {{ $kls->mata_proyek }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" id="judul" name="judul" class="form-control" value="{{ $arsip->judul }}" required>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" class="form-control">{{ $arsip->deskripsi }}</textarea>
            </div>

            <div class="mb-3">
                <label for="link" class="form-label">Link</label>
                <input type="text" id="link" name="link" class="form-control" value="{{ $arsip->link }}">
            </div>

            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('asisten.arsip') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
