<?php

namespace App\Http\Controllers;

use App\Models\Bab;
use App\Models\Mahasiswa;
use App\Models\Skripsi;
use App\Models\Subbab;
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
        $mahasiswa = $user->mahasiswa;

        $skripsi = $mahasiswa->skripsi;
        $dosen1 = $skripsi->dosen1;
        $dosen2 = $skripsi->dosen2;

        $jadwal = $skripsi->jadwal;

        // Fetch data for the form
        $babs = Bab::all();
        $subBabs = Subbab::with('bab')->get();

        $bimbingans = $mahasiswa->bimbingans()->orderBy('created_at', 'desc')->get();

        // Separate the latest and the rest
        $terbaruBimbingan = $bimbingans->shift();

        return view('mahasiswa.index', [
            'user' => $user,
            'mahasiswa' => $mahasiswa,
            'skripsi' => $skripsi,
            'dosen1' => $dosen1,
            'dosen2' => $dosen2,
            'jadwal' => $jadwal,
            'babs' => $babs,
            'subBabs' => $subBabs,
            'terbaruBimbingan' => $terbaruBimbingan,
        ])->with('layout', 'layout.layout-mahasiswa');
    }
    function dosen()
    {
        // Mendapatkan user yang sedang login
        $user = Auth::user();

        // Mendapatkan data dosen terkait dengan user
        $dosen = $user->dosen;

        // Mendapatkan skripsi yang memiliki salah satu dosen pembimbing sesuai dengan dosen yang sedang login
        $skripsis = Skripsi::whereHas('dosen1', function ($query) use ($dosen) {
            $query->where('id', $dosen->id);
        })
            ->orWhereHas('dosen2', function ($query) use ($dosen) {
                $query->where('id', $dosen->id);
            })
            ->with(['mahasiswa', 'dosen1', 'dosen2'])
            ->get();

        // Mengembalikan view dengan data yang diperbarui
        return view('dosen.index', [
            'user' => $user,
            'dosen' => $dosen,
            'skripsis' => $skripsis
        ])->with('layout', 'layout.layout-dosen');
    }
    function admin()
    {
        $user = Auth::user();
        $mahasiswajumlah= Mahasiswa::count();

        $skripsijumlah = Skripsi::count();
        $skripsiBelum = Skripsi::where('progres', '<', 100)->count();
        $skripsiSelesai = Skripsi::where('progres', 100)->count();

        $presentaseSkripsiSelesai = ($skripsijumlah - $skripsiBelum) / $skripsijumlah * 100;

        $skripsibelumJadwal =
                    Skripsi::where('progres', 100)
                    ->doesntHave('jadwal')
                    ->count();
        return view('admin.index', [
            'user' => $user,
            'skripsibelumJadwal' => $skripsibelumJadwal,
            'skripsiSelesai' => $skripsiSelesai,
            'skripsijumlah' => $skripsijumlah,
            'presentaseSkripsiSelesai' => $presentaseSkripsiSelesai,
            'mahasiswajumlah' => $mahasiswajumlah
        ])->with('layout', 'layout.admin-layout');
    }
}
