<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AkunController extends Controller
{
    public function indexAdmin()
    {
        $admin = User::where('role', 'admin')->get();
        return view('admin.akun.admin', compact('admin'));
    }

    public function indexDosen()
    {
        $dosen = User::where('role', 'dosen')->get();
        return view('admin.akun.dosen', compact('dosen'));
    }

    public function indexMahasiswa()
    {
        $mahasiswa = User::where('role', 'mahasiswa')->get();
        return view('admin.akun.mahasiswa', compact('mahasiswa'));
    }

    public function tambahMahasiswa()
    {
        return view('admin.akun.tambah', ['role' => 'mahasiswa']);
    }

    public function editMahasiswa($id)
    {
        $mahasiswa = User::findOrFail($id);

        return view('admin.akun.edit', compact('mahasiswa'));
    }

    // public function updateMahasiswa(Request $request, $id)
    // {
    //     $data = $request->validate([
    //         'name' => 'required',
    //         'username' => 'required|unique:users,username,' . $id,
    //         'password' => 'nullable|min:8', // Bisa diisi atau tidak
    //         'role' => 'required|in:mahasiswa',
    //     ]);

    //     // Jika password diisi, hash password baru
    //     if ($request->filled('password')) {
    //         $data['password'] = Hash::make($data['password']);
    //     }

    //     $mahasiswa = User::findOrFail($id);
    //     $mahasiswa->update($data);

    //     return redirect(route('akun-mahasiswa.index'));
    // }


    public function simpanMahasiswa(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required|min:8',
            'role' => 'required|in:mahasiswa',
        ]);

        $data['password'] = Hash::make($data['password']);

        User::create($data);
        return redirect(route('akun-mahasiswa.index'));
    }

    public function tambahDosen()
    {
        return view('admin.akun.tambah', ['role' => 'dosen']);
    }

    public function simpanDosen(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required|min:8',
            'role' => 'required|in:dosen',
        ]);

        $data['password'] = Hash::make($data['password']);

        User::create($data);
        return redirect(route('akun-dosen.index'));
    }

    public function tambahAdmin()
    {
        return view('admin.akun.tambah', ['role' => 'admin']);
    }
    public function simpanAdmin(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required|min:8',
            'role' => 'required|in:admin',
        ]);

        $data['password'] = Hash::make($data['password']);

        User::create($data);
        return redirect(route('akun-admin.index'));
    }

    public function edit($role, $id)
    {
        $user = User::findOrFail($id);
        return view('admin.akun.edit', compact('user', 'role'));
    }

    public function updateMahasiswa(Request $request, $id)
    {
        // Temukan user berdasarkan ID
        $user = User::find($id);

        // Periksa apakah user ditemukan
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        // Validasi data dari request
        $data = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $id,
            'role' => 'required|in:mahasiswa',
        ]);

        dd($data);

        // Update user dengan data yang valid
        $user->update($data);

        // Redirect dengan pesan sukses
        return redirect(route('akun-mahasiswa.index'))->with('success', 'User updated successfully.');
    }


    public function updateDosen(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $id,
            'password' => 'nullable|min:8',
            'role' => 'required|in:dosen',
        ]);


        if ($request->filled('password')) {
            $data['password'] = Hash::make($data['password']);
        }

        $user = User::findOrFail($id);
        $user->update($data);

        return redirect(route('akun-dosen.index'));
    }

    public function updateAdmin(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $id,
            'password' => 'nullable|min:8',
            'role' => 'required|in:admin',
        ]);

        dd($data);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($data['password']);
        }

        $user = User::findOrFail($id);
        $user->update($data);

        return redirect(route('akun-admin.index'));
    }

    public function hapusMahasiswa(User $id)
    {
        $id->delete();

        return redirect(route('akun-mahasiswa.index'))->with('success', 'Akun Telah Berhasil di Hapus');
    }

    public function hapusDosen(User $id)
    {
        $id->delete();

        return redirect(route('akun-dosen.index'))->with('success', 'Akun Telah Berhasil di Hapus');
    }

    public function hapusAdmin(User $id)
    {
        $id->delete();

        return redirect(route('akun-admin.index'))->with('success', 'Akun Telah Berhasil di Hapus');
    }
}
