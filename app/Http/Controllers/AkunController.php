<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AkunController extends Controller
{
    //Akun Admin
    public function indexAdmin()
    {
        $admin = User::where('role', 'admin')->get();
        return view('admin.akun.admin', compact('admin'));
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

    public function editAdmin($id)
    {
        $user = User::findOrFail($id);
        return view('admin.akun.edit', compact('user'));
    }

    public function updateAdmin(Request $request, $id)
    {
        $user = User::find($id);

        // Validasi data dari request
        $data = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $id,
            'password' => 'nullable|min:8', // Bisa diisi atau tidak
        ]);

        // Check if a new password is provided
        if ($request->filled('password')) {
            $data['password'] = Hash::make($data['password']);
        } else {
            // If no new password is provided, keep the old password
            $data['password'] = $user->password;
        }

        // Update user with the validated data
        $user->update($data);

        // Redirect with success message
        return redirect(route('akun-admin.index'));
    }


    public function hapusAdmin(User $id)
    {
        $id->delete();

        return redirect(route('akun-admin.index'))->with('success', 'Akun Telah Berhasil di Hapus');
    }

    // Akun Dosen

    public function indexDosen()
    {
        $dosen = User::where('role', 'dosen')->get();
        return view('admin.akun.dosen', compact('dosen'));
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

    public function editDosen($id)
    {
        $user = User::findOrFail($id);
        return view('admin.akun.edit', compact('user'));
    }

    public function
    updateDosen(Request $request, $id)
    {
        $user = User::find($id);

        // Validasi data dari request
        $data = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $id,
            'password' => 'nullable|min:8', // Bisa diisi atau tidak
        ]);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($data['password']);
        } else {
            // If no new password is provided, keep the old password
            $data['password'] = $user->password;
        }

        // Update user dengan data yang valid
        $user->update($data);

        // Redirect dengan pesan sukses

        return redirect(route('akun-dosen.index'));
    }

    public function hapusDosen(User $id)
    {
        $id->delete();

        return redirect(route('akun-dosen.index'))->with('success', 'Akun Telah Berhasil di Hapus');
    }

    // Akun Mahasiswa

    public function indexMahasiswa()
    {
        $mahasiswa = User::where('role', 'mahasiswa')->get();
        return view('admin.akun.mahasiswa', compact('mahasiswa'));
    }

    public function tambahMahasiswa()
    {
        return view('admin.akun.tambah', ['role' => 'mahasiswa']);
    }

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

    public function editMahasiswa($id)
    {
        $user = User::findOrFail($id);
        return view('admin.akun.edit', compact('user'));
    }

    public function updateMahasiswa(Request $request, $id)
    {
        $user = User::find($id);

        // Validasi data dari request
        $data = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $id,
            'password' => 'nullable|min:8', // Bisa diisi atau tidak
        ]);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($data['password']);
        } else {
            // If no new password is provided, keep the old password
            $data['password'] = $user->password;
        }


        // Update user dengan data yang valid
        $user->update($data);

        // Redirect dengan pesan sukses
        return redirect(route('akun-mahasiswa.index'))->with('success', 'User updated successfully.');
    }

    public function hapusMahasiswa(User $id)
    {
        $id->delete();

        return redirect(route('akun-mahasiswa.index'))->with('success', 'Akun Telah Berhasil di Hapus');
    }
}
