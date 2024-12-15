<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/registrasi', [AuthController::class, 'tampilRegistrasi'])->name('registrasi.tampil');
Route::post('/registrasi/submit', [AuthController::class, 'submitRegistrasi'])->name('registrasi.submit');

Route::get('/login', [AuthController::class, 'tampilLogin'])->name('login');
Route::post('/login/submit', [AuthController::class, 'submitLogin'])->name('login.submit');

// Route::middleware('guest')->group(function () {

// });

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/game', [GameController::class, 'tampil'])->name('game.tampil');
    Route::get('/game/tambah', [GameController::class, 'tambah'])->name('game.tambah');
    Route::post('/siswa/submit', [GameController::class, 'submit'])->name('game.submit');
    Route::get('/game/edit/{id}', [GameController::class, 'edit'])->name('game.edit');
    Route::post('/game/update/{id}', [GameController::class, 'update'])->name('game.update');
    Route::post('/game/delete/{id}', [GameController::class, 'delete'])->name('game.delete');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/gameuser', [GameController::class, 'tampiluser'])->name('game.tampiluser');
    Route::post('/game/beli/{id}', [GameController::class, 'beli'])->name('game.beli');
    Route::post('/game/pinjam/{id}', [GameController::class, 'pinjam'])->name('game.pinjam');
    Route::post('/game/kembalikan/{id}', [GameController::class, 'kembalikan'])->name('game.kembalikan');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');