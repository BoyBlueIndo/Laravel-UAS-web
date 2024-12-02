@extends('layout')

@section('konten')

    <div class="d-flex">
        <h4>List Game</h4>
        <div class="ms-auto">
            <a class="btn btn-success" href="{{ route('game.tambah') }}">Tambah Siswa</a>
        </div>
        <form method="GET" action="{{ route('game.tampil') }}">
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
                <a href="{{ route('game.edit', $data->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('game.delete', $data->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </td>
        </tr>  
        @endforeach
    </table>

@endsection