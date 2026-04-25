@extends('layouts.app')

@section('content')
<style>
    body { background: #f0f7f4; }

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
        background: linear-gradient(135deg, #2d6a4f, #52b788);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 24px;
        box-shadow: 0 6px 20px rgba(45,106,79,0.35);
        animation: popIn 0.5s ease;
    }

    @keyframes popIn {
        0%   { transform: scale(0); opacity: 0; }
        80%  { transform: scale(1.1); }
        100% { transform: scale(1); opacity: 1; }
    }

    .icon-circle svg { width: 44px; height: 44px; color: white; }

    h1 {
        font-size: 1.8rem;
        font-weight: 800;
        color: #1b4332;
        margin-bottom: 10px;
    }

    .subtitle {
        color: #666;
        font-size: 0.97rem;
        margin-bottom: 28px;
        line-height: 1.6;
    }

    .info-box {
        background: #d8f3dc;
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
    .info-box .val { font-weight: 700; color: #1b4332; }

    .btn-home {
        display: inline-block;
        padding: 14px 36px;
        background: linear-gradient(135deg, #2d6a4f, #52b788);
        color: white;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 700;
        font-size: 0.95rem;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(45,106,79,0.35);
    }

    .btn-home:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(45,106,79,0.4);
        color: white;
    }

    .btn-outline {
        display: inline-block;
        padding: 12px 28px;
        border: 2px solid #52b788;
        color: #2d6a4f;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        margin-top: 12px;
        transition: all 0.3s;
    }

    .btn-outline:hover {
        background: #d8f3dc;
        color: #1b4332;
    }
</style>

<div class="result-wrapper">
    <div class="result-card">
        <!-- Ikon centang -->
        <div class="icon-circle">
            <svg fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
        </div>

        <h1>Pembayaran Berhasil! 🎉</h1>
        <p class="subtitle">
            Terima kasih! Pembayaran Anda telah kami terima.<br>
            Pesanan Anda sedang kami proses dan akan segera dikirimkan.
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
                <span class="lbl">Total Bayar</span>
                <span class="val">{{ $pesanan->total_harga_formatted }}</span>
            </div>
            <div class="row-item">
                <span class="lbl">Status</span>
                <span class="val">✅ Lunas</span>
            </div>
        </div>
        @endif

        <a href="{{ url('/') }}" class="btn-home">🏠 Kembali ke Beranda</a>
        <br>
        <a href="{{ route('pesanan.index') }}" class="btn-outline">📋 Lihat Semua Pesanan</a>
    </div>
</div>
@endsection
