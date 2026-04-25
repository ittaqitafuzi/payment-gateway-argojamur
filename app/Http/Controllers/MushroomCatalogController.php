<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MushroomApiService;

class MushroomCatalogController extends Controller
{
    protected $mushroomService;

    // Inject service ke dalam controller
    public function __construct(MushroomApiService $mushroomService)
    {
        $this->mushroomService = $mushroomService;
    }

    public function index()
    {
        // Ambil semua data jamur dari API
        $mushrooms = $this->mushroomService->getAllMushrooms();

        // Kirim data ke view
        return view('mushrooms.index', compact('mushrooms'));
    }

    public function type($type)
    {
        // Ambil data jamur berdasarkan tipe
        $mushrooms = $this->mushroomService->getMushroomsByType($type);

        // Kirim data ke view
        return view('mushrooms.index', compact('mushrooms'));
    }
}

