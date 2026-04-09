<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('nama_barang'); // Menggunakan String untuk Nama Barang
            $table->integer('harga');      // Menggunakan Integer
            $table->integer('jumlah');     // Menggunakan Integer
            $table->integer('total_harga');// Menggunakan Integer
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penjualans');
    }
};