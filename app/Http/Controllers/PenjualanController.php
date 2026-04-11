<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PenjualanController extends Controller
{
    // --- LOGIKA REUSABLE UNTUK SIMPAN DATA ---
    private function storeOrUpdate(Request $request, $penjualan = null)
    {
        $rules = [
            'nama_barang' => 'required|string|max:255',
            'harga' => 'required|integer|min:0',
            'jumlah' => 'required|integer|min:1',
            'tanggal' => 'required|date',
            'foto_barang' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi foto
        ];

        // 1. TAMBAHKAN ARRAY PESAN KUSTOM DI SINI
        $messages = [
            'nama_barang.required' => 'Nama barang tidak boleh kosong!',
            'nama_barang.string'   => 'Nama barang harus berupa teks!',
            'nama_barang.max'      => 'Nama barang maksimal 255 karakter!',
            
            'harga.required'       => 'Harga wajib diisi!',
            'harga.integer'        => 'Harga melebihi batas inputan!',
            'harga.min'            => 'Harga tidak boleh minus!',
            
            'jumlah.required'      => 'Jumlah barang wajib diisi!',
            'jumlah.integer'       => 'Harga melebihi batas inputan!',
            'jumlah.min'           => 'Jumlah minimal 1!',
            
            'tanggal.required'     => 'Tanggal wajib diisi!',
            'tanggal.date'         => 'Format tanggal tidak valid!',
            
            'foto_barang.image'    => 'File yang diupload harus berupa gambar!',
            'foto_barang.mimes'    => 'Format gambar harus jpeg, png, atau jpg!',
            'foto_barang.max'      => 'Ukuran foto maksimal 2MB!',
        ];

        // 2. MASUKKAN $messages SEBAGAI PARAMETER KEDUA
        $validated = $request->validate($rules, $messages);
        
        $total = $request->harga * $request->jumlah;

        $data = [
            'user_id' => Auth::id(),
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'jumlah' => $request->jumlah,
            'total_harga' => $total,
            'tanggal' => $request->tanggal,
        ];

        if ($request->hasFile('foto_barang')) {
            // Hapus foto lama jika sedang update
            if ($penjualan && $penjualan->foto_barang) {
                Storage::disk('public')->delete($penjualan->foto_barang);
            }
            $data['foto_barang'] = $request->file('foto_barang')->store('barang', 'public');
        }

        if ($penjualan) {
            $penjualan->update($data);
        } else {
            Penjualan::create($data);
        }
    }

    // --- KASIR ---
    public function create() { return view('kasir.create'); }

    public function store(Request $request)
    {
        $this->storeOrUpdate($request);
        return redirect()->route('kasir.create')->with('success', 'Transaksi Berhasil Disimpan!');
    }

    // --- ADMIN ---
    public function index()
    {
        $penjualans = Penjualan::with('user')->latest()->paginate(15);
        return view('admin.penjualan.index', compact('penjualans'));
    }

    public function createAdmin() { return view('admin.penjualan.create'); }

    public function storeAdmin(Request $request)
    {
        $this->storeOrUpdate($request);
        return redirect()->route('admin.penjualan.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit(Penjualan $penjualan) { return view('admin.penjualan.edit', compact('penjualan')); }

    public function update(Request $request, Penjualan $penjualan)
    {
        $this->storeOrUpdate($request, $penjualan);
        return redirect()->route('admin.penjualan.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(Penjualan $penjualan)
    {
        if ($penjualan->foto_barang) {
            Storage::disk('public')->delete($penjualan->foto_barang);
        }
        $penjualan->delete();
        return redirect()->route('admin.penjualan.index')->with('success', 'Data berhasil dihapus');
    }
}