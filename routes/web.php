<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ValidasiTahapSatuController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\ValidasiTahapDuaController;
use App\Http\Controllers\FinalDocumentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// Rute untuk tamu (pengguna yang belum login)
Route::middleware(['guest'])->group(function () {
    Route::get('/home', [WelcomeController::class, 'index'])->name('home');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'postlogin']);
});

// Rute untuk pengguna yang sudah login
Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/profile', [UserController::class, 'profile']);
    Route::post('/updatephoto', [UserController::class, 'updatePhoto']);
    Route::get('/validasitahapsatu', [ValidasiTahapSatuController::class, 'index'])->name('validasi.tahap.satu');
    Route::post('/validasitahapsatu/list', [ValidasiTahapSatuController::class, 'list'])->name('validasi.tahap.satu.list');
    Route::get('/validasitahapsatu/{id}/show', [ValidasiTahapSatuController::class, 'show'])->name('validasi.tahap.satu.show'); 
    Route::post('/validasitahapsatu/{id}/approve', [ValidasiTahapSatuController::class, 'approve'])->name('validasi.tahap.satu.approve');
    Route::post('/validasitahapsatu/{id}/reject', [ValidasiTahapSatuController::class, 'reject'])->name('validasi.tahap.satu.reject');

    // Rute untuk Validasi Tahap Dua
    Route::get('/validasi-tahap-dua', [ValidasiTahapDuaController::class, 'index'])->name('validasi.tahap.dua');
    Route::post('/validasi-tahap-dua/list', [ValidasiTahapDuaController::class, 'list'])->name('validasi.tahap.dua.list');
    Route::get('/validasi-tahap-dua/{id}/show_ajax', [ValidasiTahapDuaController::class, 'show_ajax']);
    Route::post('/validasi-tahap-dua/{id}/approve_ajax', [ValidasiTahapDuaController::class, 'approve_ajax']);
    Route::post('/validasi-tahap-dua/{id}/reject_ajax', [ValidasiTahapDuaController::class, 'reject_ajax']);
});


// Rute untuk Admin Kriteria (pengerjaan kriteria)
Route::prefix('kriteria')->group(function () {
    Route::get('{id}', [KriteriaController::class, 'edit'])->name('kriteria.edit');
    Route::post('{id}/save', [KriteriaController::class, 'save'])->name('kriteria.save');
    Route::post('{id}/submit', [KriteriaController::class, 'submit'])->name('kriteria.submit');
    Route::delete('{id}/data/{dataId}', [KriteriaController::class, 'deleteData'])->name('kriteria.deleteData');
    Route::delete('{id}/delete-gambar/{gambarId}', [KriteriaController::class, 'deleteGambar'])->name('kriteria.deleteGambar');
});

// // Rute untuk KJM
// Route::middleware(['auth'])->group(function () {
//     Route::get('/validasi-data', [ValidasiKJMController::class, 'index']);
//     Route::get('/validasi-data/{id}/lihat', [ValidasiKJMController::class, 'show']);
//     Route::put('/validasi-data/{id}/update', [ValidasiKJMController::class, 'updateStatus']);
//     Route::get('/finalisasi-dokumen', [FinalDocumentController::class, 'index'])->name('finalisasi.index');
//     Route::get('/finalisasi', [FinalDocumentController::class, 'index'])->name('finalisasi.index');
//     Route::get('/finalisasi/export-pdf', [FinalDocumentController::class, 'exportPdf'])->name('finalisasi.export.pdf');
// });
// // Rute untuk DIR
// Route::middleware(['auth'])->group(function () {
//     Route::get('/validasi-data', [ValidasiDirController::class, 'index']);
//     Route::get('/validasi-data/{id}/lihat', [ValidasiDirController::class, 'show']);
//     Route::put('/validasi-data/{id}/update', [ValidasiDirController::class, 'updateStatus']);
//     Route::get('/finalisasi-dokumen', [FinalDocumentController::class, 'index'])->name('finalisasi.index');
//     Route::get('/finalisasi', [FinalDocumentController::class, 'index'])->name('finalisasi.index');
//     Route::get('/finalisasi/export-pdf', [FinalDocumentController::class, 'exportPdf'])->name('finalisasi.export.pdf');
// });
