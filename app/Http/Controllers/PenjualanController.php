<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenjualanController extends Controller
{
    // --- KASIR ---
    public function create()
    {
        return view('kasir.create');
    }

    public function store(Request $request)
    {
        // Validasi input sebagai teks dan angka bulat (integer)
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'harga' => 'required|integer|min:0',
            'jumlah' => 'required|integer|min:1',
            'tanggal' => 'required|date',
        ]);

        // Kalkulasi matematika otomatis
        $total = $request->harga * $request->jumlah;

        Penjualan::create([
            'user_id' => Auth::id(),
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'jumlah' => $request->jumlah,
            'total_harga' => $total,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('kasir.create')->with('success', 'Transaksi Penjualan Berhasil Disimpan!');
    }

    // --- ADMIN ---
    public function index()
    {
        $penjualans = Penjualan::with('user')->latest()->paginate(15);
        return view('admin.penjualan.index', compact('penjualans'));
    }

    public function destroy(Penjualan $penjualan)
    {
        $penjualan->delete();
        return redirect()->route('admin.penjualan.index')->with('success', 'Data Transaksi berhasil dihapus');
    }
}