@extends ('admin.app')

@section('title', 'Nilai Mahasiswa')

@section('content')
    <div class="container mt-3">
        <h2>Nilai Mahasiswa</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Data Table Section -->
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Mata Kuliah</th>
                    <th>Kelas</th>
                    <th>Lampiran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($nilaiMahasiswa as $nilai)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $nilai->tanggal }}</td>
                        <td>{{ $nilai->mata_kuliah }}</td>
                        <td>{{ $nilai->kelas }}</td>
                        <td>
                            <a href="{{ asset('storage/' . $nilai->lampiran) }}" target="_blank" class="btn btn-link">Download</a>
                        </td>
                        <td>
                            <form action="{{ route('admin.delete.nilai', $nilai->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fa fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No entry data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
