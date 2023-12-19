<?php

namespace App\Providers;

use App\Models\Skripsi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer(['layout.layout-admin', 'other.layouts.*'], function ($view) {
            $user = Auth::user();

            // Menambahkan data yang ingin Anda bagikan ke layout-admin
            $skripsis = Skripsi::where('progres', 100)->with('jadwal', 'mahasiswa')->get();
            $mahasiswas = $skripsis->pluck('mahasiswa')->unique();

            $skripsiTanpaSeminarHasil = $skripsis->filter(function ($skripsi) {
                return $skripsi->jadwal->where('jenis', 'Seminar Hasil')->count() === 0;
            });

            $skripsiTanpaSidangSkripsi = $skripsis->filter(function ($skripsi) {
                $jadwalSeminarHasil = $skripsi->jadwal->where('jenis', 'Seminar Hasil')->first();

                // Memeriksa apakah skripsi memiliki jadwal 'Seminar Hasil'
                if ($jadwalSeminarHasil) {
                    $tanggalSeminarHasilLewat = now()->gte($jadwalSeminarHasil->tanggal);

                    // Memeriksa apakah skripsi sudah memiliki jadwal 'Sidang Skripsi'
                    $hasJadwalSidangSkripsi = $skripsi->jadwal->where('jenis', 'Sidang Skripsi')->count() > 0;

                    // Mengembalikan true jika tanggal 'Seminar Hasil' sudah lewat dan belum memiliki jadwal 'Sidang Skripsi'
                    return $tanggalSeminarHasilLewat && !$hasJadwalSidangSkripsi;
                }

                // Mengembalikan false jika skripsi tidak memiliki jadwal 'Seminar Hasil'
                return false;
            });

            $jumlahSkripsiTanpaSidangSkripsi = $skripsiTanpaSidangSkripsi->count();
            
            $jumlahSkripsiTanpaSeminarHasil = $skripsiTanpaSeminarHasil->count();

            // Menambahkan data ke view layout-admin
            $view->with([
                'user' => $user,
                'mahasiswas' => $mahasiswas,
                'jumlahSkripsiTanpaSeminarHasil' => $jumlahSkripsiTanpaSeminarHasil,
                'jumlahSkripsiTanpaSidangSkripsi' => $jumlahSkripsiTanpaSidangSkripsi,
            ]);
        });
    }
}
