@extends('layouts.app')

@section('content')
<style>
    body { background: #f0f4f8; }

    .detail-wrapper {
        max-width: 680px;
        margin: 40px auto;
        padding: 0 16px;
        font-family: 'Segoe UI', sans-serif;
    }

    .detail-header {
        background: linear-gradient(135deg, #2d6a4f, #52b788);
        color: white;
        border-radius: 16px 16px 0 0;
        padding: 24px 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .detail-header h2 { font-size: 1.4rem; font-weight: 700; margin: 0; }
    .detail-header p { margin: 4px 0 0; font-size: 0.85rem; opacity: 0.85; }

    .detail-body {
        background: white;
        border-radius: 0 0 16px 16px;
        padding: 30px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.10);
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding: 12px 0;
        border-bottom: 1px solid #f0f0f0;
        font-size: 0.95rem;
    }

    .info-row:last-of-type { border-bottom: none; }
    .info-label { color: #888; width: 40%; }
    .info-value { font-weight: 600; color: #222; text-align: right; width: 58%; }

    .total-box {
        background: #d8f3dc;
        border-radius: 12px;
        padding: 16px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 20px 0;
    }

    .total-box .lbl { font-weight: 700; color: #2d6a4f; }
    .total-box .val { font-size: 1.3rem; font-weight: 800; color: #1b4332; }

    .badge-status {
        display: inline-block;
        padding: 4px 14px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    /* Tombol Bayar */
    .pay-btn {
        display: block;
        width: 100%;
        padding: 15px;
        text-align: center;
        background: linear-gradient(135deg, #2d6a4f, #52b788);
        color: white !important;
        border-radius: 12px;
        font-weight: 700;
        font-size: 1rem;
        text-decoration: none;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(45,106,79,0.4);
        margin-bottom: 12px;
        letter-spacing: 0.3px;
    }

    .pay-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(45,106,79,0.5);
    }

    .paid-badge {
        display: block;
        width: 100%;
        padding: 14px;
        text-align: center;
        background: #d8f3dc;
        color: #1b4332;
        border-radius: 12px;
        font-weight: 700;
        font-size: 1rem;
        margin-bottom: 12px;
    }

    .action-row {
        display: flex;
        gap: 10px;
        margin-top: 4px;
    }

    .btn-back {
        flex: 1;
        padding: 11px;
        text-align: center;
        border: 2px solid #52b788;
        color: #2d6a4f;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        transition: 0.2s;
    }

    .btn-back:hover { background: #d8f3dc; }

    .btn-edit {
        flex: 1;
        padding: 11px;
        text-align: center;
        background: #f8f9fa;
        color: #444;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        border: 1px solid #dee2e6;
        transition: 0.2s;
    }

    .btn-edit:hover { background: #e9ecef; }
</style>

<div class="detail-wrapper">
    <div class="detail-header">
        <div>
            <h2>📦 Detail Pesanan #{{ $pesanan->id }}</h2>
            <p>Dibuat: {{ $pesanan->created_at->format('d M Y, H:i') }}</p>
        </div>
        <span class="{{ $pesanan->payment_status_badge }} badge-status">
            {{ $pesanan->payment_status_label }}
        </span>
    </div>

    <div class="detail-body">
        <div class="info-row">
            <span class="info-label">👤 Pelanggan</span>
            <span class="info-value">{{ $pesanan->user->name ?? '-' }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">🍄 Produk</span>
            <span class="info-value">{{ $pesanan->produk->nama ?? '-' }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">📦 Jumlah</span>
            <span class="info-value">{{ $pesanan->jumlah }} pcs</span>
        </div>
        <div class="info-row">
            <span class="info-label">📍 Alamat Pengiriman</span>
            <span class="info-value">{{ $pesanan->alamat_pengiriman }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">📋 Status Pesanan</span>
            <span class="info-value">{{ ucfirst($pesanan->status) }}</span>
        </div>

        @if($pesanan->midtrans_order_id)
        <div class="info-row">
            <span class="info-label">🔖 ID Transaksi</span>
            <span class="info-value" style="font-size:0.85rem;color:#666;">{{ $pesanan->midtrans_order_id }}</span>
        </div>
        @endif

        <!-- Total -->
        <div class="total-box">
            <span class="lbl">💰 Total Pembayaran</span>
            <span class="val">{{ $pesanan->total_harga_formatted }}</span>
        </div>

        <!-- Tombol Bayar / Sudah Lunas -->
        @if(in_array($pesanan->payment_status, ['settlement', 'capture']))
            <div class="paid-badge">✅ Pembayaran Lunas</div>
        @else
            <a href="{{ route('payment.checkout', $pesanan->id) }}" class="pay-btn">
                💳 Bayar Sekarang
            </a>
        @endif

        <!-- Aksi Lain -->
        <div class="action-row">
            <a href="{{ route('pesanan.index') }}" class="btn-back">← Kembali</a>
            <a href="{{ route('pesanan.edit', $pesanan->id) }}" class="btn-edit">✏️ Edit Pesanan</a>
        </div>
    </div>
</div>
@endsection