<?php

namespace App\Http\Controllers;

use App\Models\Bab;
use App\Models\Bimbingan;
use App\Models\Mahasiswa;
use App\Models\Skripsi;
use App\Models\Subbab;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function landingpage()
    {
        $progres = Skripsi::orderby('progres', 'desc')->get();
        $result = $progres->groupBy('progres')
            ->map(function ($group) {
                return $group->count();
            });
        $outputData = [];

        foreach ($result as $x => $y) {
            $outputData[] = [
                'x' => 'Progres ' . $x . '%', // Assuming you want categories labeled A, B, C, etc.
                'y' => $y,
            ];
        }

        // echo json_encode(['data' => $outputData], JSON_PRETTY_PRINT);
        // dd($outputData);
        // dd($proges);
        return view('landing-page', ['result' => $outputData]);
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
        $jumlahBimbingan = $bimbingans->count() + 1;
        // Separate the latest and the rest
        // dd($jumlahBimbingan);
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
            'bimbingans' => $jumlahBimbingan,
        ])->with('layout', 'layout.layout-mahasiswa');
    }

    function dosen()
    {
        // Mendapatkan user yang sedang login
        $user = Auth::user();

        // Mendapatkan data dosen terkait dengan user
        $dosen = $user->dosen;

        // Ambil bimbingan yang sedang menunggu konfirmasi
        $bimbingans = Bimbingan::where('dospem_id', $dosen->id)
            ->where('status', 'menunggu konfirmasi')
            ->get();

        // menghitung jumlah bimbingan yang sedang menunggu konfirmasi
        $notif = $bimbingans->count();


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
            'skripsis' => $skripsis,
            'notif' => $notif,
        ])->with('layout', 'layout.layout-dosen');
    }
    function admin()
    {
        $user = Auth::user();
        $mahasiswajumlah = Mahasiswa::count();

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
