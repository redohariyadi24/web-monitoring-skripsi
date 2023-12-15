@extends('layout.layout-admin')

@section('title', 'Beranda')

@section('main')
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="">
                        <div class="card-body" style="height: max-content;">
                            <h5 class="card-title text-primary">Hallo Admin {{ $user->name }}</h5>
                            <p class="mb-1">
                                Sebanyak <span class="fw-bold text-dark">{{--  {{ $presentaseSkripsiSelesai }} --}} 2%</span> Mahasiswa
                                sudah menyelesaikan Skripsi nya.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-8 order-1">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12 mb-4">
                    <div class="card">
                        <div class="card-body" style="height: max-content; min-height: 200px;">
                            <div class="card-title d-flex align-items-start justify-content-between mb-2">
                                <div class="d-flex align-items-center justify-content">
                                    <div class="avatar d-flex align-items-center justify-content-center rounded me-2"
                                        style="background-color: #9a5ffa23;">
                                        <i class="menu-icon tf-icons bx bx-user me-0" style="color: #6610f2;"></i>
                                    </div>
                                    <h5 class="fw-semibold d-block mb-0">Mahasiswa</h5>
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                        <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                    </div>
                                </div>
                            </div>
                            <div class="my-2">
                                <div class="d-flex align-items-end justify-content-center">
                                    <h3 class="card-title text-nowrap mb-0 me-2">{{ $mahasiswajumlah }}</h3>
                                </div>
                                <p class="mb-2">Mahasiswa yang mengerjakan Skripsi</p>
                            </div>
                            <div class="mt-2">
                                <a href="{{ route('data-mahasiswa.index') }}" class="btn btn-sm btn-outline-purlpe">Lihat
                                    Mahasiswa</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6  col-12 mb-4">
                    <div class="card">
                        <div class="card-body" style="height: max-content; min-height: 200px;">
                            <div class="card-title d-flex align-items-start justify-content-between mb-2">
                                <div class="d-flex align-items-center justify-content">
                                    <div class="avatar d-flex align-items-center justify-content-center rounded me-2"
                                        style="background-color: rgba(154, 247, 104, 0.2);">
                                        <i class="menu-icon tf-icons bx bx-book-bookmark text-success me-0"></i>
                                    </div>
                                    <h5 class="fw-semibold d-block mb-0">Skripsi</h5>
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                        <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                    </div>
                                </div>
                            </div>
                            <div class="my-2">
                                <div class="d-flex align-items-end justify-content-center">
                                    <h3 class="card-title text-nowrap mb-0 me-2">{{ $skripsiSelesai }}</h3><span
                                        class="me-2 mb-0">dari</span>
                                    <h3 class="card-title text-nowrap mb-0">{{ $skripsijumlah }}</h3>
                                </div>
                                <p class="mb-2">Mahasiswa Sudah menyelesaikan Skripsi</p>
                            </div>
                            <div class="mt-2">
                                <a href="{{ route('progres-skripsi.index') }}" class="btn btn-sm btn-outline-success">Lihat
                                    Skripsi</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6  col-12 mb-4">
                    <div class="card">
                        <div class="card-body" style="height: max-content; min-height: 200px;">
                            <div class="card-title d-flex align-items-start justify-content-between mb-2">
                                <div class="d-flex align-items-center justify-content">
                                    <div class="avatar d-flex align-items-center justify-content-center rounded me-2"
                                        style="background-color: rgba(3,195,236, 0.1);">
                                        <i class="menu-icon tf-icons bx bx-calendar text-info me-0"></i>
                                    </div>
                                    <h5 class="fw-semibold d-block mb-0">Jadwal</h5>
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                        <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                    </div>
                                </div>
                            </div>
                            <div class="my-2 mr-2">
                                <div class="d-flex align-items-end justify-content-center">
                                    <h3 class="card-title text-nowrap mb-0 me-2">{{ $skripsibelumJadwal }}</h3><span
                                        class="me-2 mb-0">dari</span>
                                    <h3 class="card-title text-nowrap mb-0">{{ $skripsiSelesai }}</h3>
                                </div>
                                <p class="mb-2">Mahasiswa belum memiliki Jadwal</p>
                            </div>
                            <div class="mt-2">
                                <a href="{{ route('jadwal-sidang.index') }}" class="btn btn-sm btn-outline-info">Lihat
                                    Jadwal</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
