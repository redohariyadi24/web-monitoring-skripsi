<?php

use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\SesiController;
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

    Route::get('/user/admin', [UserController::class, 'admin'])->middleware('userAkses:admin')->name('dashboard-admin');

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
    Route::delete('data-mahasiswa/{mahasiswa}/hapus', [MahasiswaController::class, 'hapus'])->middleware('userAkses:admin')
        ->name('data-mahasiswa.hapus');
});

Route::get('/layout', function () {
    return view('layout.layout-table');
});

Route::get('/index', function () {
    return view('index');
});
