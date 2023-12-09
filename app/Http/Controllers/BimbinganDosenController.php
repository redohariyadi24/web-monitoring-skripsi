<?php

namespace App\Http\Controllers;

use App\Models\Bimbingan;
use App\Models\Skripsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BimbinganDosenController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $dosen = $user->dosen;

        $skripsis = Skripsi::whereHas('dosen1', function ($query) use ($dosen) {
            $query->where('id', $dosen->id);
        })
        ->orWhereHas('dosen2', function ($query) use ($dosen) {
            $query->where('id', $dosen->id);
        })
        ->with(['mahasiswa', 'dosen1', 'dosen2'])
        ->get();

        // Mengembalikan view dengan data yang diperbarui
        return view('dosen.bimbingan', [
            'user' => $user,
            'dosen' => $dosen,
            'skripsis' => $skripsis
        ])->with('layout', 'layout.layout-dosen');
    }

    public function hasilBimbingan(Request $request)
    {
        $bimbinganId = $request->input('bimbingan_id');
        $hasil = $request->input('hasil');

        $bimbingan = Bimbingan::find($bimbinganId);
        $bimbingan->status = $hasil;
        $bimbingan->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui');
    }
}
