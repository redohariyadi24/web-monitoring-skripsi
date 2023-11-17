<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function index(){
        echo "Hallo user ". Auth::user()->name .". <br>";
        echo "<a href='logout'>Logout</a>";
    }
    function mahasiswa()
    {
        $user = Auth::user();
        return view('mahasiswa.index', ['user' => $user]);
    }
    function dosen()
    {
        $user = Auth::user();
        return view('dosen.index', ['user' => $user]);
    }
    function admin()
    {
        $user = Auth::user();
        return view('admin.index', ['user' => $user]);
    }
}
