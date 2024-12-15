@extends('layout')

@section('konten')

<div class="d-flex">
    <h4>List Game</h4>
    <form method="GET" action="{{ route('game.tampiluser') }}">
        <input type="text" name="search" value="{{ old('search', $search) }}" placeholder="Cari game..." />
        <button type="submit">Cari</button>
    </form>
</div>

<table class="table">
    <tr>
        <th>No</th>
        <th>Judul Game</th>
        <th>Genre Game</th>
        <th>Stok Game</th>
        <th>Aksi</th>
    </tr>
    @foreach ($game as $no => $data)
    <tr>
        <td>{{ $no + 1 }}</td>
        <td>{{ $data->judul }}</td>
        <td>{{ $data->genre }}</td>
        <td>{{ $data->stok }}</td>
        <td>
            @php
                 $peminjaman = $data->peminjaman->where('user_id', auth()->id())->first(); // Cek apakah user sudah meminjam game ini
            @endphp

            <!-- Jika belum dipinjam, tampilkan tombol Pinjam -->
            @if (!$peminjaman && $data->stok > 0)
            <form action="{{ route('game.pinjam', $data->id) }}" method="POST" style="display:inline-block;">
                @csrf
                <button type="submit" class="btn btn-primary">Pinjam</button>
            </form>
            @endif

            <!-- Jika sudah dipinjam, tampilkan tombol Kembalikan -->
            @if ($peminjaman)
                <form action="{{ route('game.kembalikan', $peminjaman->id_pinjam) }}" method="POST" style="display:inline-block;">
                    @csrf
                    <button type="submit" class="btn btn-warning">Kembalikan</button>
                </form>
            @endif

        </td>
    </tr>
    @endforeach
</table>

@endsection
