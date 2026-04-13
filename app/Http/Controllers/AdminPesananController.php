<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class AdminPesananController extends Controller
{
    public function index()
    {
        $pesanans = Pesanan::with('produk')->latest()->get();
        return view('admin.pesanan.index', compact('pesanans'));
    }

   public function terima($id) {
    $pesanan = Pesanan::with('produk')->findOrFail($id);
    $pesanan->update(['status' => 'diterima']);

    // Pesan Notifikasi Otomatis
    $pesan = "Halo {$pesanan->nama_pemesan}, pesanan {$pesanan->produk->nama_makanan} Anda telah DITERIMA dan sedang diproses.";
    
    // Mengarahkan admin ke link WA untuk memberi tahu user
    $wa_url = "https://wa.me/{$pesanan->no_telp}?text=" . urlencode($pesan);

    return redirect()->away($wa_url);
}
}