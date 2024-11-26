<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Asisten;
use App\Models\AbsensiAsisten;
use App\Models\Kelas;

class HasilAbsensiAsistenController extends Controller
{
    public function index()
{
    $rekapAbsensi = Asisten::with('absensiAsisten', 'kelas') // Eager load relasi
        ->get()
        ->map(function ($asisten) {
            $totalHadir = $asisten->absensiAsisten->count(); // Hitung jumlah hadir
            $totalPertemuan = AbsensiAsisten::distinct('tanggal')->count('tanggal'); // Total pertemuan
            $presentase = $totalPertemuan > 0 ? ($totalHadir / $totalPertemuan) * 100 : 0;

            return [
                'nama' => $asisten->nama,
                'npm' => $asisten->npm,
                // Ambil nama_kelas dari koleksi kelas dan gabungkan dengan koma
                'kelas' => $asisten->kelas->pluck('nama_kelas')->join(', ') ?: '-',
                'foto' => optional($asisten->absensiAsisten->last())->foto ?? null,
                'jumlah_hadir' => $totalHadir,
                'presentase' => round($presentase, 2),
            ];
        });

    return view('admin.hasil-absensi.rekap', compact('rekapAbsensi'));
}

}    


