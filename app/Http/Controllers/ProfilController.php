<?php

namespace App\Http\Controllers;

use App\Models\Bimbingan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProfilController extends Controller
{
    public function profilMahasiswa()
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;
        $skripsi = $mahasiswa->skripsi;
        $dosen1 = $skripsi->dosen1;
        $dosen2 = $skripsi->dosen2;

        return view('mahasiswa.myprofile', [
            'user' => $user,
            'mahasiswa' => $mahasiswa,
            'skripsi' => $skripsi,
            'dosen1' => $dosen1,
            'dosen2' => $dosen2
        ]);
    }

    public function profilDosen()
    {
        $user = Auth::user();
        $dosen = $user->dosen;

        // Ambil bimbingan yang sedang menunggu konfirmasi
        $bimbingans = Bimbingan::where('dospem_id', $dosen->id)
            ->where('status', 'menunggu konfirmasi')
            ->get();
        // menghitung jumlah bimbingan yang sedang menunggu konfirmasi
        $notif = $bimbingans->count();


        return view('dosen.myprofile', [
            'user' => $user,
            'dosen' => $dosen,
            'notif' => $notif,
        ]);
    }

    public function password(Request $request, $id)
    {
        $user = User::find($id);

        // Validate data from the request
        $data = $request->validate([
            'newpassword' => 'required|min:8', // Add any other necessary validation rules
        ]);

        // Hash the new password
        $newPasswordHash = Hash::make($data['newpassword']);

        // dd($newPasswordHash);
        // Update the user's password
        $user->update([
            'password' => $newPasswordHash,
        ]);

        return redirect()->back()->with('success', 'Password telah berhasil diperbarui.');
    }

    public function fotoProfil(Request $request, $id)
    {
        $user = User::find($id);
        $mahasiswa = $user->mahasiswa;

        $data = $request->validate([
            'foto' => 'nullable'
        ]);
        if ($request->hasFile('foto')) {
            $request->validate([
                'foto' => 'nullable|image|mimes:jpeg,jpg,png',
            ]);
            $foto_file = $request->file('foto');
            $foto_ekstensi = $foto_file->getClientOriginalExtension();
            $npm_lowercase = Str::lower($mahasiswa->npm);
            $foto_nama = $npm_lowercase . date('ymdhis') . "." . $foto_ekstensi;
            $resize_foto = Image::make($foto_file)->fit(300, 300);
            $resize_foto->save(public_path('Foto Mahasiswa') . '/' . $foto_nama);

            if ($mahasiswa->foto && file_exists(public_path('Foto Mahasiswa') . '/' . $mahasiswa->foto)) {
                unlink(public_path('Foto Mahasiswa') . '/' . $mahasiswa->foto);
            }

            $data['foto'] = $foto_nama;
        } elseif ($request->has('hapus_foto') && $mahasiswa->foto) {
            // Hapus avatar dari penyimpanan fisik
            if (file_exists(public_path('Foto Mahasiswa') . '/' . $mahasiswa->foto)) {
                unlink(public_path('Foto Mahasiswa') . '/' . $mahasiswa->foto);
            }

            // Hapus referensi avatar dari database
            $data['foto'] = null;
        }

        $mahasiswa->update($data);
        return redirect()->route('profil-mahasiswa')->with('success', 'Foto Profil telah berhasil di perbarui.');
    }

    public function fotoProfil2(Request $request, $id)
    {
        $user = User::find($id);
        $dosen = $user->dosen;

        $data = $request->validate([
            'foto' => 'nullable'
        ]);
        if ($request->hasFile('foto')) {
            $request->validate([
                'foto' => 'nullable|image|mimes:jpeg,jpg,png',
            ]);
            $foto_file = $request->file('foto');
            $foto_ekstensi = $foto_file->getClientOriginalExtension();
            $npm_lowercase = Str::lower($dosen->nip);
            $foto_nama = $npm_lowercase . date('ymdhis') . "." . $foto_ekstensi;
            $foto_file->move(public_path('Foto Dosen'), $foto_nama);

            if ($dosen->foto && file_exists(public_path('Foto Dosen') . '/' . $dosen->foto)) {
                unlink(public_path('Foto Dosen') . '/' . $dosen->foto);
            }

            $data['foto'] = $foto_nama;
        } elseif ($request->has('hapus_foto') && $dosen->foto) {
            // Hapus avatar dari penyimpanan fisik
            if (file_exists(public_path('Foto Dosen') . '/' . $dosen->foto)) {
                unlink(public_path('Foto Dosen') . '/' . $dosen->foto);
            }

            // Hapus referensi avatar dari database
            $data['foto'] = null;
        }

        $dosen->update($data);
        return redirect()->route('profil-dosen')->with('success', 'Foto Profil telah berhasil di perbarui.');
    }
}
