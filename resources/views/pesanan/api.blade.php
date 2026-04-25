@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Data Jamur dari API</h1>

    @if(!empty($data))
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Stok</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item['nama'] ?? '-' }}</td>
                    <td>{{ $item['harga'] ?? '-' }}</td>
                    <td>{{ $item['stok'] ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Tidak ada data.</p>
    @endif
</div>
@endsection