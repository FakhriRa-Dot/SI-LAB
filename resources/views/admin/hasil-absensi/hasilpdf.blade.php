<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hasil Absensi Mahasiswa</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Hasil Absensi Mahasiswa</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NPM</th>
                <th>Nama</th>
                <th>Persentase Kehadiran</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($absensis as $index => $data)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $data['mahasiswa']->npm }}</td>
                    <td>{{ $data['mahasiswa']->nama }}</td>
                    <td>{{ $data['persentase'] }}%</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
