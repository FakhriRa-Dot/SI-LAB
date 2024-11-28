@extends('admin.app')

@section('title', 'Arsip Praktikum (Admin)')

@section('content')
    <div class="container">
        <h1>Arsip Praktikum (Admin)</h1>

        <!-- Notifikasi Sukses -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabel Data Arsip -->
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Mata Kuliah</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Lampiran</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if ($arsipPraks->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center text-danger">No Entry Data</td>
                    </tr>
                @else
                    @foreach ($arsipPraks as $index => $arsip)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $arsip->mata_proyek }}</td>
                            <td>{{ $arsip->judul }}</td>
                            <td>{{ $arsip->deskripsi }}</td>
                            <td><a href="{{ $arsip->link }}" target="_blank">View Link</a></td>
                            <td>
                                <!-- Tombol Delete -->
                                <form action="{{ route('admin.arsip.destroy', $arsip->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
@endsection