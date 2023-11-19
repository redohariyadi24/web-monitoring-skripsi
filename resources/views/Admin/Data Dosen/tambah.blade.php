@extends('layout.layout-admin')

@section('title', 'Edit Data Dosen')

@section('menu-sidebar')
    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item">
            <a href="{{ route('dashboard-admin') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Beranda</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Manajemen Data</span>
        </li>
        <li class="menu-item active open">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">Data</div>
            </a>
            <ul class="menu-sub ">
                <li class="menu-item">
                    <a href="{{ route('data-mahasiswa.index') }}" class="menu-link">
                        <div data-i18n="Account">Data Mahasiswa</div>
                    </a>
                </li>
                <li class="menu-item active">
                    <a href="{{ route('data-dosen.index') }}" class="menu-link">
                        <div data-i18n="Notifications">Data Dosen</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
                <div data-i18n="Authentications">Akun</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="auth-login-basic.html" class="menu-link" target="_blank">
                        <div data-i18n="Basic">Akun Mahasiswa</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="auth-register-basic.html" class="menu-link" target="_blank">
                        <div data-i18n="Basic">Akun Dosen</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="auth-forgot-password-basic.html" class="menu-link" target="_blank">
                        <div data-i18n="Basic">Akun Admin</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- Components -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Manajemen
                Skripsi</span></li>
        <!-- Cards -->
        <li class="menu-item">
            <a href="{{ route('progres-skripsi.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Progres Skripsi</div>
            </a>
        </li>
        <!-- User interface -->
        <li class="menu-item">
            <a href="javascript:void(0)" class="menu-link">
                <i class="menu-icon tf-icons bx bx-box"></i>
                <div data-i18n="User interface">Jadwal Sidang</div>
            </a>
        </li>
    </ul>
@endsection

@section('main')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Data Dosen/</span> Tambah Data Dosen</h4>
    <!-- Basic Layout -->

    <div class="col-xl mx-auto" style="max-width: 700px">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Form Pengisian Data Dosen</h5>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('data-dosen.simpan') }}" enctype="multipart/form-data"> 
                    @csrf
                    @method('post')
                    <div class="mb-3">
                        <div class="form-floating">
                            <input name="nip" type="text" class="form-control" id="floatingInput" placeholder="19xxxxxxxxxxx"
                                aria-describedby="floatingInputHelp" style="text-transform: uppercase;"/>
                            <label for="floatingInput">NIP</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <input name="nama" type="text" class="form-control" id="floatingInput" placeholder="John Doe"
                                aria-describedby="floatingInputHelp" />
                            <label for="floatingInput">Nama</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <input name="email" type="email" class="form-control" id="floatingInput" placeholder="email@example.com"
                                aria-describedby="floatingInputHelp" />
                            <label for="floatingInput">Email</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Foto Dosen</label>
                        <input name="foto" class="form-control" type="file" id="formFile" accept=".jpg, .jpeg, .png" />
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
