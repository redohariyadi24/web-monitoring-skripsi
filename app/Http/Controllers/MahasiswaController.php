<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswas = Mahasiswa::with('skripsi.dosen1', 'skripsi.dosen2')->get();

        return view('admin.Data Mahasiswa.data-mahasiswa', ['mahasiswas' => $mahasiswas]);
    }
    
    public function tambah()
    {
        return view('admin.Data Mahasiswa.tambah');
    }

    public function simpan(Request $request)
    {
        $data = $request->validate([
            'npm' => 'required',
            'nama' => 'required',
            'email' => 'required|email',
            'semester' => 'required|numeric|between:5,14',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png',
        ]);

        $foto_file = $request->file('foto');

        if ($foto_file) {
            $foto_ekstensi = $foto_file->getClientOriginalExtension();
            $npm_lowercase = Str::lower($data['npm']);
            $foto_nama = $npm_lowercase . date('ymdhis') . "." . $foto_ekstensi;
            $foto_file->move(public_path('Foto Mahasiswa'), $foto_nama);

            $data['foto'] = $foto_nama;
        } else {
            $data['foto'] = null;
        }

        $newMahasiswa = Mahasiswa::create($data);
        return redirect(route('data-mahasiswa.index'))->with('success', 'Mahasiswa berhasil disimpan.');
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        return view('admin.Data Mahasiswa.edit', ['mahasiswa' => $mahasiswa]);
    }

    public function update(Mahasiswa $mahasiswa, Request $request)
    {
        $data = $request->validate([
            'npm' => 'required',
            'nama' => 'required',
            'email' => 'required|email',
            'semester' => 'required|numeric|between:5,14',

        ]);

        if ($request->hasFile('foto')) {
            $request->validate([
                'foto' => 'nullable|image|mimes:jpeg,jpg,png',
            ]);
            $foto_file = $request->file('foto');
            $foto_ekstensi = $foto_file->getClientOriginalExtension();
            $npm_lowercase = Str::lower($data['npm']);
            $foto_nama = $npm_lowercase . date('ymdhis') . "." . $foto_ekstensi;
            $foto_file->move(public_path('Foto Mahasiswa'), $foto_nama);

            if ($mahasiswa->foto && file_exists(public_path('Foto Mahasiswa') . '/' . $mahasiswa->foto)) {
                unlink(public_path('Foto Mahasiswa') . '/' . $mahasiswa->foto);
            }

            $data['foto'] = $foto_nama;
        }

        if ($request->has('hapus_foto') && $mahasiswa->foto) {
            // Hapus avatar dari penyimpanan fisik
            if (file_exists(public_path('Foto Mahasiswa') . '/' . $mahasiswa->foto)) {
                unlink(public_path('Foto Mahasiswa') . '/' . $mahasiswa->foto);
            }

            // Hapus referensi avatar dari database
            $data['foto'] = null;
        }

        $mahasiswa->update($data);

        return redirect(route('data-mahasiswa.index'))->with('success', 'Data Mahasiswa Telah Berhasil di Update');
    }

    public function hapus(Mahasiswa $mahasiswa)
    {

        if ($mahasiswa->foto && file_exists(public_path('Foto Mahasiswa') . '/' . $mahasiswa->foto)) {
            unlink(public_path('Foto Mahasiswa') . '/' . $mahasiswa->foto);
        }


        $mahasiswa->delete();

        return redirect(route('data-mahasiswa.index'))->with('success', 'Data Produk Telah Berhasil di Hapus');
    }
}
