<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Perbaikan Route Anggota & Transaksi
    Route::get('anggota/cetak-pdf', [AnggotaController::class, 'cetakPdf'])->name('anggota.cetak');
    Route::resource('anggota', AnggotaController::class)->parameters([
        'anggota' => 'anggota'
    ]);

    Route::get('transaksi/cetak-pdf', [TransaksiController::class, 'cetakPdf'])->name('transaksi.cetak');
    Route::resource('transaksi', TransaksiController::class)->parameters([
        'transaksi' => 'transaksi'
    ]);
});

require __DIR__.'/auth.php';