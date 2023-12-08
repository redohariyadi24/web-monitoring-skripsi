@extends('layout.layout-dosen')

@section('title', 'Beranda')

@section('main')
    <div class="row">
        <div class="col-12 col-sm-12 col-md-6 col-lg-8 mb-4 order-0">
            <div class="card">
                <div class="card-body">

                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3 col-lg-2 mb-4 order-0">
            <div class="card">
                <div class="card-body">

                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3 col-lg-2 mb-4 order-0">
            <div class="card">
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">

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
                <div class="table-responsive text-nowrap">
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
                                            <div class="d-flex flex-column">
                                                <strong class="mb-0">{{ $skripsi->mahasiswa->npm }}</strong>
                                                <span class="emp_name text-truncate">{{ $skripsi->mahasiswa->nama }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $skripsi->judul }}</td>
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
