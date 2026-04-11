<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
   protected $fillable = [
    'user_id', 
    'nama_barang', 
    'harga', 
    'jumlah', 
    'total_harga', 
    'tanggal', 
    'foto_barang'
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}