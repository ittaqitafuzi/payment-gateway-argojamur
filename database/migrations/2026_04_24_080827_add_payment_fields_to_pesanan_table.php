<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pesanan', function (Blueprint $table) {
            $table->string('snap_token')->nullable()->after('alamat_pengiriman');
            $table->string('payment_url')->nullable()->after('snap_token');
            $table->string('midtrans_order_id')->nullable()->unique()->after('payment_url');
            $table->enum('payment_status', ['belum_bayar', 'pending', 'settlement', 'capture', 'deny', 'cancel', 'expire', 'failure'])
                  ->default('belum_bayar')->after('midtrans_order_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pesanan', function (Blueprint $table) {
            $table->dropColumn(['snap_token', 'payment_url', 'midtrans_order_id', 'payment_status']);
        });
    }
};
