<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Otomatis arahkan ke dashboard masing-masing setelah login
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // === ROUTE KHUSUS KASIR ===
    Route::middleware('role:kasir')->group(function () {
        Route::get('/transaksi/baru', [PenjualanController::class, 'create'])->name('kasir.create');
        Route::post('/transaksi/baru', [PenjualanController::class, 'store'])->name('kasir.store');
    });

    // === ROUTE KHUSUS ADMIN ===
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/penjualan', [PenjualanController::class, 'index'])->name('admin.penjualan.index');
        Route::get('/admin/penjualan/{penjualan}/edit', [PenjualanController::class, 'edit'])->name('admin.penjualan.edit');
        Route::put('/admin/penjualan/{penjualan}', [PenjualanController::class, 'update'])->name('admin.penjualan.update');
        Route::delete('/admin/penjualan/{penjualan}', [PenjualanController::class, 'destroy'])->name('admin.penjualan.destroy');
    });
});

require __DIR__.'/auth.php';