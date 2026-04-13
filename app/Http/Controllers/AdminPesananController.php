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

    public function terima($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->update(['status' => 'diterima']);
        
        // Format Pesan WA Notifikasi
        $pesan_wa = "Halo {$pesanan->nama_pemesan}, Pesanan {$pesanan->produk->nama_makanan} sejumlah {$pesanan->jumlah} porsi (Total: Rp " . number_format($pesanan->total_harga,0,',','.') . ") telah kami TERIMA dan sedang diproses. Mohon ditunggu!";
        $link_wa = "https://wa.me/" . $pesanan->no_telp . "?text=" . urlencode($pesan_wa);

        return redirect()->away($link_wa); // Otomatis mengarahkan Admin ke WhatsApp Web/App
    }
}