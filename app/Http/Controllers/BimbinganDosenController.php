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

        $bimbingans = Bimbingan::where('dospem_id', $dosen->id)
            ->where('status', 'menunggu konfirmasi')
            ->get();

        // Return view with data
        return view('dosen.bimbingan', [
            'user' => $user,
            'dosen' => $dosen,
            'bimbingans' => $bimbingans,
        ])->with('layout', 'layout.layout-dosen');
    }

    public function hasilBimbingan(Request $request)
    {
        $bimbinganId = $request->input('bimbingan_id');
        $hasil = $request->input('hasil');
        $bimbingan = Bimbingan::find($bimbinganId);

        if ($hasil == 'acc') {
            $progres = $bimbingan->skripsi->progres;
            $hasSubbabs = $bimbingan->bab->subbabs->isNotEmpty();
            $progressValues = [
                'Abstrak' => 2,
                'Bab 1' => 12,
                'Bab 2' => 8,
                'Bab 3' => 18,
                'Bab 4' => 6,
                'Bab 5' => 4,
            ];

            $babName = $bimbingan->bab->nama;

            if (!$hasSubbabs || $bimbingan->subbab_id === null) {
                $progres += $progressValues[$babName];
            } else {
                $numSubbabs = $bimbingan->bab->subbabs->count();
                $progressValues[$babName] = 1 / $numSubbabs * $progressValues[$babName];
                $progres += $progressValues[$babName];
            }

            $progres = min($progres, 100);

            $bimbingan->skripsi->progres = $progres;
            $bimbingan->skripsi->save();

            $message = 'Bimbingan berhasil di ACC';
        } elseif ($hasil == 'revisi') {
            $message = 'Hasil Bimbingan adalah Revisi';
        } 

        $bimbingan->status = $hasil;
        $bimbingan->save();

        // Pass the message to the view
        return redirect()->back()->with('message', $message);
    }

}
