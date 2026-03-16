<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BarangController;
use App\Models\Barang; // WAJIB DITAMBAHKAN AGAR BISA MENGAMBIL DATA BARANG
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// UBAH BAGIAN INI
Route::get('/dashboard', function () {
    // 1. Ambil semua data barang dari database
    $barangs = Barang::latest()->get();
    
    // 2. Ambil total jumlah barang untuk card di atas
    $total_barang = Barang::count(); 

    // 3. Kirim variabel $barangs dan $total_barang ke view 'dashboard'
    return view('dashboard', compact('barangs', 'total_barang'));
    
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.update.photo');

    // Route untuk CRUD Data Barang
    Route::resource('barang', BarangController::class);
});

require __DIR__.'/auth.php';