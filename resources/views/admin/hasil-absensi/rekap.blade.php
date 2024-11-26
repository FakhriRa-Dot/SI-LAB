@extends('admin.app')

@section('content')
  <div class="container mt-4">
    <h1 class="text-center mb-4">Rekap Absensi Asisten</h1>
    <div class="table-responsive">
      <table class="table table-striped table-bordered table-hover">
          <thead class="thead-dark">
              <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>NPM</th>
                  <th>Kelas</th>
                  <th>Foto</th>
                  <th>Jumlah Hadir</th>
                  <th>Presentase (%)</th>
              </tr>
          </thead>
          <tbody>
              @foreach ($rekapAbsensi as $index => $rekap)
                  <tr>
                      <td>{{ $index + 1 }}</td>
                      <td>{{ $rekap['nama'] }}</td>
                      <td>{{ $rekap['npm'] }}</td>
                      <td>{{ $rekap['kelas'] }}</td>
                      <td>
                        @if (!empty($rekap['foto']) && file_exists(public_path('storage/' . $rekap['foto'])))
                            <img src="{{ asset('storage/' . $rekap['foto']) }}" alt="Foto Asisten" width="50" class="img-thumbnail">
                        @else
                            Tidak Ada Foto
                        @endif
                    </td>
                    
                      <td>{{ $rekap['jumlah_hadir'] }}</td>
                      <td>{{ $rekap['presentase'] }}%</td>
                  </tr>
              @endforeach
          </tbody>
      </table>
    </div>
  </div>
@endsection

@push('styles')
  <style>
    .container {
        margin-top: 20px;
    }

    h1 {
        font-size: 2rem;
        font-weight: 600;
    }

    .table {
        width: 100%;
        margin-top: 20px;
        border-collapse: separate;
        border-spacing: 0 8px;
    }

    .table th, .table td {
        padding: 12px;
        text-align: center;
    }

    .table th {
        background-color: #343a40;
        color: white;
        font-size: 1.1rem;
    }

    .table td {
        background-color: #f8f9fa;
    }

    .table-hover tbody tr:hover {
        background-color: #e9ecef;
    }

    .img-thumbnail {
        border-radius: 50%;
        object-fit: cover;
    }
  </style>
@endpush
