<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Jamur Beracun</title>
    <style>
        .grid-container { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px; padding: 20px; }
        .card { border: 1px solid #ddd; padding: 15px; border-radius: 8px; text-align: center; }
        .card img { max-width: 100%; height: 200px; object-fit: cover; border-radius: 5px; }
        .badge { padding: 5px 10px; border-radius: 15px; color: white; font-size: 12px; }
        .bg-poisonous { background-color: orange; }
        .bg-deadly { background-color: red; }
    </style>
</head>
<body>

    <h1 style="text-align: center;">Daftar Jamur Beracun & Mematikan</h1>

    <div class="grid-container">
        @forelse($mushrooms as $mushroom)
            <div class="card">
                @if(isset($mushroom['img']))
                    <img src="{{ $mushroom['img'] }}" alt="{{ $mushroom['name'] }}">
                @else
                    <div style="height: 200px; background: #eee; display:flex; align-items:center; justify-content:center;">No Image</div>
                @endif
                
                <h3>{{ $mushroom['name'] }}</h3>
                <p><strong>Nama Umum:</strong> {{ $mushroom['commonname'] ?? '-' }}</p>
                <p><strong>Agen Toksik:</strong> {{ $mushroom['agent'] ?? '-' }}</p>
                
                <span class="badge {{ strtolower($mushroom['type']) == 'deadly' ? 'bg-deadly' : 'bg-poisonous' }}">
                    {{ strtoupper($mushroom['type']) }}
                </span>
            </div>
        @empty
            <p>Tidak ada data jamur yang ditemukan atau API sedang bermasalah.</p>
        @endforelse
    </div>

</body>
</html>