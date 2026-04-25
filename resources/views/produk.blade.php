{{-- resources/views/produk/detail.blade.php --}}
@extends('layouts.app')

@section('title', $produk->nama)

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="container mx-auto px-4">
        <!-- Breadcrumb -->
        <nav class="mb-6 text-gray-600">
            <a href="{{ route('produk.katalog') }}" class="hover:text-green-600">Katalog</a>
            <span class="mx-2">/</span>
            <span class="text-gray-800">{{ $produk->nama }}</span>
        </nav>

        <!-- Product Detail -->
        <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Gambar Produk -->
                <div>
                    <img src="{{ asset('storage/' . $produk->gambar) }}" 
                         alt="{{ $produk->nama }}" 
                         class="w-full h-96 object-cover rounded-lg shadow-md">
                </div>

                <!-- Info Produk -->
                <div>
                    <!-- Kategori Badge -->
                    <span class="inline-block px-3 py-1 text-sm rounded-full bg-green-100 text-green-800 mb-3">
                        {{ str_replace('_', ' ', ucwords($produk->kategori)) }}
                    </span>

                    <!-- Nama Produk -->
                    <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ $produk->nama }}</h1>

                    <!-- Harga -->
                    <div class="mb-6">
                        <span class="text-4xl font-bold text-green-600">{{ $produk->harga_formatted }}</span>
                        <span class="text-gray-600 ml-2">/ kg</span>
                    </div>

                    <!-- Stok -->
                    <div class="mb-6">
                        <div class="flex items-center gap-2">
                            @if($produk->stok > 10)
                                <span class="flex items-center text-green-600 font-semibold">
                                    <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    Stok Tersedia ({{ $produk->stok }})
                                </span>
                            @elseif($produk->stok > 0)
                                <span class="flex items-center text-yellow-600 font-semibold">
                                    <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    Stok Terbatas ({{ $produk->stok }})
                                </span>
                            @else
                                <span class="flex items-center text-red-600 font-semibold">
                                    <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                    </svg>
                                    Stok Habis
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Quantity -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2">Jumlah</label>
                        <div class="flex items-center gap-3">
                            <button onclick="decreaseQty()" class="bg-gray-200 hover:bg-gray-300 w-10 h-10 rounded-lg flex items-center justify-center font-bold text-xl">
                                -
                            </button>
                            <input type="number" id="quantity" value="1" min="1" max="{{ $produk->stok }}" 
                                   class="w-20 text-center border rounded-lg py-2 font-semibold text-lg">
                            <button onclick="increaseQty()" class="bg-gray-200 hover:bg-gray-300 w-10 h-10 rounded-lg flex items-center justify-center font-bold text-xl">
                                +
                            </button>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-4 mb-6">
                        @if($produk->stok > 0)
                            <button onclick="addToCart()" class="flex-1 bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-semibold flex items-center justify-center gap-2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                Tambah ke Keranjang
                            </button>
                            <button onclick="buyNow()" class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white py-3 rounded-lg font-semibold">
                                Beli Sekarang
                            </button>
                        @else
                            <button disabled class="flex-1 bg-gray-400 text-white py-3 rounded-lg font-semibold cursor-not-allowed">
                                Stok Habis
                            </button>
                        @endif
                    </div>

                    <!-- Deskripsi -->
                    <div class="border-t pt-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-3">Deskripsi Produk</h2>
                        <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $produk->deskripsi }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Produk Terkait -->
        @if($produkTerkait->count() > 0)
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Produk Terkait</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($produkTerkait as $item)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                    <a href="{{ route('produk.show', $item->id) }}">
                        <img src="{{ asset('storage/' . $item->gambar) }}" 
                             alt="{{ $item->nama }}" 
                             class="w-full h-48 object-cover hover:scale-110 transition-transform duration-300">
                    </a>
                    <div class="p-4">
                        <h3 class="font-bold text-gray-800 mb-2">{{ $item->nama }}</h3>
                        <span class="text-xl font-bold text-green-600">{{ $item->harga_formatted }}</span>
                        <a href="{{ route('produk.show', $item->id) }}" 
                           class="block w-full bg-green-600 hover:bg-green-700 text-white text-center py-2 rounded-lg font-semibold mt-3">
                            Lihat Detail
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

<!-- ===== MODAL BELI SEKARANG ===== -->
<div id="buyNowModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); z-index:9999; align-items:center; justify-content:center;">
    <div style="background:white; border-radius:20px; padding:36px; max-width:480px; width:90%; box-shadow:0 20px 60px rgba(0,0,0,0.3); position:relative; animation: slideUp 0.3s ease;">
        <button onclick="closeBuyNow()" style="position:absolute;top:16px;right:20px;background:none;border:none;font-size:1.4rem;cursor:pointer;color:#666;">✕</button>

        <h3 style="font-size:1.3rem;font-weight:800;color:#1b4332;margin-bottom:4px;">🛒 Beli Sekarang</h3>
        <p style="color:#888;font-size:0.9rem;margin-bottom:24px;">{{ $produk->nama }}</p>

        <form id="buyNowForm" action="{{ route('pesanan.buyNow') }}" method="POST">
            @csrf
            <input type="hidden" name="produk_id" value="{{ $produk->id }}">
            <input type="hidden" name="jumlah" id="formJumlah" value="1">

            <!-- Jumlah -->
            <div style="margin-bottom:18px;">
                <label style="display:block;font-weight:700;color:#333;margin-bottom:8px;">Jumlah Pesanan</label>
                <div style="display:flex;align-items:center;gap:12px;">
                    <button type="button" onclick="modalDecr()" style="width:40px;height:40px;border-radius:10px;border:2px solid #52b788;background:white;font-size:1.2rem;font-weight:700;cursor:pointer;color:#2d6a4f;">−</button>
                    <span id="modalQtyDisplay" style="font-size:1.3rem;font-weight:800;color:#1b4332;min-width:32px;text-align:center;">1</span>
                    <button type="button" onclick="modalIncr()" style="width:40px;height:40px;border-radius:10px;border:2px solid #52b788;background:white;font-size:1.2rem;font-weight:700;cursor:pointer;color:#2d6a4f;">+</button>
                    <span style="color:#888;font-size:0.85rem;">Stok: {{ $produk->stok }}</span>
                </div>
            </div>

            <!-- Alamat -->
            <div style="margin-bottom:24px;">
                <label style="display:block;font-weight:700;color:#333;margin-bottom:8px;">📍 Alamat Pengiriman</label>
                <textarea name="alamat_pengiriman" rows="3" required placeholder="Masukkan alamat lengkap pengiriman..."
                    style="width:100%;border:2px solid #e0e0e0;border-radius:10px;padding:12px;font-size:0.9rem;resize:none;outline:none;transition:0.2s;"
                    onfocus="this.style.borderColor='#52b788'" onblur="this.style.borderColor='#e0e0e0'"></textarea>
            </div>

            <!-- Total Preview -->
            <div style="background:#d8f3dc;border-radius:12px;padding:14px 18px;display:flex;justify-content:space-between;margin-bottom:20px;">
                <span style="font-weight:700;color:#2d6a4f;">Total Bayar</span>
                <span id="modalTotal" style="font-weight:800;color:#1b4332;font-size:1.1rem;">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
            </div>

            <!-- Submit -->
            <button type="submit" style="width:100%;padding:15px;background:linear-gradient(135deg,#2d6a4f,#52b788);color:white;border:none;border-radius:12px;font-size:1rem;font-weight:700;cursor:pointer;box-shadow:0 4px 15px rgba(45,106,79,0.4);transition:0.3s;"
                onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='none'">
                💳 Lanjut ke Pembayaran
            </button>
        </form>
    </div>
</div>

<style>
@keyframes slideUp {
    from { transform: translateY(30px); opacity:0; }
    to   { transform: translateY(0); opacity:1; }
}
</style>

<script>
const maxQty = {{ $produk->stok }};
const harga  = {{ $produk->harga }};
let modalQty = 1;

function increaseQty() {
    const input = document.getElementById('quantity');
    if (parseInt(input.value) < maxQty) input.value = parseInt(input.value) + 1;
}

function decreaseQty() {
    const input = document.getElementById('quantity');
    if (parseInt(input.value) > 1) input.value = parseInt(input.value) - 1;
}

function addToCart() {
    alert('Fitur keranjang belum tersedia. Gunakan Beli Sekarang!');
}

// === Modal Buy Now ===
function buyNow() {
    // Ambil qty dari input halaman
    modalQty = parseInt(document.getElementById('quantity').value) || 1;
    document.getElementById('modalQtyDisplay').textContent = modalQty;
    document.getElementById('formJumlah').value = modalQty;
    updateModalTotal();

    const modal = document.getElementById('buyNowModal');
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeBuyNow() {
    document.getElementById('buyNowModal').style.display = 'none';
    document.body.style.overflow = '';
}

function modalIncr() {
    if (modalQty < maxQty) {
        modalQty++;
        document.getElementById('modalQtyDisplay').textContent = modalQty;
        document.getElementById('formJumlah').value = modalQty;
        updateModalTotal();
    }
}

function modalDecr() {
    if (modalQty > 1) {
        modalQty--;
        document.getElementById('modalQtyDisplay').textContent = modalQty;
        document.getElementById('formJumlah').value = modalQty;
        updateModalTotal();
    }
}

function updateModalTotal() {
    const total = modalQty * harga;
    document.getElementById('modalTotal').textContent = 'Rp ' + total.toLocaleString('id-ID');
}

// Tutup modal jika klik di luar
document.getElementById('buyNowModal').addEventListener('click', function(e) {
    if (e.target === this) closeBuyNow();
});
</script>
@endsection