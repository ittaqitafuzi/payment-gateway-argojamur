@extends('layouts.app')

@section('content')
<style>
    body { background: #f0f4f8; }

    .checkout-wrapper {
        max-width: 820px;
        margin: 40px auto;
        padding: 0 16px;
        font-family: 'Segoe UI', sans-serif;
    }

    .checkout-header {
        background: linear-gradient(135deg, #2d6a4f, #52b788);
        color: white;
        border-radius: 16px 16px 0 0;
        padding: 28px 32px;
    }

    .checkout-header h2 {
        font-size: 1.6rem;
        font-weight: 700;
        margin: 0;
    }

    .checkout-header p {
        margin: 4px 0 0;
        opacity: 0.85;
        font-size: 0.9rem;
    }

    .checkout-body {
        background: white;
        border-radius: 0 0 16px 16px;
        padding: 32px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.10);
    }

    .order-summary-title {
        font-weight: 700;
        font-size: 1rem;
        color: #2d6a4f;
        border-bottom: 2px solid #d8f3dc;
        padding-bottom: 8px;
        margin-bottom: 20px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid #f0f0f0;
        font-size: 0.95rem;
        color: #444;
    }

    .summary-row:last-child { border-bottom: none; }

    .summary-label { color: #888; }

    .summary-value { font-weight: 600; color: #222; }

    .total-row {
        background: #d8f3dc;
        border-radius: 10px;
        padding: 14px 18px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 16px;
    }

    .total-label { font-weight: 700; color: #2d6a4f; font-size: 1rem; }
    .total-value { font-weight: 800; color: #1b4332; font-size: 1.3rem; }

    .status-badge {
        display: inline-block;
        padding: 4px 14px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .pay-btn {
        width: 100%;
        padding: 16px;
        font-size: 1.1rem;
        font-weight: 700;
        background: linear-gradient(135deg, #2d6a4f, #52b788);
        color: white;
        border: none;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(45,106,79,0.4);
        margin-top: 28px;
        letter-spacing: 0.5px;
    }

    .pay-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(45,106,79,0.5);
    }

    .pay-btn:active { transform: translateY(0); }

    .back-link {
        display: block;
        text-align: center;
        margin-top: 16px;
        color: #52b788;
        font-size: 0.9rem;
        text-decoration: none;
    }

    .back-link:hover { text-decoration: underline; }

    .security-note {
        display: flex;
        align-items: center;
        gap: 8px;
        background: #f8f9fa;
        border-radius: 10px;
        padding: 12px 16px;
        margin-top: 20px;
        font-size: 0.82rem;
        color: #666;
    }

    .security-note svg { flex-shrink: 0; }

    .midtrans-logo {
        text-align: center;
        margin-top: 20px;
        opacity: 0.6;
        font-size: 0.75rem;
        color: #aaa;
    }
</style>

<div class="checkout-wrapper">
    <!-- Header -->
    <div class="checkout-header">
        <h2>🛒 Konfirmasi Pembayaran</h2>
        <p>Pesanan #{{ $pesanan->id }} — Selesaikan pembayaran Anda</p>
    </div>

    <!-- Body -->
    <div class="checkout-body">

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Ringkasan Pesanan -->
        <div class="order-summary-title">📋 Ringkasan Pesanan</div>

        <div class="summary-row">
            <span class="summary-label">Produk</span>
            <span class="summary-value">{{ $pesanan->produk->nama ?? '-' }}</span>
        </div>
        <div class="summary-row">
            <span class="summary-label">Jumlah</span>
            <span class="summary-value">{{ $pesanan->jumlah }} pcs</span>
        </div>
        <div class="summary-row">
            <span class="summary-label">Harga Satuan</span>
            <span class="summary-value">Rp {{ number_format($pesanan->produk->harga ?? 0, 0, ',', '.') }}</span>
        </div>
        <div class="summary-row">
            <span class="summary-label">Alamat Pengiriman</span>
            <span class="summary-value" style="max-width:60%;text-align:right;">{{ $pesanan->alamat_pengiriman }}</span>
        </div>
        <div class="summary-row">
            <span class="summary-label">Status Pesanan</span>
            <span class="{{ $pesanan->payment_status_badge }} status-badge">{{ $pesanan->payment_status_label }}</span>
        </div>

        <!-- Total -->
        <div class="total-row">
            <span class="total-label">Total Pembayaran</span>
            <span class="total-value">{{ $pesanan->total_harga_formatted }}</span>
        </div>

        <!-- Tombol Bayar -->
        <button id="pay-button" class="pay-btn">
            💳 Bayar Sekarang
        </button>

        <a href="{{ route('pesanan.show', $pesanan->id) }}" class="back-link">← Kembali ke Detail Pesanan</a>

        <!-- Keamanan -->
        <div class="security-note">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#52b788" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
            </svg>
            Pembayaran Anda diproses secara aman oleh <strong>&nbsp;Midtrans</strong>. Data Anda terenkripsi dan terlindungi.
        </div>

        <div class="midtrans-logo">Powered by Midtrans Payment Gateway</div>
    </div>
</div>

<!-- Midtrans Snap.js -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>

<script>
    const snapToken = "{{ $pesanan->snap_token }}";

    document.getElementById('pay-button').addEventListener('click', function () {
        window.snap.pay(snapToken, {
            onSuccess: function(result) {
                console.log('Sukses:', result);
                window.location.href = "{{ route('payment.success') }}?order_id=" + result.order_id;
            },
            onPending: function(result) {
                console.log('Pending:', result);
                window.location.href = "{{ route('payment.pending') }}?order_id=" + result.order_id;
            },
            onError: function(result) {
                console.log('Error:', result);
                window.location.href = "{{ route('payment.failed') }}?order_id=" + result.order_id;
            },
            onClose: function() {
                alert('Anda menutup popup pembayaran tanpa menyelesaikan transaksi.');
            }
        });
    });
</script>
@endsection
