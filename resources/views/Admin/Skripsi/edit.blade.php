@extends('layout.layout-admin')

@section('title', 'Edit Progres Skripsi')

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
        <li class="menu-item">
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
                <li class="menu-item">
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
        <li class="menu-item active">
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
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Data Mahasiswa/</span> Edit Data Mahasiswa</h4>
    <!-- Basic Layout -->

    <div class="col-xl mx-auto" style="max-width: 700px">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Form Edit Data Mahasiswa</h5>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('progres-skripsi.update', ['skripsi' => $skripsi]) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <label for="defaultFormControlInput" class="form-label">Mahasiswa</label>
                        <div class="input-group">
                            <input type="text" class="form-control" value="{{ $skripsi->mahasiswa->nama }}" readonly>
                            <input type="hidden" name="mahasiswa_id" value="{{ $skripsi->mahasiswa_id }}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleDataListDosen" class="form-label">Pilih Dosen Pembimbing 1</label>
                        <input name="dosen1_id" class="form-control" list="datalistOptionsDosen" id="exampleDataListDosen"
                            placeholder="Cari Dosen Pembimbing 1" value="{{ $dosens->where('id', $skripsi->dosen1_id)->first()->nama ?? '' }}"/>
                        <datalist id="datalistOptionsDosen">
                            @foreach ($dosens as $dosen)
                                <option value="{{ $dosen->nama }}">{{ $dosen->nip }}</option>
                            @endforeach
                        </datalist>
                    </div>
                    <div class="mb-3">
                        <label for="exampleDataListDosen2" class="form-label">Pilih Dosen Pembimbing 2</label>
                        <input name="dosen2_id" class="form-control" list="datalistOptionsDosen2"
                            id="exampleDataListDosen2" placeholder="Cari Dosen Pembimbing 2" value="{{ $dosens->where('id', $skripsi->dosen2_id)->first()->nama ?? '' }}"/>
                        <datalist id="datalistOptionsDosen2">
                            @foreach ($dosens as $dosen)
                                <option value="{{ $dosen->nama }}">{{ $dosen->nip }}</option>
                            @endforeach
                        </datalist>
                    </div>
                    <div class="mb-3">
                        <label for="defaultFormControlInput" class="form-label">Judul Skripsi</label>
                        <input name="judul" type="text" class="form-control" id="defaultFormControlInput"
                            placeholder="Judul Skripsi" aria-describedby="defaultFormControlHelp"
                            value="{{ old('judul', $skripsi->judul) }}">
                    </div>
                    <div class="mb-3">
                        <label for="progress" class="form-label">Progres</label>
                        <input name="progres" type="number" class="form-control" id="progress"
                            placeholder="Masukkan progres skripsi" aria-describedby="progressHelp"
                            value="{{ old('progres', $skripsi->progres) }}" min="0" max="100">
                        <small id="progressHelp" class="form-text text-muted">Masukkan nilai antara 0 dan 100.</small>
                    </div>
                    <button type="submit" class="btn btn-primary">Perbarui Data</button>
                </form>
            </div>
        </div>
    </div>
@endsection
