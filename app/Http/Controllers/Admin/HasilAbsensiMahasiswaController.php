<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AbsensiMahasiswa;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\HasilAbsensiExport;
use App\Models\Kelas;
use App\Models\Mahasiswa;

class HasilAbsensiMahasiswaController extends Controller
{
    public function index()
    {
        // Ambil data kelas yang dibagi berdasarkan semester dan mata proyek
        $proyekGanjil = Kelas::where('semester', 'Ganjil')->get()->groupBy('mata_proyek');
        $proyekGenap = Kelas::where('semester', 'Genap')->get()->groupBy('mata_proyek');
        
        // Debug untuk memastikan data proyekGanjil dan proyekGenap tersedia
        

        // Kirim data kelas yang dibagi per semester ke view
        return view('admin.hasil-absensi.absensi_mahasiswa', compact('proyekGanjil', 'proyekGenap'));
    }

    // Menampilkan rekap absensi mahasiswa berdasarkan id kelas
    public function rekapAbsensi($id_kelas)
    {
        // Ambil data kelas berdasarkan id_kelas
        $kelas = Kelas::findOrFail($id_kelas);
        
        // Ambil mahasiswa yang terdaftar di kelas tersebut
        $mahasiswas = Mahasiswa::whereHas('kelas', function ($query) use ($id_kelas) {
            $query->where('kelas.id_kelas', $id_kelas); // Menyebutkan 'kelas.id_kelas' untuk menghindari ambiguitas
        })->get();

        $rekapAbsensi = [];

        // Proses absensi untuk setiap mahasiswa
        foreach ($mahasiswas as $mahasiswa) {
            // Ambil absensi berdasarkan id_kelas dan npm mahasiswa
            $absensi = AbsensiMahasiswa::where('id_kelas', $id_kelas)
                ->where('npm', $mahasiswa->npm)
                ->get();

            $pertemuan = [];
            $hadirCount = 0;

            // Proses status kehadiran untuk setiap pertemuan
            for ($i = 1; $i <= 8; $i++) {
                // Ambil status kehadiran untuk pertemuan ke-$i
                $status = $absensi->where('pertemuan', $i)->first()->keterangan ?? '-';
                $pertemuan[$i] = $status;

                // Hitung jumlah kehadiran
                if ($status === 'HADIR') $hadirCount++;
            }

            // Tambahkan data rekap absensi mahasiswa ke array
            $rekapAbsensi[] = [
                'npm' => $mahasiswa->npm,
                'nama' => $mahasiswa->nama,
                'pertemuan' => $pertemuan,
                'persentase_hadir' => round(($hadirCount / 8) * 100, 2), // Hitung persentase kehadiran
            ];
        }

        // Kirim data kelas dan rekap absensi ke view
        return view('admin.hasil-absensi.absensi_mahasiswa', compact('kelas', 'rekapAbsensi'));
    }
}

    // public function downloadPDF()
    // {
    //     $absensis = AbsensiMahasiswa::with(['mahasiswa', 'kelas'])->get();

    //     $absensis = $absensis->groupBy('mahasiswa_id')->map(function ($items) {
    //         $totalPertemuan = $items->count();
    //         $hadir = $items->where('status', 'Hadir')->count();

    //         return [
    //             'mahasiswa' => $items->first()->mahasiswa,
    //             'kelas' => $items->first()->kelas,
    //             'pertemuan' => $items->pluck('status'),
    //             'persentase' => $totalPertemuan > 0 ? round(($hadir / $totalPertemuan) * 100, 2) : 0,
    //         ];
    //     });

    //     $pdf = PDF::loadView('admin.hasil-absensi.hasilpdf', compact('absensis'));
    //     return $pdf->download('hasil_absensi.pdf');
    // }

//     public function downloadExcel()
//     {
//         return Excel::download(new HasilAbsensiExport, 'hasil_absensi.xlsx');
//     }
// }
