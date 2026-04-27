<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request) // Tambahkan Request $request
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
            $query = Penjualan::query();
            $selectedDate = $request->input('tanggal');

            // Jika ada filter tanggal yang dipilih, terapkan pada query
            if ($selectedDate) {
                $query->whereDate('tanggal', $selectedDate);
            }

            // Hitung data (akan menghitung semua jika tidak ada filter, atau menghitung sesuai tanggal jika ada filter)
            $totalTransaksi = $query->count();
            $totalBarang = (int) $query->sum('jumlah');
            $totalPendapatan = (int) $query->sum('total_harga');
            
            // Transaksi hari ini atau transaksi pada tanggal yang dipilih
            $hariIni = $selectedDate 
                ? Penjualan::whereDate('tanggal', $selectedDate)->count() 
                : Penjualan::whereDate('tanggal', today())->count();

            // Ambil 10 data terakhir berdasarkan filter (jika ada)
            $data = $query->with('user')->latest()->take(10)->get();

            return view('admin.dashboard', compact(
                'totalTransaksi', 
                'totalBarang', 
                'totalPendapatan', 
                'hariIni', 
                'data',
                'selectedDate'
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