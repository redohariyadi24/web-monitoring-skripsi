@extends('layout.layout-dosen')

@section('title', 'Beranda')

@section('main')
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3 mb-4">
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
                            <h1 class="card-title text-nowrap m-4">{{ $mahasiswajumlah }}</h1>
                        </div>
                        <p class="mb-2">Mahasiswa yang mengerjakan Skripsi</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3 mb-4">
            <div class="card">
                <div class="card-body" style="height: max-content; min-height: 200px;">
                    <div class="card-title d-flex align-items-start justify-content-between mb-2">
                        <div class="d-flex align-items-center justify-content">
                            <div class="avatar d-flex align-items-center justify-content-center rounded me-2"
                                style="background-color: rgba(3,195,236, 0.1);">
                                <i class="menu-icon tf-icons bx bx-calendar text-info me-0"></i>
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
                    <div class="my-2 mr-2">
                        <div class="d-flex align-items-end justify-content-center">
                            <h1 class="card-title text-nowrap m-4">{{ $skripsiSelesai }}</h1>
                        </div>
                        <p class="mb-2">Mahasiswa sudah Menyelesaikan Skripsisnya</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-6 mb-4">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Pengumuman</h5>
                    </div>
                    <div class="dropdown">
                        <button class="btn p-0" type="button" id="deliveryExceptions" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="deliveryExceptions">
                            <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {{-- @dd($skripsiDenganJadwal) --}}
                    {{-- @php
                        $jumlahJadwal = 0;
                        $index = 0;
                    @endphp --}}

                    @php
                        $jumlahJadwal = 0;
                    @endphp

                    @foreach ($skripsiDenganJadwal as $skripsi)
                        @php
                            $skripsiBelumLewat = false; // Flag untuk menandakan apakah skripsi memiliki jadwal yang belum lewat

                            foreach ($skripsi->jadwal as $jadwal) {
                                $jadwalDate = \Carbon\Carbon::parse($jadwal->tanggal);

                                if ($jadwalDate->isFuture()) {
                                    $skripsiBelumLewat = true;
                                    break; // Hentikan iterasi jika ditemukan jadwal yang belum lewat
                                }
                            }

                            // Jika skripsi memiliki jadwal yang belum lewat, tambahkan ke jumlahSkripsiBelumLewat
                            if ($skripsiBelumLewat) {
                                $jumlahJadwal++;
                            }
                        @endphp
                    @endforeach
                    {{-- @dd($jumlahJadwal) --}}

                    @if ($jumlahJadwal > 1)
                        <!-- Carousel -->
                        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                            <ol class="carousel-indicators mb-2">
                                @for ($i = 0; $i < $jumlahJadwal; $i++)
                                    <li data-bs-target="#carouselExample" data-bs-slide-to="{{ $i }}"
                                        @if ($i === 0) class="active" @endif></li>
                                @endfor
                            </ol>
                            <div class="carousel-inner">
                                @php
                                    $index = 0;
                                @endphp
                                @foreach ($skripsiDenganJadwal as $skripsi)
                                    @foreach ($skripsi->jadwal as $jadwal)
                                        @php
                                            $jadwalDate = \Carbon\Carbon::parse($jadwal->tanggal);
                                            if ($jadwalDate->isPast()) {
                                                // Jika tanggal sudah lewat, skip iterasi ke jadwal berikutnya
                                                continue;
                                            }
                                        @endphp
                                        <div class="carousel-item @if ($index === 0) active @endif">
                                            <div class="card bg-primary">
                                                <div class="my-3">
                                                    <div class="mx-md-3 mx-2 my-auto px-4 text-white mb-0">
                                                        <h5 class="mb-2 fw-bold text-white">{{ $jadwal->jenis }}</h5>
                                                        <div class="d-flex align-item-center justify-content">
                                                            <i class="bx bx-xs bx-user me-2 mt-1 pb-1"></i>
                                                            <p class="mb-0">
                                                                {{ $skripsi->mahasiswa->nama }}
                                                                ({{ $skripsi->mahasiswa->npm }})
                                                            </p>
                                                        </div>
                                                        <div class="d-flex align-item-center justify-content">
                                                            <i class="bx bx-xs bx-calendar me-2 mt-1 pb-1"></i>
                                                            <p class="mb-0">
                                                                {{ \Carbon\Carbon::parse($jadwal->tanggal)->locale('id_ID')->isoFormat('dddd, D MMMM YYYY') }}
                                                            </p>
                                                        </div>
                                                        <div class="d-flex align-item-center justify-content">
                                                            <i class="bx bx-xs bx-time me-2 mt-1 pb-1"></i>
                                                            <p class="mb-0">
                                                                Pukul
                                                                {{ \Carbon\Carbon::parse($jadwal->tanggal)->locale('id_ID')->isoFormat('H:mm') }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @php
                                            $index++;
                                        @endphp
                                    @endforeach
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carouselExample" role="button" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExample" role="button"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </a>
                        </div>
                    @elseif($jumlahJadwal == 1)
                        {{-- Tampilkan satu elemen untuk satu jadwal --}}
                        @foreach ($skripsiDenganJadwal as $skripsi)
                            @foreach ($skripsi->jadwal as $jadwal)
                                @php
                                    $jadwalDate = \Carbon\Carbon::parse($jadwal->tanggal);
                                    if ($jadwalDate->isPast()) {
                                        // Jika tanggal sudah lewat, skip iterasi ke jadwal berikutnya
                                        continue;
                                    }
                                @endphp
                                <div class="card bg-primary">
                                    <div class="my-3">
                                        <div class="mx-md-3 mx-2 my-auto px-4 text-white mb-0">
                                            <h5 class="mb-2 fw-bold text-white"> {{ $jadwal->jenis }}</h5>
                                            <div class="d-flex align-item-center justify-content">
                                                <i class="bx bx-xs bx-user me-2 mt-1 pb-1"></i>
                                                <p class="mb-0">
                                                    {{ $skripsi->mahasiswa->nama }}
                                                    ({{ $skripsi->mahasiswa->npm }})
                                                </p>
                                            </div>
                                            <div class="d-flex align-item-center justify-content">
                                                <i class="bx bx-xs bx-calendar me-2 mt-1 pb-1"></i>
                                                <p class="mb-0">
                                                    {{ \Carbon\Carbon::parse($jadwal->tanggal)->locale('id_ID')->isoFormat('dddd, D MMMM YYYY') }}
                                                </p>
                                            </div>
                                            <div class="d-flex align-item-center justify-content">
                                                <i class="bx bx-xs bx-time me-2 mt-1 pb-1"></i>
                                                <p class="mb-0">
                                                    Pukul
                                                    {{ \Carbon\Carbon::parse($jadwal->tanggal)->locale('id_ID')->isoFormat('H:mm') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @endforeach
                        @else
                            <div class="card" style="background-color: var(--bs-gray);">
                                <div class="mb-2 mt-2">
                                    <div class="mx-3 mb-auto">
                                        <p class="text-muted my-5 text-center">Belum Ada Pengumuman</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex flex-column flex-md-row">
                    <div class="head-label text">
                        <h4 class="card-title mb-0">Data Progres Skripsi Mahasiswa</h4>
                    </div>
                </div>
                <?php $no = 1; ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Mahasiswa</th>
                                <th>Judul Skripsi</th>
                                <th>Progres</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($skripsis as $skripsi)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>
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
                                            <div class="d-flex flex-column" data-bs-toggle="modal"
                                                data-bs-target="#{{ $skripsi->mahasiswa->npm }}"
                                                style="cursor: pointer;">
                                                <strong
                                                    class="mb-0 pointer-cursor">{{ $skripsi->mahasiswa->npm }}</strong>
                                                <span
                                                    class="emp_name text-truncate pointer-cursor">{{ $skripsi->mahasiswa->nama }}</span>
                                            </div>
                                            <div class="modal fade" id="{{ $skripsi->mahasiswa->npm }}" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable modal-lg"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalScrollableTitle">Riwayat
                                                                Bimbingan</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="d-flex justify-content-center mb-3">
                                                                <div
                                                                    class="d-flex align-items-start align-items-sm-center gap-4">
                                                                    @if ($skripsi->mahasiswa->foto)
                                                                        <!-- Jika ada foto, tampilkan foto -->
                                                                        <img src="{{ url('Foto Mahasiswa') . '/' . $skripsi->mahasiswa->foto }}"
                                                                            alt="user-avatar" class="d-block rounded"
                                                                            height="100" width="100"
                                                                            id="uploadedAvatar" />
                                                                    @else
                                                                        <div class="card rounded bg-label-dark"
                                                                            style="height: 100px; width: 100px; display: flex; align-items: center; justify-content: center;">
                                                                            <h1 class="mb-0"><strong>
                                                                                    {{ generateInitials($skripsi->mahasiswa->nama) }}
                                                                                </strong></h1>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="text-center">
                                                                <h3 class="mb-0" style="font-weight: lighter">
                                                                    {{ $skripsi->mahasiswa->nama }}</h3>
                                                                <p class=" mb-0 text-muted">
                                                                    {{ $skripsi->mahasiswa->email }}</p>
                                                                <div class="text-dark" style="font-weight: bold">
                                                                    <p class="mb-0 d-inline">
                                                                        {{ $skripsi->mahasiswa->npm }}</p>
                                                                    </h6>
                                                                    <span class="mx-1">&#124;</span>
                                                                    <p class="mb-0 d-inline">Semester
                                                                        {{ $skripsi->mahasiswa->semester }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="divider">
                                                                <div class="divider-text">
                                                                    <h5 class="mb-0"><strong>Skripsi</strong></h5>
                                                                </div>
                                                            </div>
                                                            <div class="card-body pt-0 mx-sm-3">
                                                                <div class="row">
                                                                    <div class="d-flex justify-content-between">
                                                                        <div class="col-3 d-flex justify-content-between">
                                                                            <p>Judul</p>
                                                                            <p class="me-2">:</p>
                                                                        </div>
                                                                        <div class="col-9">
                                                                            <p class="text-break">{{ $skripsi->judul }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex justify-content-between">
                                                                        <div class="col-3 d-flex justify-content-between">
                                                                            <p>Progres</p>
                                                                            <p class="me-2">:</p>
                                                                        </div>
                                                                        <div class="col-9">
                                                                            <div class="d-flex align-items-center">
                                                                                <div div="" class="progress"
                                                                                    style="height: 8px; min-width: 75px">
                                                                                    <div class="progress-bar"
                                                                                        role="progressbar"
                                                                                        style="width:{{ $skripsi->progres }}%;
                                                                                            @if ($skripsi->progres == 0) background-color: #8592a3;
                                                                                            @elseif($skripsi->progres >= 1 && $skripsi->progres <= 50)
                                                                                                background-color: #ffab00;
                                                                                            @elseif($skripsi->progres >= 51 && $skripsi->progres <= 99)
                                                                                                background-color: #007bff;
                                                                                            @else
                                                                                                background-color: #71dd37; @endif"
                                                                                        aria-valuenow="{{ $skripsi->progres }}"
                                                                                        aria-valuemin="0"
                                                                                        aria-valuemax="100">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="text-body ms-3">
                                                                                    {{ $skripsi->progres }}%
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex justify-content-between">
                                                                        <div
                                                                            class="col-6 col-md-3 d-flex justify-content-between">
                                                                            <p>Pembimbing 1</p>
                                                                            <p class="me-2">:</p>
                                                                        </div>
                                                                        <div class="col-6 col-md-9">
                                                                            <p>{{ $skripsi->dosen1->nama }}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex justify-content-between">
                                                                        <div
                                                                            class="col-6 col-md-3 d-flex justify-content-between">
                                                                            <p>Pembimbing 2</p>
                                                                            <p class="me-2">:</p>
                                                                        </div>
                                                                        <div class="col-6 col-md-9">
                                                                            <p>{{ $skripsi->dosen2->nama }}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="divider">
                                                                <div class="divider-text">
                                                                    <h5 class="mb-0"><strong>Bimbingan</strong></h5>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                @if ($skripsi->bimbingans->count() > 0)
                                                                    @foreach ($skripsi->bimbingans as $index => $bimbingan)
                                                                        <div class="mb-4">
                                                                            <div
                                                                                class="d-flex justify-content-between align-items-center mb-2">
                                                                                <h6 class="mb-0 ">
                                                                                    <strong>{{ $bimbingan->nama }}</strong>
                                                                                </h6>
                                                                                <h6 id="tanggal-riwayat-{{ $index }}"
                                                                                    class="mb-0">
                                                                                    {{ \Carbon\Carbon::parse($bimbingan->tanggal)->locale('id_ID')->isoFormat('dddd, D MMMM YYYY') }}
                                                                                </h6>
                                                                            </div>
                                                                            <div class="card ms-md-4 p-3"
                                                                                style="background-color: {{ getStatusColor($bimbingan->status) }};">
                                                                                <div class="row">
                                                                                    <div
                                                                                        class="col-5 col-sm-6 col-md-8 col-lg-8 col-xl-8">
                                                                                        @if ($bimbingan->subbab)
                                                                                            <h6 class="mb-0 text-white">
                                                                                                <strong>Bab
                                                                                                    {{ $bimbingan->subbab->nama }}</strong>
                                                                                            </h6>
                                                                                        @elseif($bimbingan->bab)
                                                                                            <h6 class="mb-0 text-white"
                                                                                                style="white-space: nowrap; overflow: hidden;text-overflow: ellipsis;">
                                                                                                <strong>{{ $bimbingan->bab->nama }}</strong>
                                                                                            </h6>
                                                                                        @endif
                                                                                    </div>
                                                                                    <div
                                                                                        class="col-7 col-sm-6 col-md-4 col-lg-4 col-xl-4 d-flex justify-content-between align-items-center">
                                                                                        <h6
                                                                                            class="m-0 me-4 text-end text-white">
                                                                                            {{ $bimbingan->dosen->nama }}
                                                                                        </h6>
                                                                                        <h6
                                                                                            class="m-0 text-end text-white">
                                                                                            <strong>{{ ucwords($bimbingan->status) }}</strong>
                                                                                        </h6>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                @else
                                                                    <p class="text-muted my-5 text-center">
                                                                        Mahasiswa belum Melakukan Bimbingan</p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-secondary"
                                                                data-bs-dismiss="modal">
                                                                Close
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-nowrap">{{ $skripsi->judul }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div div="" class="progress" style="height: 8px; min-width: 75px">
                                                <div class="progress-bar" role="progressbar"
                                                    style="width:{{ $skripsi->progres }}%;
                                            @if ($skripsi->progres == 0) background-color: #8592a3;
                                            @elseif($skripsi->progres >= 1 && $skripsi->progres <= 50)
                                                background-color: #ffab00;
                                            @elseif($skripsi->progres >= 51 && $skripsi->progres <= 99)
                                                background-color: #007bff;
                                            @else
                                                background-color: #71dd37; @endif"
                                                    aria-valuenow="{{ $skripsi->progres }}" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                            <div class="text-body ms-3">{{ $skripsi->progres }}%</div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
