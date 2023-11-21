<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Mahasiswa;
use App\Models\Skripsi;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwals = Jadwal::with('skripsi.mahasiswa', 'skripsi.dosen1', 'skripsi.dosen2')->get();

        return view('admin.jadwal.jadwal', ['jadwals' => $jadwals]);
    }

    public function tambah()
    {
        // mencari skripsi yang progresnya 100
        $skripsis = Skripsi::where('progres', 100)->with('mahasiswa')->get();

        // mencari data mahasiswanya
        $mahasiswas = $skripsis->pluck('mahasiswa')->unique();

        // mencari id mahasiswa yang sudah ada di jadwal
        $adaJadwal = Jadwal::pluck('skripsi_id')->toArray();

        // Filter out Mahasiswas with existing schedules
        $mahasiswas = $mahasiswas->reject(function ($mahasiswa) use ($adaJadwal) {
            return in_array($mahasiswa->skripsi->id, $adaJadwal);
        });

        return view('admin.jadwal.tambah', compact('mahasiswas'));
    }

    public function simpan(Request $request)
    {
        $data = $request->validate([
            'tanggal' => 'required|date',
            'skripsi_id' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        $npm = $data['skripsi_id'];
        $mahasiswa = Mahasiswa::where('npm', $npm)->first();
        if ($mahasiswa) {
            $skripsi = Skripsi::where('mahasiswa_id', $mahasiswa->id)->first();
            if ($skripsi) {
                $data['skripsi_id'] = $skripsi->id;
                $newJadwal = Jadwal::create($data);
                return redirect(route('jadwal-sidang.index'))->with('success', 'Data Skripsi berhasil disimpan.');;
            } else {
                return redirect()->back()->with('error', 'Skripsi tidak ditemukan untuk mahasiswa ini.');
            }
        } else {
            return redirect()->back()->with('error', 'Mahasiswa dengan NPM ini tidak ditemukan.');
        }
    }

    public function edit(Jadwal $jadwal)
    {
        // Ambil semua mahasiswa dengan nilai progres 100
        $mahasiswas = Skripsi::where('progres', 100)->with('mahasiswa')->get()->pluck('mahasiswa');

        // Ambil semua ID Jadwal yang sudah ada
        $adaJadwal = Jadwal::pluck('skripsi_id')->toArray();

        // Buat koleksi Mahasiswa yang belum memiliki Jadwal
        $mahasiswasBelumJadwal = $mahasiswas->reject(function ($mahasiswa) use ($adaJadwal) {
            return in_array($mahasiswa->skripsi->id, $adaJadwal);
        });

        return view('admin.jadwal.edit', compact('mahasiswas', 'mahasiswasBelumJadwal', 'jadwal'));
    }


    public function update(Request $request, Jadwal $jadwal)
    {
        $data = $request->validate([
            'tanggal' => 'required|date',
            'skripsi_id' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        $npm = $data['skripsi_id'];
        $mahasiswa = Mahasiswa::where('npm', $npm)->first();

        if ($mahasiswa) {
            $skripsi = Skripsi::where('mahasiswa_id', $mahasiswa->id)->first();

            if ($skripsi) {
                $data['skripsi_id'] = $skripsi->id;

                // Update jadwal
                $jadwal->update($data);

                return redirect(route('jadwal-sidang.index'))->with('success', 'Data Skripsi berhasil diperbarui.');
            } else {
                return redirect()->back()->with('error', 'Skripsi tidak ditemukan untuk mahasiswa ini.');
            }
        } else {
            return redirect()->back()->with('error', 'Mahasiswa dengan NPM ini tidak ditemukan.');
        }
    }

    public function hapus(Jadwal $jadwal)
    {
        $jadwal->delete();

        return redirect()->route('jadwal-sidang.index');
    }
}
