@extends('admin.app')

@section('content')
<div class="container mt-4">
    <h3>Hasil Absensi Mahasiswa</h3>

    <div class="table-responsive mt-3">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Mahasiswa</th>
                    <th>Jumlah Kehadiran</th>
                    <th>Total Pertemuan</th>
                    <th>Presentase Kehadiran</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($absensi as $key => $data)
                    @php
                        $presentase = ($data->kehadiran / $totalPertemuan) * 100;
                    @endphp
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $data->mahasiswa->nama }}</td>
                        <td>{{ $data->kehadiran }}</td>
                        <td>{{ $totalPertemuan }}</td>
                        <td>{{ number_format($presentase, 2) }}%</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        <h5>Total Kehadiran: {{ $totalKehadiran }} / {{ $totalPertemuan }}</h5>
        <h5>Presentase Kehadiran: {{ number_format($totalKehadiran / $totalPertemuan * 100, 2) }}%</h5>
    </div>
</div>
@endsection
