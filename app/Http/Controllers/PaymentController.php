<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;

class PaymentController extends Controller
{
    public function __construct()
    {
        // Setup konfigurasi Midtrans
        Config::$serverKey    = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized  = config('midtrans.is_sanitized');
        Config::$is3ds        = config('midtrans.is_3ds');
    }

    /**
     * Halaman checkout — tampilkan detail pesanan dan tombol bayar
     */
    public function checkout($id)
    {
        $pesanan = Pesanan::with(['produk', 'user'])->findOrFail($id);

        // Buat snap token jika belum ada
        if (!$pesanan->snap_token) {
            $orderId = 'AGROJAMUR-' . $pesanan->id . '-' . time();

            $params = [
                'transaction_details' => [
                    'order_id'     => $orderId,
                    'gross_amount' => (int) $pesanan->total_harga,
                ],
                'customer_details' => [
                    'first_name' => $pesanan->user->name ?? 'Customer',
                    'email'      => $pesanan->user->email ?? 'customer@agrojamur.com',
                ],
                'item_details' => [
                    [
                        'id'       => $pesanan->produk_id,
                        'price'    => (int) $pesanan->produk->harga,
                        'quantity' => (int) $pesanan->jumlah,
                        'name'     => $pesanan->produk->nama,
                    ]
                ],
            ];

            try {
                $snapToken = Snap::getSnapToken($params);

                $pesanan->update([
                    'snap_token'         => $snapToken,
                    'midtrans_order_id'  => $orderId,
                    'payment_status'     => 'pending',
                ]);
            } catch (\Exception $e) {
                Log::error('Midtrans Error: ' . $e->getMessage());
                return redirect()->route('pesanan.show', $pesanan->id)
                    ->with('error', 'Gagal membuat sesi pembayaran: ' . $e->getMessage());
            }
        }

        return view('payment.checkout', compact('pesanan'));
    }

    /**
     * Halaman sukses pembayaran (redirect dari Midtrans)
     */
    public function success(Request $request)
    {
        $orderId = $request->query('order_id');
        $pesanan = Pesanan::where('midtrans_order_id', $orderId)->first();

        if ($pesanan) {
            $pesanan->update([
                'payment_status' => 'settlement',
                'status'         => 'konfirmasi',
            ]);
        }

        return view('payment.success', compact('pesanan'));
    }

    /**
     * Halaman pending pembayaran (redirect dari Midtrans)
     */
    public function pending(Request $request)
    {
        $orderId = $request->query('order_id');
        $pesanan = Pesanan::where('midtrans_order_id', $orderId)->first();

        if ($pesanan) {
            $pesanan->update(['payment_status' => 'pending']);
        }

        return view('payment.pending', compact('pesanan'));
    }

    /**
     * Halaman gagal/batal pembayaran (redirect dari Midtrans)
     */
    public function failed(Request $request)
    {
        $orderId = $request->query('order_id');
        $pesanan = Pesanan::where('midtrans_order_id', $orderId)->first();

        if ($pesanan) {
            $pesanan->update([
                'payment_status' => 'failure',
                'status'         => 'dibatalkan',
            ]);
        }

        return view('payment.failed', compact('pesanan'));
    }

    /**
     * Webhook / Notification dari Midtrans (server-to-server)
     */
    public function notification(Request $request)
    {
        try {
            $notification = new Notification();

            $orderId           = $notification->order_id;
            $transactionStatus = $notification->transaction_status;
            $fraudStatus       = $notification->fraud_status;
            $paymentType       = $notification->payment_type;

            Log::info('Midtrans Notification', [
                'order_id'           => $orderId,
                'transaction_status' => $transactionStatus,
                'fraud_status'       => $fraudStatus,
            ]);

            $pesanan = Pesanan::where('midtrans_order_id', $orderId)->first();

            if (!$pesanan) {
                return response()->json(['message' => 'Pesanan tidak ditemukan'], 404);
            }

            // Tentukan status pembayaran berdasarkan notifikasi Midtrans
            if ($transactionStatus == 'capture') {
                if ($fraudStatus == 'challenge') {
                    $pesanan->payment_status = 'pending';
                } else if ($fraudStatus == 'accept') {
                    $pesanan->payment_status = 'capture';
                    $pesanan->status = 'konfirmasi';
                }
            } else if ($transactionStatus == 'settlement') {
                $pesanan->payment_status = 'settlement';
                $pesanan->status = 'konfirmasi';
            } else if ($transactionStatus == 'pending') {
                $pesanan->payment_status = 'pending';
            } else if ($transactionStatus == 'deny') {
                $pesanan->payment_status = 'deny';
            } else if ($transactionStatus == 'expire') {
                $pesanan->payment_status = 'expire';
                $pesanan->status = 'dibatalkan';
            } else if ($transactionStatus == 'cancel') {
                $pesanan->payment_status = 'cancel';
                $pesanan->status = 'dibatalkan';
            }

            $pesanan->save();

            return response()->json(['message' => 'Notifikasi berhasil diproses']);

        } catch (\Exception $e) {
            Log::error('Midtrans Notification Error: ' . $e->getMessage());
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }
}
