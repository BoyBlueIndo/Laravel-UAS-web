<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    function tampil(Request $request)
    {
        $search = $request->input('search'); // Ambil nilai pencarian dari input

        if ($search) {
            $game = Game::where('judul', 'like', '%' . $search . '%')->get(); // Pencarian game berdasarkan nama
        } else {
            $game = Game::all(); // Ambil semua game jika tidak ada pencarian
        }

        $game = Game::get();
        return view('game.tampil', compact('game', 'search'));
    }

    public function tampiluser(Request $request)
{
    $search = $request->input('search');
    $game = Game::with('peminjaman') // Muat relasi peminjaman
        ->when($search, function ($query, $search) {
            $query->where('judul', 'like', "%{$search}%");
        })
        ->get();

    return view('game.tampiluser', compact('game', 'search'));
}


    function tambah()
    {
        return view('game.tambah');
    }

    function submit(Request $request)
    {
        $game = new Game();
        $game->judul = $request->judul;
        $game->genre = $request->genre;
        $game->stok = $request->stok;
        $game->save();

        return redirect()->route('game.tampil');
    }

    function edit($id)
    {
        if (Auth::check()) { 
            $game = Game::find($id);
            return view('game.edit', compact('game'));
        } else {
            dd('User is not authenticated.');
        }
    }

    function update(Request $request, $id)
    {
        $game = Game::find($id);
        $game->judul = $request->judul;
        $game->genre = $request->genre;
        $game->stok = $request->stok;
        $game->update();
        
        return redirect()->route('game.tampil');
    }

    function delete($id)
    {
        $game = Game::find($id);
        $game->delete();

        return redirect()->route('game.tampil');
    }

    // function beli($id)
    // {
    //     // Cari game berdasarkan ID
    //     $game = Game::find($id);

    //     // Pastikan game ditemukan dan stok cukup untuk dibeli
    //     if (!$game || $game->stok <= 0) {
    //         return redirect()->route('game.tampiluser')->with('error', 'Stok game tidak cukup.');
    //     }

    //     // Kurangi stok game
    //     $game->stok -= 1;
    //     $game->save();

    //     // Redirect ke halaman tampilan user dengan pesan sukses
    //     return redirect()->route('game.tampiluser')->with('success', 'Game berhasil dibeli!');
    // }

    public function pinjam(Request $request, $gameId)
{
    $userId = Auth::id();

    // Pastikan kolom di query sesuai dengan tabel
    $existingPeminjaman = Peminjaman::where('user_id', $userId)
        ->where('game_id', $gameId)
        ->first();

    if ($existingPeminjaman) {
        return redirect()->back()->with('error', 'Anda sudah meminjam game ini.');
    }

    $game = Game::findOrFail($gameId);
    if ($game->stok <= 0) {
        return redirect()->back()->with('error', 'Stok game habis.');
    }

    // Proses peminjaman
    Peminjaman::create([
        'user_id' => $userId,
        'game_id' => $gameId,
    ]);

    // Kurangi stok game
    $game->stok -= 1;
    $game->save();

    return redirect()->back()->with('success', 'Game berhasil dipinjam.');
}


public function kembalikan($peminjamanId)
{
    // Temukan peminjaman berdasarkan id_pinjam
    $peminjaman = Peminjaman::findOrFail($peminjamanId);

    // Pastikan hanya user yang meminjam atau admin yang bisa mengembalikan
    if (Auth::id() !== $peminjaman->user_id && Auth::user()->role !== 'admin') {
        abort(403, 'Unauthorized action.');
    }

    // Mengembalikan stok game
    $game = $peminjaman->game;
    $game->stok += 1;
    $game->save();

    // Hapus peminjaman
    $peminjaman->delete();

    return redirect()->route('game.tampiluser')->with('success', 'Game berhasil dikembalikan.');
}
}
