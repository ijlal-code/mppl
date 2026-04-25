<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\AdminPesananController;
use Illuminate\Support\Facades\Route;

// --- HALAMAN PENGUNJUNG (TANPA LOGIN) ---
Route::get('/', [FrontController::class, 'index'])->name('welcome');
Route::get('/pesan/{id}', [FrontController::class, 'formPesan'])->name('pesan.form');
Route::post('/pesan/{id}', [FrontController::class, 'simpanPesanan'])->name('pesan.store');

// --- HALAMAN KHUSUS ADMIN (WAJIB LOGIN) ---
Route::middleware(['auth'])->prefix('admin')->group(function () {
    
    // Rute Dashboard Admin -> Ini yang sebelumnya error
    Route::get('/dashboard', [AdminPesananController::class, 'index'])->name('admin.dashboard');
    
    // Rute Aksi Terima Pesanan
    Route::post('/pesanan/{id}/terima', [AdminPesananController::class, 'terima'])->name('admin.terima');
});

// Default Dashboard (opsional, untuk profil)
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';