<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BarangController;
use App\Models\Barang; // WAJIB DITAMBAHKAN AGAR BISA MENGAMBIL DATA BARANG
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [BarangController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.update.photo');

    // Route untuk CRUD Data Barang
    Route::resource('barang', BarangController::class);

});

require __DIR__.'/auth.php';