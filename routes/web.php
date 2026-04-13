<?php
use App\Http\Controllers\FrontController;
use App\Http\Controllers\AdminPesananController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// --- HALAMAN USER (TANPA LOGIN) ---
Route::get('/', [FrontController::class, 'index'])->name('welcome');
Route::get('/pesan/{id}', [FrontController::class, 'formPesan'])->name('pesan.form');
Route::post('/pesan/{id}', [FrontController::class, 'simpanPesanan'])->name('pesan.store');

// --- HALAMAN ADMIN (PERLU LOGIN) ---
Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminPesananController::class, 'index'])->name('admin.dashboard');
    Route::post('/pesanan/{id}/terima', [AdminPesananController::class, 'terima'])->name('admin.terima');
    
    // CRUD Produk Makanan
    Route::resource('produk', AdminProdukController::class);
    
    // Kelola Pesanan
    Route::get('pesanan', [AdminPesananController::class, 'index'])->name('pesanan.index');
    Route::post('pesanan/{id}/terima', [AdminPesananController::class, 'terima'])->name('pesanan.terima');
    // CRUD Produk (Gunakan Resource atau sesuaikan dengan controller Anda)
    
});

require __DIR__.'/auth.php';