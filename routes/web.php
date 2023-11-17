<?php

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
    Route::post('/login', [SesiController::class, 'login'])->name('loginn');
});

Route::get('/home', function () {
    return redirect('/user');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [SesiController::class, 'logout'])->name('logout');
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/user/mahasiswa', [UserController::class, 'mahasiswa'])->middleware('userAkses:mahasiswa');
    Route::get('/user/dosen', [UserController::class, 'dosen'])->middleware('userAkses:dosen');
    Route::get('/user/admin', [UserController::class, 'admin'])->middleware('userAkses:admin');
});

Route::get('/layout', function () {
    return view('layout.layout');
});

Route::get('/index', function () {
    return view('layout.index');
});

Route::get('/data-mahasiswa', function () {
    return view('admin.data-mahasiswa');
});

Route::get('/layout', function () {
    return view('layout.layout');
});
