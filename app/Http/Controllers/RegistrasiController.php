<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Skripsi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class RegistrasiController extends Controller
{
    public function registrasi()
    {
        return view('mahasiswa.registrasi.data-diri');
    } 

    public function simpan(Request $request)
    {
        // dd($request);
        $data = $request->validate([
            'npm' => 'required|size:9|unique:mahasiswas,npm',
            'nama' => 'required',
            'email' => 'required|email',
            'semester' => 'required|numeric|min:5|max:14',
            'foto' => 'image|mimes:jpg,jpeg,png|max:2048',
            'judul' => 'required|string|max:255',
            'dosen1_id' => 'required|string|exists:dosens,nama',
            'dosen2_id' => [
                'required',
                'string',
                'different:dosen1_id',
                'exists:dosens,nama',
            ],
            'password' => [
                'required',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[A-Za-z])(?=.*\d).+$/',
            ],
        ], [
            'npm.required' => 'NPM wajib diisi.',
            'npm.size' => 'NPM harus memiliki 9 karakter.',
            'npm.unique' => 'NPM sudah digunakan.',
            'nama.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'semester.required' => 'Semester wajib diisi.',
            'semester.numeric' => 'Semester harus berupa angka.',
            'semester.min' => 'Minimal semester 5.',
            'semester.max' => 'Maksimal semester 14.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format gambar harus jpg, jpeg, atau png.',
            'foto.max' => 'Ukuran gambar maksimal 2MB.',
            'judul.required' => 'Judul skripsi wajib diisi.',
            'judul.string' => 'Judul skripsi harus berupa teks.',
            'judul.max' => 'Judul skripsi tidak boleh melebihi 255 karakter.',
            'dosen1_id.required' => 'Pilih Dosen Pembimbing 1 wajib diisi.',
            'dosen1_id.string' => 'Format Dosen Pembimbing 1 tidak valid.',
            'dosen1_id.exists' => 'Dosen Pembimbing 1 yang dipilih tidak valid.',
            'dosen2_id.required' => 'Pilih Dosen Pembimbing 2 wajib diisi.',
            'dosen2_id.string' => 'Format Dosen Pembimbing 2 tidak valid.',
            'dosen2_id.different' => 'Dosen Pembimbing 2 tidak boleh sama dengan Dosen Pembimbing 1.',
            'dosen2_id.exists' => 'Dosen Pembimbing 2 yang dipilih tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'password.regex' => 'Password harus berupa kombinasi huruf dan angka.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
        ]);

        $foto_file = $request->file('foto');

        if ($foto_file) {
            $foto_ekstensi = $foto_file->getClientOriginalExtension();
            $npm_lowercase = Str::lower($data['npm']);
            $foto_nama = $npm_lowercase . date('ymdhis') . "." . $foto_ekstensi;
            $resize_foto = Image::make($foto_file)->fit(300, 300);
            $resize_foto->save(public_path('Foto Mahasiswa') . '/' . $foto_nama);

            $data['foto'] = $foto_nama;
        } else {
            $data['foto'] = null;
        }

        // Mendapatkan ID Dosen 1 berdasarkan Nama Dosen
        $dosen1 = Dosen::where('nama', $data['dosen1_id'])->first();
        $data['dosen1_id'] = $dosen1->id;

        // Mendapatkan ID Dosen 2 berdasarkan Nama Dosen
        $dosen2 = Dosen::where('nama', $data['dosen2_id'])->first();
        $data['dosen2_id'] = $dosen2->id;

        // dd($data);

        // Simpan ke tabel Mahasiswa
        $mahasiswa = Mahasiswa::create([
            'npm' => $data['npm'],
            'nama' => $data['nama'],
            'email' => $data['email'],
            'semester' => $data['semester'],
            'foto' => $data['foto'],
        ]);

        

        // Simpan ke tabel Skripsi
        $skripsi = Skripsi::create([
            'mahasiswa_id' => $mahasiswa->id,
            'dosen1_id' => $data['dosen1_id'],
            'dosen2_id' => $data['dosen2_id'],
            'judul' => $data['judul'],
            'progres' => 0,
        ]);

        // dd($skripsi);

        // Update atau buat user (akun)
        $user = User::updateOrCreate(
            ['username' => $data['npm']],
            [
                'name' => $data['nama'],
                'password' => Hash::make($data['password']),
                'role' => 'mahasiswa',
            ]
        );

        // dd($user);

        // dd($data);
        return redirect(route('dashboard-mahasiswa'))->with('success', 'Data Anda berhasil disimpan.');
    }
}
