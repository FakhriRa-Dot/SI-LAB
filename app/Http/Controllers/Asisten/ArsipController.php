<?php

namespace App\Http\Controllers\Asisten;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Kelas;
use App\Models\ArsipPrak;

class ArsipController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();
        $arsipPraks = ArsipPrak::all();

        return view('asisten.arsip', compact('kelas', 'arsipPraks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mata_kuliah' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'link' => 'nullable|url',
        ]);

        ArsipPrak::create([
            'mata_proyek' => $request->mata_kuliah,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'link' => $request->link,
        ]);

        return redirect()->route('asisten.arsip')->with('success', 'Data berhasil ditambahkan.');
    }
}
