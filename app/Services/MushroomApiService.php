<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class MushroomApiService
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = env('MUSHROOM_API_URL', 'https://toxicshrooms.vercel.app');
    }

    // Mengambil semua data jamur
    public function getAllMushrooms()
    {
        $response = Http::get("{$this->baseUrl}/api/mushrooms");
        
        if ($response->successful()) {
            return $response->json();
        }

        return [];
    }

    // Mengambil data berdasarkan tipe (poisonous / deadly)
    public function getMushroomsByType($type)
    {
        $response = Http::get("{$this->baseUrl}/api/mushrooms/{$type}");
        
        if ($response->successful()) {
            return $response->json();
        }

        return [];
    }

    // Mengambil satu jamur acak
    public function getRandomMushroom()
    {
        $response = Http::get("{$this->baseUrl}/api/mushrooms/randomshroom");
        
        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }
}