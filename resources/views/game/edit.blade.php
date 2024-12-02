@extends('layout')

@section('konten')
    
    <h4>Edit Game</h4>

    <form action="{{ route('game.update', $game->id) }}" method="post">
        @csrf
        <label>Judul Game:</label>
        <input type="text" name="judul" value="{{ $game->judul }}" class="form-control mb-2">

        <label>Genre Game:</label>
        <input type="text" name="genre" value="{{ $game->genre }}" class="form-control mb-2">

        <label>Stok Game:</label>
        <input type="number" name="stok" value="{{ $game->stok }}" class="form-control mb-2">

        <button class="btn btn-primary">Edit</button>
    </form>

@endsection