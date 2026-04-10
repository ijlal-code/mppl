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
            $table->string('nama_barang');
            $table->integer('harga');
            $table->integer('jumlah');
            $table->integer('total_harga');
            $table->date('tanggal');
            // Tambahkan kolom foto_barang, nullable() karena bersifat opsional
            $table->string('foto_barang')->nullable(); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penjualans');
    }
};