@extends('admin.app')

@section('content')
<div class="container mt-4">
    <h3>Hasil Absensi Mahasiswa - {{ $kelas->nama_kelas }}</h3>

    <div class="table-responsive mt-3">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NPM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Jumlah Kehadiran</th>
                    <th>Total Pertemuan</th>
                    <th>Presentase Kehadiran</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rekapAbsensi as $key => $data)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $data['npm'] }}</td>
                        <td>{{ $data['nama'] }}</td>
                        <td>{{ $data['kehadiran'] }}</td>
                        <td>{{ $data['totalPertemuan'] }}</td>
                        <td>{{ $data['persentase'] }}%</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        <h5>Total Kehadiran: {{ $totalKehadiran }} / {{ $totalPertemuan * count($rekapAbsensi) }}</h5>
        <h5>Presentase Kehadiran: {{ number_format(($totalKehadiran / ($totalPertemuan * count($rekapAbsensi))) * 100, 2) }}%</h5>
    </div>
</div>
@endsection
