<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Pesanan;

class FrontController extends Controller
{
    public function index()
    {
        $produks = Produk::all();
        return view('welcome', compact('produks'));
    }

    public function create($id)
    {
        $produk = Produk::findOrFail($id);
        if($produk->stok <= 0) {
            return redirect('/')->with('error', 'Maaf, stok makanan ini sedang habis!');
        }
        return view('pesan', compact('produk'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'nama_pemesan' => 'required|string',
            'no_telp' => 'required|string',
            'jumlah' => 'required|integer|min:1'
        ]);

        $produk = Produk::findOrFail($id);

        if ($produk->stok < $request->jumlah) {
            return back()->with('error', 'Jumlah pesanan melebihi stok yang ada!');
        }

        // Kurangi stok
        $produk->decrement('stok', $request->jumlah);

        // Buat pesanan
        Pesanan::create([
            'produk_id' => $produk->id,
            'nama_pemesan' => $request->nama_pemesan,
            'no_telp' => $request->no_telp,
            'jumlah' => $request->jumlah,
            'total_harga' => $produk->harga * $request->jumlah,
            'status' => 'pending'
        ]);

        return redirect('/')->with('success', 'Pesanan berhasil dibuat! Admin akan segera menghubungi Anda melalui WhatsApp.');
    }

    public function simpanPesanan(Request $request, $id) {
    $produk = Produk::findOrFail($id);
    
    // Cek Stok
    if ($produk->stok <= 0) {
        return back()->with('error', 'Maaf, stok makanan ini sudah habis!');
    }

    $request->validate([
        'nama_pemesan' => 'required|string',
        'no_telp' => 'required|string',
        'jumlah' => 'required|integer|min:1|max:' . $produk->stok
    ]);

    // Simpan Pesanan
    $pesanan = Pesanan::create([
        'produk_id' => $produk->id,
        'nama_pemesan' => $request->nama_pemesan,
        'no_telp' => $request->no_telp,
        'jumlah' => $request->jumlah,
        'total_harga' => $produk->harga * $request->jumlah,
        'status' => 'pending'
    ]);

    // Kurangi Stok
    $produk->decrement('stok', $request->jumlah);

    return redirect()->route('welcome')->with('success', 'Pesanan Anda berhasil dikirim! Tunggu konfirmasi admin.');
}
}