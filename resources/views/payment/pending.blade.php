@extends('layouts.app')

@section('content')
<style>
    body { background: #fffbf0; }

    .result-wrapper {
        max-width: 560px;
        margin: 60px auto;
        padding: 0 16px;
        text-align: center;
        font-family: 'Segoe UI', sans-serif;
    }

    .result-card {
        background: white;
        border-radius: 20px;
        padding: 48px 36px;
        box-shadow: 0 12px 40px rgba(0,0,0,0.10);
    }

    .icon-circle {
        width: 90px;
        height: 90px;
        background: linear-gradient(135deg, #f59e0b, #fcd34d);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 24px;
        box-shadow: 0 6px 20px rgba(245,158,11,0.35);
        animation: popIn 0.5s ease;
    }

    @keyframes popIn {
        0%   { transform: scale(0); opacity: 0; }
        80%  { transform: scale(1.1); }
        100% { transform: scale(1); opacity: 1; }
    }

    h1 {
        font-size: 1.8rem;
        font-weight: 800;
        color: #92400e;
        margin-bottom: 10px;
    }

    .subtitle {
        color: #666;
        font-size: 0.97rem;
        margin-bottom: 28px;
        line-height: 1.6;
    }

    .info-box {
        background: #fef3c7;
        border-radius: 12px;
        padding: 18px 22px;
        margin-bottom: 28px;
        text-align: left;
    }

    .info-box .row-item {
        display: flex;
        justify-content: space-between;
        padding: 6px 0;
        font-size: 0.9rem;
        border-bottom: 1px solid rgba(0,0,0,0.06);
    }

    .info-box .row-item:last-child { border-bottom: none; }
    .info-box .lbl { color: #555; }
    .info-box .val { font-weight: 700; color: #92400e; }

    .steps {
        background: #fffbeb;
        border: 1px solid #fcd34d;
        border-radius: 12px;
        padding: 16px 20px;
        text-align: left;
        margin-bottom: 28px;
        font-size: 0.88rem;
        color: #78350f;
    }

    .steps p { margin: 0 0 6px; font-weight: 700; }
    .steps ol { margin: 0; padding-left: 18px; }
    .steps li { margin-bottom: 4px; }

    .btn-checkout {
        display: inline-block;
        padding: 14px 36px;
        background: linear-gradient(135deg, #f59e0b, #fbbf24);
        color: white;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 700;
        font-size: 0.95rem;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(245,158,11,0.35);
    }

    .btn-checkout:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(245,158,11,0.4);
        color: white;
    }

    .btn-outline {
        display: inline-block;
        padding: 12px 28px;
        border: 2px solid #fcd34d;
        color: #92400e;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        margin-top: 12px;
        transition: all 0.3s;
    }

    .btn-outline:hover { background: #fef3c7; color: #78350f; }
</style>

<div class="result-wrapper">
    <div class="result-card">
        <div class="icon-circle">
            <svg width="44" height="44" fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>

        <h1>Menunggu Pembayaran ⏳</h1>
        <p class="subtitle">
            Pembayaran Anda sedang menunggu konfirmasi.<br>
            Silakan selesaikan pembayaran sesuai instruksi di bawah ini.
        </p>

        @if($pesanan)
        <div class="info-box">
            <div class="row-item">
                <span class="lbl">No. Pesanan</span>
                <span class="val">#{{ $pesanan->id }}</span>
            </div>
            <div class="row-item">
                <span class="lbl">Produk</span>
                <span class="val">{{ $pesanan->produk->nama ?? '-' }}</span>
            </div>
            <div class="row-item">
                <span class="lbl">Total Tagihan</span>
                <span class="val">{{ $pesanan->total_harga_formatted }}</span>
            </div>
            <div class="row-item">
                <span class="lbl">Order ID Midtrans</span>
                <span class="val">{{ $pesanan->midtrans_order_id }}</span>
            </div>
        </div>

        <div class="steps">
            <p>📌 Cara menyelesaikan pembayaran:</p>
            <ol>
                <li>Buka aplikasi banking / dompet digital Anda</li>
                <li>Masukkan kode/nomor pembayaran yang diberikan Midtrans</li>
                <li>Konfirmasi jumlah yang sesuai dengan tagihan</li>
                <li>Selesaikan transaksi sebelum waktu kedaluwarsa</li>
            </ol>
        </div>

        <a href="{{ route('payment.checkout', $pesanan->id) }}" class="btn-checkout">🔄 Coba Bayar Ulang</a>
        <br>
        @endif

        <a href="{{ route('pesanan.index') }}" class="btn-outline">📋 Lihat Semua Pesanan</a>
    </div>
</div>
@endsection
