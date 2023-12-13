<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiController extends Controller
{
    function index()
    {
        return view('login');
    }

    function login(Request $request)
    {
        $request->validate(
            [
                'username' => 'required',
                'password' => 'required',
            ]
        );

        $infoLogin = [
            'username' => $request->username,
            'password' => $request->password
        ];

        if (Auth::attempt($infoLogin)) {
            if (Auth::user()->role == 'mahasiswa') {
                return redirect(route('dashboard-mahasiswa'));
            } elseif (Auth::user()->role == 'dosen') {
                return redirect(route('dashboard-dosen'));
            } elseif (Auth::user()->role == 'admin') {
                return redirect(route('dashboard-admin'));
            }
        } else {
            return redirect('login')->withErrors('Username dan Password yang dimasukkan tidak sesuai')->withInput();
        }
    }

    function logout()
    {
        Auth::logout();
        return redirect(route('landing-page'));
    }
}
