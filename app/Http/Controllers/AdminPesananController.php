<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class AdminPesananController extends Controller
{
    // Menampilkan Tabel Pesanan
    public function index()
    {
        // Ambil data pesanan dan produknya, urutkan dari yang terbaru
        $pesanans = Pesanan::with('produk')->latest()->get();
        return view('admin.dashboard', compact('pesanans'));
    }

    // Aksi saat tombol "Terima" diklik
    public function terima($id)
    {
        $pesanan = Pesanan::with('produk')->findOrFail($id);
        
        // Update status di database
        $pesanan->update(['status' => 'diterima']);

        // Format pesan otomatis ke WhatsApp User
        $pesan = "Halo {$pesanan->nama_pemesan},\n\nTerima kasih, pesanan *{$pesanan->produk->nama_makanan}* sebanyak {$pesanan->jumlah} porsi telah kami DITERIMA.\n\nTotal: Rp " . number_format($pesanan->total_harga, 0, ',', '.');
        
        $wa_url = "https://wa.me/{$pesanan->no_telp}?text=" . urlencode($pesan);

        // Arahkan langsung ke browser WA
        return redirect()->away($wa_url);
    }
}