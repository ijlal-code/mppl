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

        // Jika dia Admin, tampilkan halaman Dashboard Admin
        if ($userRole === 'admin') {
            $totalTransaksi = Penjualan::count();
            $totalBarang = Penjualan::sum('jumlah');
            $totalPendapatan = Penjualan::sum('total_harga');
            $hariIni = Penjualan::whereDate('tanggal', today())->count();
            
            // Ambil 10 transaksi terakhir beserta relasi
            $data = Penjualan::with(['produk', 'user'])->latest()->take(10)->get();

            return view('admin.dashboard', compact(
                'totalTransaksi', 
                'totalBarang', 
                'totalPendapatan', 
                'hariIni', 
                'data'
            ));
        }

        // Jika dia Kasir, JANGAN BUKA DASHBOARD, langsung lempar ke form Input
        if ($userRole === 'kasir') {
            return redirect()->route('kasir.create');
        }

        // Jika karena suatu alasan role tidak terdeteksi (sebagai pengaman tambahan)
        abort(403, 'Akses ditolak. Role tidak dikenali.');
    }
}