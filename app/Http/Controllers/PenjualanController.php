<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenjualanController extends Controller
{
    // --- KHUSUS KASIR ---
    public function create()
    {
        $produks = Produk::all();
        return view('kasir.create', compact('produks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal' => 'required|date',
        ]);

        $produk = Produk::findOrFail($request->produk_id);
        $total_harga = $produk->harga * $request->jumlah;

        Penjualan::create([
            'produk_id' => $request->produk_id,
            'user_id' => Auth::id(), // ID Kasir yang login
            'jumlah' => $request->jumlah,
            'total_harga' => $total_harga, // Hitung otomatis
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('kasir.create')->with('success', 'Transaksi berhasil disimpan!');
    }

    // --- KHUSUS ADMIN ---
    public function index()
    {
        $penjualans = Penjualan::with(['produk', 'user'])->latest()->paginate(15);
        return view('admin.penjualan.index', compact('penjualans'));
    }

    public function destroy(Penjualan $penjualan)
    {
        $penjualan->delete();
        return redirect()->route('admin.penjualan.index')->with('success', 'Data berhasil dihapus');
    }
}