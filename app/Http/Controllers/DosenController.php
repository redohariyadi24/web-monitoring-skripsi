<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DosenController extends Controller
{
    public function index()
    {
        $dosens = Dosen::all();
        $inisialdosens = $dosens->map(function ($data) {
            $data['initials'] = $this->generateInitials($data->nama);
            return $data;
        });

        return view('admin.Data Dosen.data-dosen', ['dosens' => $inisialdosens]);
    }

    private function generateInitials($fullName)
    {
        $words = explode(' ', $fullName);
        $initials = '';

        foreach ($words as $word) {
            $initials .= strtoupper(substr($word, 0, 1));
        }

        return $initials;
    }

    public function tambah()
    {
        return view('admin.Data Dosen.tambah');
    }

    public function simpan(Request $request)
    {
        $data = $request->validate([
            'nip' => 'required',
            'nama' => 'required',
            'email' => 'required|email',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png',
        ]);

        $foto_file = $request->file('foto');

        if ($foto_file) {
            $foto_ekstensi = $foto_file->getClientOriginalExtension();
            $npm_lowercase = Str::lower($data['nip']);
            $foto_nama = $npm_lowercase . date('ymdhis') . "." . $foto_ekstensi;
            $foto_file->move(public_path('Foto Dosen'), $foto_nama);

            $data['foto'] = $foto_nama;
        } else {
            $data['foto'] = null;
        }

        $newDosen = Dosen::create($data);

        return redirect(route('data-dosen.index'))->with('success', 'Data Dosen berhasil disimpan.');
    }

    public function edit(Dosen $dosen)
    {
        return view('admin.Data Dosen.edit', ['dosen' => $dosen]);
    }

    public function update(Dosen $dosen, Request $request)
    {
        $data = $request->validate([
            'nip' => 'required',
            'nama' => 'required',
            'email' => 'required|email',
        ]);

        if ($request->hasFile('foto')) {
            $request->validate([
                'foto' => 'nullable|image|mimes:jpeg,jpg,png',
            ]);
            $foto_file = $request->file('foto');
            $foto_ekstensi = $foto_file->getClientOriginalExtension();
            $npm_lowercase = Str::lower($data['nip']);
            $foto_nama = $npm_lowercase . date('ymdhis') . "." . $foto_ekstensi;
            $foto_file->move(public_path('Foto Dosen'), $foto_nama);

            if ($dosen->foto && file_exists(public_path('Foto Dosen') . '/' . $dosen->foto)) {
                unlink(public_path('Foto Dosen') . '/' . $dosen->foto);
            }

            $data['foto'] = $foto_nama;
        }

        if ($request->has('hapus_foto') && $dosen->foto) {
            // Hapus avatar dari penyimpanan fisik
            if (file_exists(public_path('Foto Dosen') . '/' . $dosen->foto)) {
                unlink(public_path('Foto Dosen') . '/' . $dosen->foto);
            }

            // Hapus referensi avatar dari database
            $data['foto'] = null;
        }

        $dosen->update($data);

        return redirect(route('data-dosen.index'))->with('success', 'Data Dosen Telah Berhasil di Update');
    }

    public function hapus(Dosen $dosen)
    {
        if ($dosen->foto && file_exists(public_path('Foto Dosen') . '/' . $dosen->foto)) {
            unlink(public_path('Foto Dosen') . '/' . $dosen->foto);
        }

        $dosen->delete();

        return redirect(route('data-dosen.index'))->with('success', 'Data Dosen Telah Berhasil di Hapus');
    }
}
