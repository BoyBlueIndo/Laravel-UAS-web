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
        @foreach ($game as $no=>$data)
        <tr>
            <td>{{ $no+1 }}</td>
            <td>{{ $data->judul }}</td>
            <td>{{ $data->genre }}</td>
            <td>{{ $data->stok }}</td>
            <td>
                 <!-- Form untuk membeli game -->
                <form action="{{ route('game.beli', $data->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Beli</button>
                </form>
            </td>
        </tr>  
        @endforeach
    </table>

@endsection