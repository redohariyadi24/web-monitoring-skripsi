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

        $babs = Bab::all();
        $subbabs = Subbab::all();

        $bimbingans = $mahasiswa->bimbingans;
        $accs = $mahasiswa->bimbingans()->where('status', 'acc')->get();



        $babColors = $this->determineBabColors($babs, $subbabs, $bimbingans);

        // dd( $accs);

        // Pass warna ke view
        return view('mahasiswa.skripsi', [
            'user' => $user,
            'mahasiswa' => $mahasiswa,
            'skripsi' => $skripsi,
            'dosen1' => $dosen1,
            'dosen2' => $dosen2,
            'bimbingans' => $bimbingans,
            'babs' => $babs,
            'accs' => $accs,
            'subbabs' => $subbabs,
            'babColors' => $babColors,
        ]);
    }

    private function determineBabColors($babs, $subbabs, $bimbingans)
    {
        $babColors = [];

        foreach ($babs as $bab) {
            $subbabColors = [];

            foreach ($subbabs->where('bab_id', $bab->id) as $subbab) {
                $subbabStatus = $bimbingans
                    ->where('subbab_id', $subbab->id)
                    ->where('status', 'acc')
                    ->count();

                // Tentukan warna berdasarkan status
                $subbabColor = $subbabStatus == 2 ? '#71dd37' : ($subbabStatus == 1 ? '#007bff' : '');

                $subbabColors[$subbab->id] = $subbabColor;
            }

            $babStatus = $bimbingans
                ->where('bab_id', $bab->id)
                ->where('status', 'acc')
                ->count();

            // Tentukan warna berdasarkan status
            $babColor = $babStatus == 2 ? '#71dd37' : ($babStatus == 1 ? '#007bff' : '');

            $babColors[$bab->id] = [
                'babColor' => $babColor,
                'subbabColors' => $subbabColors,
            ];
        }

        return $babColors;
    }

}
