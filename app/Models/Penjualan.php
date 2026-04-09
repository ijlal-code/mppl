<?php

// app/Models/Penjualan.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $fillable = ['produk_id', 'user_id', 'jumlah', 'total_harga', 'tanggal'];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}