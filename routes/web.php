<?php

use App\Http\Controllers\AkunController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\SkripsiController;
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


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [SesiController::class, 'index'])->name('login-index');
    Route::post('/login', [SesiController::class, 'login'])->name('login');
});

Route::get('/home', function () {
    return redirect('/user');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [SesiController::class, 'logout'])->name('logout');
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/user/mahasiswa', [UserController::class, 'mahasiswa'])->middleware('userAkses:mahasiswa');
    Route::get('/user/dosen', [UserController::class, 'dosen'])->middleware('userAkses:dosen');

    Route::get('/beranda', [UserController::class, 'admin'])->middleware('userAkses:admin')->name('dashboard-admin');

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
        ->name('admin.tambah');
    Route::post('/akun/admin', [AkunController::class, 'simpanAdmin'])->middleware('userAkses:admin')
        ->name('admin.simpan');

    Route::get('/akun/dosen', [AkunController::class, 'indexDosen'])->middleware('userAkses:admin')
        ->name('akun-dosen.index');
    Route::get('/akun/dosen/tambah', [AkunController::class, 'tambahDosen'])->middleware('userAkses:admin')
        ->name('dosen.tambah');
    Route::post('/akun/dosen', [AkunController::class, 'simpanDosen'])->middleware('userAkses:admin')
        ->name('dosen.simpan');

    Route::get('/akun/mahasiswa', [AkunController::class, 'indexMahasiswa'])->middleware('userAkses:admin')
        ->name('akun-mahasiswa.index');
    Route::get('/akun/mahasiswa/tambah', [AkunController::class, 'tambahMahasiswa'])->middleware('userAkses:admin')
        ->name('mahasiswa.tambah');
    Route::post('/akun/mahasiswa', [AkunController::class, 'simpanMahasiswa'])->middleware('userAkses:admin')
        ->name('mahasiswa.simpan');

    Route::prefix('akun')->middleware('userAkses:admin')->group(function () {
        Route::prefix('admin')->group(function () {
            Route::get('/{role}/edit/{id}', [AkunController::class, 'edit'])->name('admin.edit');
            Route::put('/update/{id}', [AkunController::class, 'updateAdmin'])->name('admin.update');
        });

        Route::prefix('dosen')->group(function () {
            Route::get('/{role}/edit/{id}', [AkunController::class, 'edit'])->name('dosen.edit');
            Route::put('/update/{id}', [AkunController::class, 'updateDosen'])->name('dosen.update');
        });

        Route::prefix('mahasiswa')->group(function () {
            Route::get('/{role}/edit/{id}', [AkunController::class, 'edit'])->name('mahasiswa.edit');
            Route::put('/update/{id}', [AkunController::class, 'updateMahasiswa'])->name('mahasiswa.update');
        });
    });

    Route::delete('/akun/admin/hapus/{id}', [AkunController::class, 'hapusAdmin'])->middleware('userAkses:admin')
    ->name('admin.hapus');
    Route::delete('/akun/dosen/hapus/{id}', [AkunController::class, 'hapusDosen'])->middleware('userAkses:admin')
        ->name('dosen.hapus');
    Route::delete('/akun/mahasiswa/hapus/{id}', [AkunController::class, 'hapusMahasiswa'])->middleware('userAkses:admin')
    ->name('mahasiswa.hapus');


});

Route::get('/layout', function () {
    return view('layout.layout-table');
});

Route::get('/index', function () {
    return view('index');
});
