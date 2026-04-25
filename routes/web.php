<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pesananController;
use App\Http\Controllers\MushroomCatalogController;
use App\Http\Controllers\PaymentController;
use App\Models\Pesanan;
use App\Models\Produk;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman utama
Route::get('/', function () {
    $produkList = Produk::where('stok', '>', 0)->take(4)->get();
    return view('homepage', compact('produkList'));
});

Route::get('/index', function () {
    return view('index');
});

Route::get('/produk', function () {
    return view('produk');
});

Route::get('/mushrooms', [MushroomController::class, 'index'])->name('mushrooms.index');

// Dashboard
Route::get('/dashboard', function () {
    $totalPesanan = Pesanan::count();
    $totalProduk = Produk::count();
    $totalUser = User::count();
    $totalRevenue = Pesanan::where('status', 'terkirim')->sum('total_harga');
    $recentPesanan = Pesanan::with(['user', 'produk'])->latest()->take(5)->get();

    return view('dashboard', compact(
        'totalPesanan',
        'totalProduk',
        'totalUser',
        'totalRevenue',
        'recentPesanan'
    ));
});

// =======================
// ROUTE PESANAN (CRUD)
// =======================
Route::get('/pesanan', [pesananController::class, 'index'])->name('pesanan.index');
Route::get('/pesanan/create', [pesananController::class, 'create'])->name('pesanan.create');
Route::post('/pesanan', [pesananController::class, 'store'])->name('pesanan.store');
Route::post('/pesanan/buy-now', [pesananController::class, 'buyNow'])->name('pesanan.buyNow'); // ← HARUS SEBELUM {pesanan}
Route::get('/pesanan/{pesanan}', [pesananController::class, 'show'])->name('pesanan.show');
Route::get('/pesanan/{pesanan}/edit', [pesananController::class, 'edit'])->name('pesanan.edit');
Route::put('/pesanan/{pesanan}', [pesananController::class, 'update'])->name('pesanan.update');
Route::delete('/pesanan/{pesanan}', [pesananController::class, 'destroy'])->name('pesanan.destroy');


// HALAMAN LAIN

Route::get('/tentang-kami', function () {
    return view('tentangkami');
})->name('tentangkami');


Route::get('/mushrooms', [MushroomCatalogController::class, 'index'])->name('mushrooms.index');

Route::get('/mushrooms/{type}', [MushroomCatalogController::class, 'type'])->name('mushrooms.type');

// =======================
// ROUTE PAYMENT MIDTRANS
// =======================
Route::get('/payment/checkout/{id}', [PaymentController::class, 'checkout'])->name('payment.checkout');
Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
Route::get('/payment/pending', [PaymentController::class, 'pending'])->name('payment.pending');
Route::get('/payment/failed', [PaymentController::class, 'failed'])->name('payment.failed');

// Webhook dari Midtrans (CSRF dikecualikan di VerifyCsrfToken.php)
Route::post('/payment/notification', [PaymentController::class, 'notification'])->name('payment.notification');