<?php

use App\Models\Guru;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\InfaqController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PembukuanController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PenggajianController;
use App\Http\Controllers\PengeluaranController;

Route::middleware(['guest'])->group(function () {
    Route::get('/', [SesiController::class, 'index'])->name('login');
    Route::post('/', [SesiController::class, 'login']);
});

Route::get('/home', function () {
    return redirect('/dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::resource('kelas', KelasController::class);
    Route::resource('jenis', JenisController::class);
    Route::resource('siswa', SiswaController::class);
    Route::resource('infaq', InfaqController::class);
    Route::resource('pengguna', PenggunaController::class);

    Route::get('infaq', [InfaqController::class, 'index'])->name('infaq.index');

    Route::resource('pembayaran', PembayaranController::class);
    Route::get('pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');

    Route::resource('pengeluaran', PengeluaranController::class);
    Route::get('pengeluaran', [PengeluaranController::class, 'index'])->name('pengeluaran.index');

    Route::get('pembukuan', [PembukuanController::class, 'index'])->name('pembukuan.index');

    Route::resource('penggajian', PenggajianController::class);

    Route::resource('guru', GuruController::class);

    // Route untuk mendapatkan nominal paud dari database
    Route::get('/get-nominal/{id}', function($id) {
        $guru = Guru::find($id); // Ambil data guru berdasarkan ID
        if ($guru) {
            return response()->json([
                'nominalpaud' => $guru->nominalpaud,
                'nominaltpq' => $guru->nominaltpq
            ]);
        }else{

            return response()->json(['nominalpaud' => $guru->nominalpaud]);
        }
    });


    Route::get('/print', [PenggajianController::class, 'printView'])->name('printView');

    Route::get('/logout', [SesiController::class, 'logout']);
});

