<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userRole = Auth::user()->role;

        // =========================
        // ADMIN
        // =========================
        if ($userRole === 'admin') {

            $totalTransaksi = Penjualan::count();
            $totalBarang = Penjualan::sum('jumlah');
            $totalPendapatan = Penjualan::sum('total_harga');
            $hariIni = Penjualan::whereDate('tanggal', today())->count();

            // ❗ HAPUS produk, cukup user saja
            $data = Penjualan::with('user')->latest()->take(10)->get();

            return view('admin.dashboard', compact(
                'totalTransaksi', 
                'totalBarang', 
                'totalPendapatan', 
                'hariIni', 
                'data'
            ));
        }

        // =========================
        // KASIR
        // =========================
        if ($userRole === 'kasir') {
            return redirect()->route('kasir.create');
        }

        // =========================
        // DEFAULT (AMAN)
        // =========================
        abort(403, 'Akses ditolak. Role tidak dikenali.');
    }
}