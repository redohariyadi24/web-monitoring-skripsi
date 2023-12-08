<?php

namespace App\Http\Controllers;

use App\Models\Bab;
use App\Models\Bimbingan;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Skripsi;
use App\Models\Subbab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BimbinganMahasiswaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;

        // Fetch the latest bimbingan
        $bimbingans = $mahasiswa->bimbingans()->orderBy('created_at', 'desc')->get();

        // Separate the latest and the rest
        $terbaruBimbingan = $bimbingans->shift(); // Shift removes the first item from the collection
        $riwayatBimbingan = $bimbingans;

        return view('mahasiswa.bimbingan', [
            'user' => $user,
            'mahasiswa' => $mahasiswa,
            'terbaruBimbingan' => $terbaruBimbingan,
            'riwayatBimbingan' => $riwayatBimbingan,
        ]);
    }

    public function simpan(Request $request)
    {
        // Validate the form data
        $data = $request->validate([
            'nama' => 'required|string',
            'tanggal' => 'required|date',
            'mahasiswa_id' => 'required',
            'skripsi_id' => 'required',
            'dospem_nip' => 'required',
            'bab_id' => 'required',
            'subbab_id' => 'nullable',
        ]);

        $newBimbingan = Bimbingan::create($data);

        return redirect(route('bimbingan-mahasiswa'))->with('success', 'Bimbingan berhasil disimpan.');
    }
}
