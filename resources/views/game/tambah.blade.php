@extends('layout')

@section('konten')
    
    <h4>Tambah Game</h4>

    <form action="{{ route('game.submit') }}" method="post">
        @csrf
        <label>Judul Game:</label>
        <input type="text" name="judul" class="form-control mb-2">

        <label>Genre Game:</label>
        <input type="text" name="genre" class="form-control mb-2">

        <label>Stok Game:</label>
        <input type="number" name="stok" class="form-control mb-2">

        <button class="btn btn-primary">Tambah</button>
    </form>

@endsection