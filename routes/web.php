<?php

use App\Http\Controllers\AkunController;
use App\Http\Controllers\BimbinganAdminController;
use App\Http\Controllers\BimbinganDosenController;
use App\Http\Controllers\BimbinganMahasiswaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\SkripsiController;
use App\Http\Controllers\SkripsiMahasiswaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [UserController::class, 'landingpage'])->name('landing-page');

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [SesiController::class, 'index'])->name('login-index');
    Route::post('/login', [SesiController::class, 'login'])->name('login');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [SesiController::class, 'logout'])->name('logout');


    //Mahasiswa
    Route::get('/data-diri', [RegistrasiController::class, 'registrasi'])->middleware('userAkses:mahasiswa')
        ->name('data-diri');
    Route::post('/data-diri', [RegistrasiController::class, 'simpan'])->middleware('userAkses:mahasiswa')
        ->name('data-diri.simpan');
    Route::get('/data-skripsi', [RegistrasiController::class, 'skripsi'])->middleware('userAkses:mahasiswa')
    ->name('data-skripsi');

    Route::get('/beranda', [UserController::class, 'mahasiswa'])->middleware('userAkses:mahasiswa')
        ->name('dashboard-mahasiswa');
    Route::post('/beranda/simpan', [BimbinganMahasiswaController::class, 'simpan'])->middleware('userAkses:mahasiswa')
        ->name('bimbingan-mahasiswa.simpan');

    Route::get('/skripsi', [SkripsiMahasiswaController::class, 'index'])->middleware('userAkses:mahasiswa')
        ->name('skripsi-mahasiswa');
    Route::get('/bimbingan', [BimbinganMahasiswaController::class, 'index'])->middleware('userAkses:mahasiswa')
        ->name('bimbingan-mahasiswa');

    Route::get('/profil-mahasiswa', [ProfilController::class, 'profilmahasiswa'])->middleware('userAkses:mahasiswa')
        ->name('profil-mahasiswa');
    Route::post('/profil-mahasiswa/password/update/{id}', [ProfilController::class, 'password'])->middleware('userAkses:mahasiswa')
        ->name('profil-mahasiswa.password');
    Route::post('/profil-mahasiswa/foto/update/{id}', [ProfilController::class, 'fotoProfil'])->middleware('userAkses:mahasiswa')
        ->name('profil-mahasiswa.fotoProfil');

    // Dosen
    Route::get('/beranda-dosen', [UserController::class, 'dosen'])->middleware('userAkses:dosen')
        ->name('dashboard-dosen');
    Route::get('/bimbingan-dosen', [BimbinganDosenController::class, 'index'])->middleware('userAkses:dosen')
        ->name('bimbingan-dosen');
    Route::post('/bimbingan-hasil', [BimbinganDosenController::class, 'hasilBimbingan'])->middleware('userAkses:dosen')
        ->name('hasil-bimbingan');

    Route::get('/profil-dosen', [ProfilController::class, 'profildosen'])->middleware('userAkses:dosen')
        ->name('profil-dosen');
    Route::post('/profil-dosen/password/update/{id}', [ProfilController::class, 'password'])->middleware('userAkses:dosen')
        ->name('profil-dosen.password');
    Route::post('/profil-dosen/foto/update/{id}', [ProfilController::class, 'fotoProfil2'])->middleware('userAkses:dosen')
        ->name('profil-dosen.fotoProfil2');

    //Admin
    Route::get('/dashboard', [UserController::class, 'admin'])->middleware('userAkses:admin')->name('dashboard-admin');

    // CRUD Data Mahasiswa
    Route::get('/data-mahasiswa', [MahasiswaController::class, 'index'])->middleware('userAkses:admin')
        ->name('data-mahasiswa.index');
    Route::get('/data-mahasiswa/tambah', [MahasiswaController::class, 'tambah'])->middleware('userAkses:admin')
        ->name('data-mahasiswa.tambah');
    Route::post('/data-mahasiswa', [MahasiswaController::class, 'simpan'])->middleware('userAkses:admin')
        ->name('data-mahasiswa.simpan');
    Route::get('/data-mahasiswa/{mahasiswa}/edit', [MahasiswaController::class, 'edit'])->middleware('userAkses:admin')
        ->name('data-mahasiswa.edit');
    Route::put('/data-mahasiswa/{mahasiswa}/update', [MahasiswaController::class, 'update'])->middleware('userAkses:admin')
        ->name('data-mahasiswa.update');
    Route::delete('/data-mahasiswa/{mahasiswa}/hapus', [MahasiswaController::class, 'hapus'])->middleware('userAkses:admin')
        ->name('data-mahasiswa.hapus');

    //CRUD Data Dosen
    Route::get('/data-dosen', [DosenController::class, 'index'])->middleware('userAkses:admin')
        ->name('data-dosen.index');
    Route::get('/data-dosen/tambah', [DosenController::class, 'tambah'])->middleware('userAkses:admin')
        ->name('data-dosen.tambah');
    Route::post('/data-dosen', [DosenController::class, 'simpan'])->middleware('userAkses:admin')
        ->name('data-dosen.simpan');
    Route::get('/data-dosen/{dosen}/edit', [DosenController::class, 'edit'])->middleware('userAkses:admin')
        ->name('data-dosen.edit');
    Route::put('/data-dosen/{dosen}/update', [DosenController::class, 'update'])->middleware('userAkses:admin')
        ->name('data-dosen.update');
    Route::delete('/data-dosen/{dosen}/hapus', [DosenController::class, 'hapus'])->middleware('userAkses:admin')
        ->name('data-dosen.hapus');

    //CRUD Progres Skripsi
    Route::get('/progres-skripsi', [SkripsiController::class, 'index'])->middleware('userAkses:admin')
        ->name('progres-skripsi.index');
    Route::get('/progres-skripsi-dosen/tambah', [SkripsiController::class, 'tambah'])->middleware('userAkses:admin')
        ->name('progres-skripsi.tambah');
    Route::post('/progres-skripsi', [SkripsiController::class, 'simpan'])->middleware('userAkses:admin')
        ->name('progres-skripsi.simpan');
    Route::get('/progres-skripsi/{skripsi}/edit', [SkripsiController::class, 'edit'])->middleware('userAkses:admin')
        ->name('progres-skripsi.edit');
    Route::put('/progres-skripsi/{skripsi}/update', [SkripsiController::class, 'update'])->middleware('userAkses:admin')
        ->name('progres-skripsi.update');
    Route::delete('/progres-skripsi/{skripsi}/hapus', [SkripsiController::class, 'hapus'])->middleware('userAkses:admin')
        ->name('progres-skripsi.hapus');

    //CRUD Bimbingan
    Route::get('/bimbingan-admin', [BimbinganAdminController::class, 'index'])->middleware('userAkses:admin')
        ->name('bimbingan-admin.index');
    Route::get('/bimbingan-admin/tambah', [BimbinganAdminController::class, 'tambah'])->middleware('userAkses:admin')
        ->name('bimbingan-admin.tambah');
    Route::post('/bimbingan-admin', [BimbinganAdminController::class, 'simpan'])->middleware('userAkses:admin')
        ->name('bimbingan-admin.simpan');
    Route::get('/bimbingan-admin/{bimbingan}/edit', [BimbinganAdminController::class, 'edit'])->middleware('userAkses:admin')
        ->name('bimbingan-admin.edit');
    Route::post('/bimbingan-admin/{bimbingan}/update', [BimbinganAdminController::class, 'update'])->middleware('userAkses:admin')
        ->name('bimbingan-admin.update');
    Route::delete('/bimbingan-admin/{bimbingan}/hapus', [BimbinganAdminController::class, 'hapus'])->middleware('userAkses:admin')
        ->name('bimbingan-admin.hapus');


    //CRUD Jadwal Sidang
    Route::get('/jadwal-sidang', [JadwalController::class, 'index'])->middleware('userAkses:admin')
        ->name('jadwal-sidang.index');
    Route::get('/jadwal-sidang/tambah', [JadwalController::class, 'tambah'])->middleware('userAkses:admin')
        ->name('jadwal-sidang.tambah');
    Route::post('/jadwal-sidang', [JadwalController::class, 'simpan'])->middleware('userAkses:admin')
        ->name('jadwal-sidang.simpan');
    Route::get('/jadwal-sidang/{jadwal}/edit', [JadwalController::class, 'edit'])->middleware('userAkses:admin')
        ->name('jadwal-sidang.edit');
    Route::put('/jadwal-sidang/{jadwal}/update', [JadwalController::class, 'update'])->middleware('userAkses:admin')
        ->name('jadwal-sidang.update');
    Route::delete('/jadwal-sidang/{jadwal}/hapus', [JadwalController::class, 'hapus'])->middleware('userAkses:admin')
        ->name('jadwal-sidang.hapus');

    // CRUD Akun Pengguna
    Route::get('/akun/admin', [AkunController::class, 'indexAdmin'])->middleware('userAkses:admin')
        ->name('akun-admin.index');
    Route::get('/akun/admin/tambah', [AkunController::class, 'tambahAdmin'])->middleware('userAkses:admin')
        ->name('akun-admin.tambah');
    Route::post('/akun/admin', [AkunController::class, 'simpanAdmin'])->middleware('userAkses:admin')
        ->name('akun-admin.simpan');
    Route::get('/akun/admin/edit/{id}', [AkunController::class, 'editAdmin'])->middleware('userAkses:admin')
        ->name('akun-admin.edit');
    Route::put('/akun/admin/update/{id}', [AkunController::class, 'updateAdmin'])->middleware('userAkses:admin')
        ->name('akun-admin.update');
    Route::delete('/akun/admin/hapus/{id}', [AkunController::class, 'hapusAdmin'])->middleware('userAkses:admin')
        ->name('akun-admin.hapus');

    Route::get('/akun/dosen', [AkunController::class, 'indexDosen'])->middleware('userAkses:admin')
        ->name('akun-dosen.index');
    Route::get('/akun/dosen/tambah', [AkunController::class, 'tambahDosen'])->middleware('userAkses:admin')
        ->name('akun-dosen.tambah');
    Route::post('/akun/dosen', [AkunController::class, 'simpanDosen'])->middleware('userAkses:admin')
        ->name('akun-dosen.simpan');
    Route::get('/akun/dosen/edit/{id}', [AkunController::class, 'editDosen'])->middleware('userAkses:admin')
        ->name('akun-dosen.edit');
    Route::put('/akun/dosen/update/{id}', [AkunController::class, 'updateDosen'])->middleware('userAkses:admin')
        ->name('akun-dosen.update');
    Route::delete('/akun/dosen/hapus/{id}', [AkunController::class, 'hapusDosen'])->middleware('userAkses:admin')
        ->name('akun-dosen.hapus');


    Route::get('/akun/mahasiswa', [AkunController::class, 'indexMahasiswa'])->middleware('userAkses:admin')
        ->name('akun-mahasiswa.index');
    Route::get('/akun/mahasiswa/tambah', [AkunController::class, 'tambahMahasiswa'])->middleware('userAkses:admin')
        ->name('akun-mahasiswa.tambah');
    Route::post('/akun/mahasiswa', [AkunController::class, 'simpanMahasiswa'])->middleware('userAkses:admin')
        ->name('akun-mahasiswa.simpan');
    Route::get('/akun/mahasiswa/edit/{id}', [AkunController::class, 'editMahasiswa'])->middleware('userAkses:admin')
        ->name('akun-mahasiswa.edit');
    Route::put('/akun/mahasiswa/update/{id}', [AkunController::class, 'updateMahasiswa'])->middleware('userAkses:admin')
        ->name('akun-mahasiswa.update');
    Route::delete('/akun/mahasiswa/hapus/{id}', [AkunController::class, 'hapusMahasiswa'])->middleware('userAkses:admin')
        ->name('akun-mahasiswa.hapus');
});

Route::get('/layout', function () {
    return view('layout.layout-table');
});

Route::get('/index', function () {
    return view('index');
});
