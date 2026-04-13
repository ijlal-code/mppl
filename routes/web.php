<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\Admin\AdminProdukController;
use App\Http\Controllers\Admin\AdminPesananController;
use Illuminate\Support\Facades\Route;

// --- GUEST (TANPA LOGIN) ---
Route::get('/', [FrontController::class, 'index'])->name('welcome');
Route::get('/pesan/{id}', [FrontController::class, 'create'])->name('pesan.create');
Route::post('/pesan/{id}', [FrontController::class, 'store'])->name('pesan.store');

// --- ADMIN ---
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function() { return view('admin.dashboard'); })->name('admin.dashboard');
    
    // CRUD Produk Makanan
    Route::resource('produk', AdminProdukController::class);
    
    // Kelola Pesanan
    Route::get('pesanan', [AdminPesananController::class, 'index'])->name('pesanan.index');
    Route::patch('pesanan/{id}/terima', [AdminPesananController::class, 'terima'])->name('pesanan.terima');
});

require __DIR__.'/auth.php';