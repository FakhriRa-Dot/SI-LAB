<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\AsistenController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Asisten\ArsipController;
use App\Http\Controllers\Asisten\NilaiController;

use App\Http\Controllers\Admin\DataAsistenController;
use App\Http\Controllers\Admin\DataMahasiswaController;
use App\Http\Controllers\Admin\JadwalPraktikumController;
use App\Http\Controllers\Asisten\AbsensiAsistenController;
use App\Http\Controllers\Asisten\AbsensiMahasiswaController;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\HasilAbsensiMahasiswaController;

Route::get('/', [AuthenticatedSessionController::class, 'create'])
    ->name('login')
    ->middleware('guest');

Route::post('/', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                return redirect('/admin/dashboard');
            } elseif (Auth::user()->role === 'asisten') {
                return redirect('/asisten/dashboard');
            }
        }

        return redirect('/')->with('error', 'Akses tidak valid');
    })->name('dashboard');

    // Admin
    Route::middleware(['admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        Route::get('/asistens', [DataAsistenController::class, 'index'])->name('data.asistens.index');
        Route::post('/asistens/store', [DataAsistenController::class, 'store'])->name('data.asistens.store');
        Route::get('/asisten/nama', [DataAsistenController::class, 'getNama']);
        Route::get('asistens/{id}/edit', [DataAsistenController::class, 'edit'])->name('asistens.edit');
        Route::put('asistens/{id}', [DataAsistenController::class, 'update'])->name('asistens.update');
        Route::delete('asistens/{id}', [DataAsistenController::class, 'destroy'])->name('asistens.destroy');

        Route::get('/mahasiswas', [DataMahasiswaController::class, 'index'])->name('data.mahasiswas.index');
        Route::post('/mahasiswas/store', [DataMahasiswaController::class, 'store'])->name('data.mahasiswas.store');

        Route::get('/jadwal-praktikum', [JadwalPraktikumController::class, 'index'])->name('jadwal-praktikum.index');
        Route::get('/jadwal-praktikum/create', [JadwalPraktikumController::class, 'create'])->name('jadwal-praktikum.create');
        Route::post('/jadwal-praktikum/store', [JadwalPraktikumController::class, 'store'])->name('jadwal-praktikum.store');
        Route::get('/jadwal-praktikum/{id}/edit', [JadwalPraktikumController::class, 'edit'])->name('jadwal-praktikum.edit');
        Route::put('/jadwal-praktikum/{id}', [JadwalPraktikumController::class, 'update'])->name('jadwal-praktikum.update');
        Route::delete('/jadwal-praktikum/{id}', [JadwalPraktikumController::class, 'destroy'])->name('jadwal-praktikum.destroy');

        Route::get('/admin/absensi_mahasiswa', [HasilAbsensiMahasiswaController::class, 'index'])->name('admin.kelas.proyek');
        Route::get('/admin/hasil-absen/{id_kelas}', [HasilAbsensiMahasiswaController::class, 'rekapAbsensi'])->name('admin.rekap.absensi');
        Route::get('/admin/hasil-absensi', [HasilAbsensiMahasiswaController::class, 'index'])->name('admin.hasil-absensi.index');

        // Route::get('/hasil-absensi/download-pdf', [HasilAbsensiMahasiswaController::class, 'downloadPDF'])->name('admin.hasil-absensi.download-pdf');
        // Route::get('/hasil-absensi/download-excel', [HasilAbsensiMahasiswaController::class, 'downloadExcel'])->name('admin.hasil-absensi.download-excel');
    });



    // Asisten
    Route::middleware(['asisten'])->group(function () {
        Route::get('/asisten/dashboard', [AsistenController::class, 'dashboard'])->name('asisten.dashboard');

        Route::get('/asisten/absensi/mahasiswa', [AbsensiMahasiswaController::class, 'index'])->name('asisten.absensi.mahasiswa');
        Route::get('/asisten/absensi/mahasiswa/{id_kelas}', [AbsensiMahasiswaController::class, 'showAbsensi'])->name('asisten.absensi.mahasiswaDetail');
        Route::post('/asisten/absensi/mahasiswa/store', [AbsensiMahasiswaController::class, 'store'])->name('asisten.absensi.mahasiswa.store');
        Route::post('/asisten/absensi/mahasiswa/konfirmasi', [AbsensiMahasiswaController::class, 'konfirmasi'])->name('asisten.absensi.konfirmasi');

        Route::get('/asisten/absensi/asisten', [AbsensiAsistenController::class, 'create'])->name('absensi.create');
        Route::post('/asisten/absensi/store', [AbsensiAsistenController::class, 'store'])->name('absensi.store');
        Route::get('/asisten/nama', [AbsensiAsistenController::class, 'getAsistenByNpm']);

        Route::get('/asisten/nilai', [NilaiController::class, 'index'])->name('asisten.nilai');
        Route::post('/asisten/upload-nilai', [NilaiController::class, 'upload'])->name('upload.nilai');

        Route::get('asisten/arsip-praktikum', [ArsipController::class, 'index'])->name('asisten.arsip');
        Route::post('/arsip/store', [ArsipController::class, 'store'])->name('arsip.store');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
