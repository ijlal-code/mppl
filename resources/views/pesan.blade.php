<form action="{{ route('pesan.store', $produk->id) }}" method="POST">
    @csrf
    <div class="card p-4">
        <h3>Detail Pesanan</h3>
        <img src="{{ asset('storage/'.$produk->gambar) }}" width="200">
        <p>Menu: <strong>{{ $produk->nama_makanan }}</strong></p>
        <p>Harga: Rp {{ number_format($produk->harga) }}</p>
        <p>Jenis: {{ $produk->jenis_makanan }}</p>
        <p>Sisa Stok: {{ $produk->stok }}</p>

        <div class="mt-3">
            <input type="text" name="nama_pemesan" placeholder="Nama Anda" class="form-control mb-2" required>
            <input type="text" name="no_telp" placeholder="Nomor Telepon (Contoh: 628123...)" class="form-control mb-2" required>
            <input type="number" name="jumlah" value="1" min="1" max="{{ $produk->stok }}" class="form-control mb-2" required>
        </div>

        <button type="submit" class="btn btn-success w-100">Kirim Pesanan Sekarang</button>
    </div>
</form>