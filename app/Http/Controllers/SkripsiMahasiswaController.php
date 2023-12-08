<?php

namespace App\Http\Controllers;

use App\Models\Bab;
use App\Models\Subbab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SkripsiMahasiswaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;
        $skripsi = $mahasiswa->skripsi;

        $dosen1 = $skripsi->dosen1;
        $dosen2 = $skripsi->dosen2;

        $jadwal = $skripsi->jadwal;

        // Ambil data dari tabel 'babs' dan 'subbabs'
        $babs = Bab::all();
        $subbabs = Subbab::all();

        return view('mahasiswa.skripsi', [
            'user' => $user,
            'mahasiswa' => $mahasiswa,
            'skripsi' => $skripsi,
            'dosen1' => $dosen1,
            'dosen2' => $dosen2,
            'jadwal' => $jadwal,
            'babs' => $babs,
            'subbabs' => $subbabs,
        ]);
    }
}
