<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as Auth;

class AuthController extends Controller
{
    function tampilRegistrasi()
    {
        return view('registrasi');
    }

    function submitRegistrasi(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        // dd($user);
        return redirect()->route('login');
    }

    function tampilLogin()
    {
        return view('login');
    }

    function submitLogin(Request $request)
    {
        $data = $request->only('email', 'password');

        if (Auth::attempt($data)) 
        {
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('game.tampil');
            } elseif ($user->role === 'user') {
                return redirect()->route('game.tampiluser');
            }
        }
        else
        {
            return redirect()->back()->with('Gagal', 'Coba lagi masukkan Email dan Password yang benar!');
        }
    }

    function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
