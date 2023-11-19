<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Skripsi;
use Illuminate\Http\Request;

class SkripsiController extends Controller
{
    public function index()
    {
        // Mengambil semua data skripsi dengan data terkait dari relasi
        $skripsis = Skripsi::with(['mahasiswa', 'dosen1', 'dosen2'])->get();

        // Mengirim data ke tampilan
        return view('admin.skripsi.skripsi', compact('skripsis'));
    }

    public function tambah()
    {
        $mahasiswas = Mahasiswa::all();
        $dosens = Dosen::all();

        return view('admin.skripsi.tambah', [
            'mahasiswas' => $mahasiswas,
            'dosens' => $dosens,
        ]);
    }

    public function simpan(Request $request)
    {
        $data = $request->validate([
            'mahasiswa_id' => 'required',
            'dosen1_id' => 'required',
            'dosen2_id' => 'required',
            'judul' => 'required',
            'progres' => 'numeric',
        ]);

        // Mendapatkan ID Mahasiswa berdasarkan NPM
        $mahasiswa = Mahasiswa::where('npm', $data['mahasiswa_id'])->first();
        $data['mahasiswa_id'] = $mahasiswa->id;

        // Mendapatkan ID Dosen 1 berdasarkan Nama Dosen
        $dosen1 = Dosen::where('nama', $data['dosen1_id'])->first();
        $data['dosen1_id'] = $dosen1->id;

        // Mendapatkan ID Dosen 2 berdasarkan Nama Dosen
        $dosen2 = Dosen::where('nama', $data['dosen2_id'])->first();
        $data['dosen2_id'] = $dosen2->id;

        // Set nilai progres menjadi 0 jika tidak diatur
        $data['progres'] = $data['progres'] ?? 0;

        $newSkripsi = Skripsi::create($data);

        return redirect(route('progres-skripsi.index'))->with('success', 'Data Skripsi berhasil disimpan.');
    }

    public function edit(Skripsi $skripsi)
    {
        $dosens = Dosen::all();
        $mahasiswas = Mahasiswa::all();

        return view('admin.skripsi.edit', [
            'skripsi' => $skripsi,
            'dosens' => $dosens,
            'mahasiswas' => $mahasiswas,
        ]);
    }

    public function update(Request $request, Skripsi $skripsi)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'progres' => 'required|numeric|min:0|max:100',
        ]);

        $skripsi->update([
            'judul' => $request->input('judul'),
            'progres' => $request->input('progres'),
            'dosen1_id' => Dosen::where('nama', $request->input('dosen1_id'))->value('id'),
            'dosen2_id' => Dosen::where('nama', $request->input('dosen2_id'))->value('id'),
        ]);

        return redirect(route('progres-skripsi.index'))->with('success', 'Data Skripsi berhasil di perbarui.');
    }

    public function hapus(Skripsi $skripsi)
    {
        $skripsi->delete();

        return redirect()->route('progres-skripsi.index');
    }
}
