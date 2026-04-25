<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Midtrans Configuration
    |--------------------------------------------------------------------------
    | Konfigurasi kunci Midtrans. Isi nilai pada file .env Anda.
    | Untuk sandbox (testing), gunakan kunci dari https://sandbox.midtrans.com
    | Untuk production, gunakan kunci dari https://dashboard.midtrans.com
    */

    'server_key'    => env('MIDTRANS_SERVER_KEY', ''),
    'client_key'    => env('MIDTRANS_CLIENT_KEY', ''),
    'merchant_id'   => env('MIDTRANS_MERCHANT_ID', ''),
    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),
    'is_sanitized'  => true,
    'is_3ds'        => true,
];
