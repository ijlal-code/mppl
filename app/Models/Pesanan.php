<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
   protected $fillable = [
    'produk_id', 'nama_pemesan', 'no_telp', 'jumlah', 'total_harga', 'status'
   ];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}