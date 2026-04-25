<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';

    protected $fillable = [
        'user_id',
        'produk_id',
        'jumlah',
        'total_harga',
        'status',
        'alamat_pengiriman',
        'snap_token',
        'payment_url',
        'midtrans_order_id',
        'payment_status',
    ];

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Produk
     */
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }

    /**
     * Accessor untuk format total harga
     */
    public function getTotalHargaFormattedAttribute()
    {
        return 'Rp ' . number_format($this->total_harga, 0, ',', '.');
    }

    /**
     * Accessor label status pembayaran
     */
    public function getPaymentStatusLabelAttribute()
    {
        return match ($this->payment_status) {
            'belum_bayar' => 'Belum Bayar',
            'pending'     => 'Menunggu Pembayaran',
            'settlement'  => 'Lunas',
            'capture'     => 'Lunas',
            'deny'        => 'Ditolak',
            'cancel'      => 'Dibatalkan',
            'expire'      => 'Kedaluwarsa',
            'failure'     => 'Gagal',
            default       => 'Tidak Diketahui',
        };
    }

    /**
     * Accessor badge class status pembayaran
     */
    public function getPaymentStatusBadgeAttribute()
    {
        return match ($this->payment_status) {
            'settlement', 'capture' => 'badge bg-success',
            'pending'               => 'badge bg-warning text-dark',
            'deny', 'cancel',
            'expire', 'failure'     => 'badge bg-danger',
            default                 => 'badge bg-secondary',
        };
    }
}
