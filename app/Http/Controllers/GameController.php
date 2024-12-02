<?php

namespace App\Http\Controllers;

use App\Models\Game;
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

    function tampiluser(Request $request)
    {
        $search = $request->input('search'); // Ambil nilai pencarian dari input

        if ($search) {
            $game = Game::where('judul', 'like', '%' . $search . '%')->get(); // Pencarian game berdasarkan nama
        } else {
            $game = Game::all(); // Ambil semua game jika tidak ada pencarian
        }

        $game = Game::get();
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

    function beli($id)
    {
        // Cari game berdasarkan ID
        $game = Game::find($id);

        // Pastikan game ditemukan dan stok cukup untuk dibeli
        if (!$game || $game->stok <= 0) {
            return redirect()->route('game.tampiluser')->with('error', 'Stok game tidak cukup.');
        }

        // Kurangi stok game
        $game->stok -= 1;
        $game->save();

        // Redirect ke halaman tampilan user dengan pesan sukses
        return redirect()->route('game.tampiluser')->with('success', 'Game berhasil dibeli!');
        }
}
