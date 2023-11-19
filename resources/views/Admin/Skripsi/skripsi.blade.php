@extends('layout.layout-admin')

@section('title', 'Progres Skripsi')

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
    <div class="card">
        <div class="card-header d-flex flex-column flex-md-row">
            <div class="head-label text">
                <h4 class="card-title mb-0">Data Mahasiswa</h4>
            </div>
            <div class="dt-action-buttons text-end pt-3 pt-md-0 ms-md-auto">
                <div class="dt-buttons">
                    {{-- <div id="DataTables_Table_0_filter" class="dataTables_filter">
                        <label>Search:
                            <input type="search" class="form-control" placeholder="" aria-controls="DataTables_Table_0">
                            </label>
                    </div> --}}
                    <button class="dt-button create-new btn btn-primary" tabindex="0" aria-controls="DataTables_Table_0"
                        type="button" onclick="window.location.href='{{ route('progres-skripsi.tambah') }}' ">
                        <span>
                            <i class="bx bx-plus me-sm-1"></i>
                            <span class="d-none d-sm-inline-block">Tambah Data</span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Mahasiswa</th>
                        <th>Judul Skripsi</th>
                        <th>Progres</th>
                        <th>Dosen Pembimbing</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($skripsis as $skripsi)
                        <tr>
                            <td>{{ $skripsi->id }}</td>
                            <td class="" style="">
                                <div class="d-flex justify-content-start align-items-center user-name">
                                    <div class="avatar-wrapper">
                                        <div class="avatar me-2">
                                            @if ($skripsi->mahasiswa->foto)
                                                <!-- Jika ada foto, tampilkan foto -->
                                                <div class="avatar-popup">
                                                    @if ($skripsi->mahasiswa->foto)
                                                        <img class=""
                                                            src="{{ asset('Foto Mahasiswa') . '/' . $skripsi->mahasiswa->foto }}"
                                                            alt="{{ $skripsi->mahasiswa->nama }} Avatar"
                                                            style="min-width: 100px; min-height: 100px;">
                                                    @endif
                                                </div>
                                                <img class="avatar-initial rounded-circle bg-label-dark"
                                                    src="{{ url('Foto Mahasiswa') . '/' . $skripsi->mahasiswa->foto }}" />
                                            @else
                                                <!-- Jika tidak ada foto, tampilkan inisial -->
                                                <span class="avatar-initial rounded-circle bg-label-dark">
                                                    {{ generateInitials($skripsi->mahasiswa->nama) }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <strong class="mb-0">{{ $skripsi->mahasiswa->npm }}</strong>
                                        <span class="emp_name text-truncate">{{ $skripsi->mahasiswa->nama }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $skripsi->judul }}</td>
                            <td>{{ $skripsi->progres }}%</td>
                            <td>
                                <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                    @if ($skripsi->dosen1)
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            class="avatar avatar-sm pull-up" title="{{ $skripsi->dosen1->nama }}">
                                            @if ($skripsi->dosen1->foto)
                                                <img src="{{ url('Foto Dosen') . '/' . $skripsi->dosen1->foto }}"
                                                    alt="Avatar" class="rounded-circle" />
                                            @else
                                                <span class="avatar-initial rounded-circle bg-label-dark">
                                                    {{ generateInitials($skripsi->dosen1->nama) }}
                                                </span>
                                            @endif
                                        </li>
                                    @endif
                                    @if ($skripsi->dosen2)
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            class="avatar avatar-sm pull-up" title="{{ $skripsi->dosen2->nama }}">
                                            @if ($skripsi->dosen2->foto)
                                                <img src="{{ url('Foto Dosen') . '/' . $skripsi->dosen2->foto }}"
                                                    alt="Avatar" class="rounded-circle" />
                                            @else
                                                <span class="avatar-initial rounded-circle bg-label-dark">
                                                    {{ generateInitials($skripsi->dosen2->nama) }}
                                                </span>
                                            @endif
                                        </li>
                                    @endif
                                </ul>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('progres-skripsi.edit', $skripsi->id) }}"><i
                                                class="bx bx-edit-alt me-1"></i>
                                            Edit</a>
                                        <form id="formHapusMahasiswa" action="{{ route('progres-skripsi.hapus', $skripsi->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item">
                                                <i class="bx bx-trash me-1"></i>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection
