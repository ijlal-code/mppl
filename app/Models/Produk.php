<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = ['nama_makanan', 'harga', 'stok', 'jenis_makanan', 'gambar'];

    public function pesanans()
    {
        return $this->hasMany(Pesanan::class);
    }
}