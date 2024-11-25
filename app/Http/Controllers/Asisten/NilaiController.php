<?php

namespace App\Http\Controllers\Asisten;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Kelas;
use App\Models\NilaiMahasiswa;

class NilaiController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();
        $nilaiMahasiswa = NilaiMahasiswa::all();

        return view('asisten.nilai', compact('kelas', 'nilaiMahasiswa'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'semester' => 'required',
            'mata_kuliah' => 'required',
            'kelas' => 'required',
            'tanggal' => 'required',
            'file' => 'required|mimes:xls,xlsx|max:4096',
        ]);

        $tanggal = Carbon::createFromFormat('d/m/Y', $request->tanggal)->format('Y-m-d');

        $filePath = $request->file('file')->store('lampiran', 'public');

        $semester = in_array($request->semester, [1, 3, 5]) ? 'Ganjil' : 'Genap';

        NilaiMahasiswa::create([
            'semester' => $semester,
            'mata_kuliah' => $request->mata_kuliah,
            'kelas' => $request->kelas,
            'tanggal' => $tanggal, 
            'lampiran' => $filePath,
        ]);

        return redirect()->route('asisten.nilai')->with('success', 'File berhasil diunggah.');
    }
}