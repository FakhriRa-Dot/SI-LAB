<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Kelas;
use App\Models\Mahasiswa;

use Illuminate\Http\Request;

class DataMahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::with('kelas')->get();
        $kelas = Kelas::all();
        return view('admin.data.mahasiswa', compact('mahasiswa', 'kelas'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'npm' => 'required|unique:mahasiswas,npm|max:15',
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'kelas_id' => 'required|array',
            'kelas_id.*' => 'exists:kelas,id_kelas'
        ]);

        try {
            $mahasiswa = Mahasiswa::create([
                'npm' => $validatedData['npm'],
                'nama' => $validatedData['nama'],
                'no_hp' => $validatedData['no_hp']
            ]);

            // Attach kelas to mahasiswa
            $mahasiswa->kelas()->attach($validatedData['kelas_id']);

            return redirect()->route('data.mahasiswas.index')->with('success', 'Mahasiswa berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan mahasiswa: ' . $e->getMessage());
        }
    }

    // Edit dan Delete
}