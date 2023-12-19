<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Mahasiswa;
use App\Models\Skripsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwals = Jadwal::with('skripsi.mahasiswa', 'skripsi.dosen1', 'skripsi.dosen2')->get();

        return view('admin.jadwal.jadwal', ['jadwals' => $jadwals]);
    }

    public function tambah()
    {
        // Mencari skripsi yang progresnya 100
        $skripsis = Skripsi::where('progres', 100)->with('jadwal', 'mahasiswa')->get();

        // Mencari data mahasiswanya
        $mahasiswas = $skripsis->pluck('mahasiswa')->unique();

        // Menghitung skripsi yang belum memiliki jadwal 'Seminar Hasil'
        $skripsiTanpaSeminarHasil = $skripsis->filter(function ($skripsi) {
            return $skripsi->jadwal->where('jenis', 'Seminar Hasil')->count() === 0;
        });

        // Menghitung skripsi yang belum memiliki jadwal 'Sidang Skripsi'
        $skripsiTanpaSidangSkripsi = $skripsis->filter(function ($skripsi) {
            // Mencari jadwal 'Seminar Hasil'
            $jadwalSeminarHasil = $skripsi->jadwal->where('jenis', 'Seminar Hasil')->first();

            // Memeriksa apakah skripsi memiliki jadwal 'Seminar Hasil'
            if ($jadwalSeminarHasil) {
                // Memeriksa apakah tanggal 'Seminar Hasil' sudah lewat
                $tanggalSeminarHasilLewat = now()->gte($jadwalSeminarHasil->tanggal);

                // Mengembalikan true jika tanggal 'Seminar Hasil' sudah lewat
                return $tanggalSeminarHasilLewat;
            }

            // Mengembalikan false jika skripsi tidak memiliki jadwal 'Seminar Hasil'
            return false;
        });

        // Jumlah skripsi tanpa jadwal Seminar Hasil
        $jumlahSkripsiTanpaSeminarHasil = $skripsiTanpaSeminarHasil->count();

        // Jumlah skripsi tanpa jadwal Sidang Skripsi
        $jumlahSkripsiTanpaSidangSkripsi = $skripsiTanpaSidangSkripsi->count();

        // Menggunakan View::share() untuk berbagi data ke layout
        View::share([
            'mahasiswas' => $mahasiswas,
            'jumlahSkripsiTanpaSeminarHasil' => $jumlahSkripsiTanpaSeminarHasil,
            'jumlahSkripsiTanpaSidangSkripsi' => $jumlahSkripsiTanpaSidangSkripsi,
        ]);

        return view('admin.jadwal.tambah')->with( 'layout.layout-admin');
    }

    public function simpan(Request $request)
    {
        $data = $request->validate([
            'jenis' => 'required',
            'tanggal' => 'required|date',
            'skripsi_id' => 'required|string',
        ]);

        $npm = $data['skripsi_id'];
        $mahasiswa = Mahasiswa::where('npm', $npm)->first();
        if ($mahasiswa) {
            $skripsi = Skripsi::where('mahasiswa_id', $mahasiswa->id)->first();
            if ($skripsi) {
                $data['skripsi_id'] = $skripsi->id;
                // dd($data);
                $newJadwal = Jadwal::create($data);
                return redirect(route('jadwal-sidang.index'))->with('success', 'Jadwal berhasil disimpan.');;
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
            'jenis' => 'required',
            'tanggal' => 'required|date',
            'skripsi_id' => 'required|string',
        ]);

        $npm = $data['skripsi_id'];
        $mahasiswa = Mahasiswa::where('npm', $npm)->first();

        if ($mahasiswa) {
            $skripsi = Skripsi::where('mahasiswa_id', $mahasiswa->id)->first();

            if ($skripsi) {
                $data['skripsi_id'] = $skripsi->id;
                // dd($data);
                $jadwal->update($data);

                return redirect(route('jadwal-sidang.index'))->with('success', 'Jadwal berhasil diperbarui.');
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

        return redirect()->route('jadwal-sidang.index')->with('success', 'Jadwal berhasil dihapus');;
    }
}
