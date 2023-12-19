<?php

namespace App\Http\Controllers;

use App\Models\Bab;
use App\Models\Bimbingan;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Skripsi;
use App\Models\Subbab;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
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
            $color = '#8592a3'; // Default color for 0
            if ($x > 0 && $x <= 50) {
                $color = '#ffab00'; // Yellow color for 1-50
            } elseif ($x >= 51 && $x <= 99) {
                $color = '#007bff'; // Blue color for 51-99
            } elseif ($x == 100) {
                $color = '#71dd37'; // Green color for 100
            }

            $outputData[] = [
                'x' => 'Progres ' . $x . '%',
                'y' => $y,
                'color' => $color, // Set color based on progress value
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
        if ($user->mahasiswa) {
            $mahasiswa = $user->mahasiswa;
            $skripsi = $mahasiswa->skripsi;
            $dosen1 = $skripsi->dosen1;
            $dosen2 = $skripsi->dosen2;
            $jadwals = $skripsi->jadwal;
            // dd($jadwal);
            $babs = Bab::all();
            $subBabs = Subbab::with('bab')->get();
            $bimbingans = $mahasiswa->bimbingans()->orderBy('created_at', 'desc')->get();
            $jumlahBimbingan = $bimbingans->count() + 1;
            $terbaruBimbingan = $bimbingans->shift();

            return view('mahasiswa.index', [
                'user' => $user,
                'mahasiswa' => $mahasiswa,
                'skripsi' => $skripsi,
                'dosen1' => $dosen1,
                'dosen2' => $dosen2,
                'jadwals' => $jadwals,
                'babs' => $babs,
                'subBabs' => $subBabs,
                'terbaruBimbingan' => $terbaruBimbingan,
                'bimbingans' => $jumlahBimbingan,
            ])->with('layout', 'layout.layout-mahasiswa');
        } else {
            $dosens = Dosen::all();

            return view('mahasiswa.registrasi.data-diri', [
                'user' => $user,
                'dosens' => $dosens,
            ]);
        }
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
            ->with(['mahasiswa', 'dosen1', 'dosen2', 'jadwal'])
            ->get();

        // Memisahkan skripsi menjadi dua kelompok: satu dengan jadwal dan satu tanpa jadwal
        $skripsiDenganJadwal = $skripsis->filter(function ($skripsi) {
            return $skripsi->jadwal->isNotEmpty();
        });

        $mahasiswajumlah = $skripsis->count();
        $skripsiSelesai = $skripsis->where('progres', 100)->count();

        // dd($skripsiDenganJadwal);


        // Mengembalikan view dengan data yang diperbarui
        return view('dosen.index', [
            'user' => $user,
            'dosen' => $dosen,
            'skripsis' => $skripsis,
            'mahasiswajumlah' => $mahasiswajumlah,
            'skripsiSelesai' => $skripsiSelesai,
            'skripsiDenganJadwal' => $skripsiDenganJadwal,
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

        if ($skripsijumlah != 0) {
            $presentaseSkripsiSelesai = ($skripsijumlah - $skripsiBelum) / $skripsijumlah * 100;
        } else {
            $presentaseSkripsiSelesai = 0;
        }

        $skripsibelumJadwal =
            Skripsi::where('progres', 100)
            ->doesntHave('jadwal')
            ->count();

        $skripsis = Skripsi::where('progres', 100)->with('jadwal', 'mahasiswa')->get();
        $skripsiTanpaSeminarHasil = $skripsis->filter(function ($skripsi) {
            return $skripsi->jadwal->where('jenis', 'Seminar Hasil')->count() === 0;
        });
        $skripsiTanpaSidangSkripsi = $skripsis->filter(function ($skripsi) {

            $jadwalSeminarHasil = $skripsi->jadwal->where('jenis', 'Seminar Hasil')->first();
            if ($jadwalSeminarHasil) {
                $tanggalSeminarHasilLewat = now()->gte($jadwalSeminarHasil->tanggal);
                return $tanggalSeminarHasilLewat;
            }
            return false;
        });
        $jumlahSkripsiTanpaSeminarHasil = $skripsiTanpaSeminarHasil->count();
        $jumlahSkripsiTanpaSidangSkripsi = $skripsiTanpaSidangSkripsi->count();

        return view('admin.index', [
            'user' => $user,
            'skripsibelumJadwal' => $skripsibelumJadwal,
            'skripsiSelesai' => $skripsiSelesai,
            'skripsijumlah' => $skripsijumlah,
            'presentaseSkripsiSelesai' => $presentaseSkripsiSelesai,
            'mahasiswajumlah' => $mahasiswajumlah,
            'jumlahSkripsiTanpaSeminarHasil' => $jumlahSkripsiTanpaSeminarHasil,
            'jumlahSkripsiTanpaSidangSkripsi' => $jumlahSkripsiTanpaSidangSkripsi,
        ])->with('layout', 'layout.admin-layout');
    }
}
