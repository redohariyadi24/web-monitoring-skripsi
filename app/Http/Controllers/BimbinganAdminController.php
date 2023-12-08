<?php

namespace App\Http\Controllers;

use App\Models\Bab;
use App\Models\Bimbingan;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Skripsi;
use App\Models\Subbab;
use Illuminate\Http\Request;

class BimbinganAdminController extends Controller
{
    public function index()
    {
        $bimbingans = Bimbingan::all();

        return view('admin.bimbingan.bimbingan', ['bimbingans' => $bimbingans]);
    }

    public function tambah()
    {
        $mahasiswas = Mahasiswa::all();
        $dosens = Dosen::all();
        $babs = Bab::all();
        $subBabs = Subbab::with('bab')->get();
        return view('admin.bimbingan.tambah', [
            'mahasiswas' => $mahasiswas,
            'dosens' => $dosens,
            'babs' => $babs,
            'subBabs' => $subBabs,
        ]);
    }

    public function simpan(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'tanggal' => 'required',
            'mahasiswa_id' => 'required',
            'dospem_id' => 'required',
            'bab_id' => 'required',
            'subbab_id' => 'nullable',
            'status' => 'required',
        ]);

        $mahasiswa = Mahasiswa::where('npm', $data['mahasiswa_id'])->first();
        $data['mahasiswa_id'] = $mahasiswa->id;

        $skripsi = Skripsi::where('mahasiswa_id', $data['mahasiswa_id'])->first();
        $data['skripsi_id'] = $skripsi->id;

        $dosen = Dosen::where('nip', $data['dospem_id'])->first();
        $data['dospem_id'] = $dosen->id;

        $newBimbingan = Bimbingan::create($data);
        return redirect(route('bimbingan-admin.index'))->with('success', 'Data Bimbingan berhasil disimpan.');
    }

    public function edit(Bimbingan $bimbingan)
    {
        $mahasiswas = Mahasiswa::all();
        $dosens = Dosen::all();
        $babs = Bab::all();
        $subBabs = Subbab::with('bab')->get();
        return view('admin.bimbingan.edit', [
            'bimbingan' => $bimbingan,
            'mahasiswas' => $mahasiswas,
            'dosens' => $dosens,
            'babs' => $babs,
            'subBabs' => $subBabs,
        ]);
    }

    public function update(Request $request, Bimbingan $bimbingan)
    {
        $data = $request->validate([
            'nama' => 'required',
            'tanggal' => 'required',
            'mahasiswa_id' => 'required',
            'dospem_id' => 'required',
            'bab_id' => 'required',
            'subbab_id' => 'nullable',
            'status' => 'required',
        ]);

        if ($data['subbab_id'] == 'Pilih Sub Bab') {
            $data['subbab_id'] = null;
        }

        $mahasiswa = Mahasiswa::where('npm', $data['mahasiswa_id'])->first();
        $data['mahasiswa_id'] = $mahasiswa->id;

        $skripsi = Skripsi::where('mahasiswa_id', $data['mahasiswa_id'])->first();
        $data['skripsi_id'] = $skripsi->id;

        $dosen = Dosen::where('nip', $data['dospem_id'])->first();
        $data['dospem_id'] = $dosen->id;

        $bimbingan->update($data);
        return redirect(route('bimbingan-admin.index'))->with('success', 'Data Bimbingan berhasil diperbarui.');
    }

    public function hapus(Bimbingan $bimbingan)
    {
        $bimbingan->delete();
        return redirect(route('bimbingan-admin.index'))->with('success', 'Data Bimbingan berhasil dihapus.');
    }
}
