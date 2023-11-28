<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function index()
    {
        echo "Hallo user " . Auth::user()->name . ". <br>";
        echo "<a href='logout'>Logout</a>";
    }
    function mahasiswa()
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa; // Menggunakan relasi yang telah ditentukan

        $skripsi = $mahasiswa->skripsi;

        // Ambil data Dosen 1 dan Dosen 2
        $dosen1 = $skripsi->dosen1; // Asumsi ada relasi di model Skripsi dengan nama 'dosen1'
        $dosen2 = $skripsi->dosen2; // Asumsi ada relasi di model Skripsi dengan nama 'dosen2'

        $jadwal = $skripsi->jadwal;
        return view('mahasiswa.index', [
            'user' => $user,
            'mahasiswa' => $mahasiswa,
            'skripsi' => $skripsi,
            'dosen1' => $dosen1,
            'dosen2' => $dosen2,
            'jadwal' => $jadwal,
        ])->with('layout', 'layout.layout-mahasiswa');
    }
    function dosen()
    {
        $user = Auth::user();
        $dosen = $user->dosen; // Menggunakan relasi yang telah ditentukan

        return view('dosen.index', ['user' => $user, 'dosen' => $dosen])
            ->with('layout', 'layout.layout-dosen');
    }
    function admin()
    {
        $user = Auth::user();
        return view('admin.index', ['user' => $user])
            ->with('layout', 'layout.admin-layout');
    }
}
