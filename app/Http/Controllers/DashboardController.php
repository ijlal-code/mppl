<?php

namespace App\Http\Controllers;
use App\Models\Penjualan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $totalTransaksi = Penjualan::count();
            $totalBarang = Penjualan::sum('jumlah');
            $totalPendapatan = Penjualan::sum('total_harga');
            $hariIni = Penjualan::whereDate('tanggal', today())->count();
            $data = Penjualan::with(['produk', 'user'])->latest()->take(10)->get();

            return view('admin.dashboard', compact('totalTransaksi', 'totalBarang', 'totalPendapatan', 'hariIni', 'data'));
        }

        // Jika Kasir, langsung arahkan ke form input
        return redirect()->route('kasir.create');
    }
}