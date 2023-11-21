@extends('layout.layout-admin')

@section('title', 'Jadwal Sidang')

@section('main')
    <div class="card">
        <div class="card-header d-flex flex-column flex-md-row">
            <div class="head-label text">
                <h4 class="card-title mb-0">Jadwal Sidang Skripsi</h4>
            </div>
            <div class="dt-action-buttons text-end pt-3 pt-md-0 ms-md-auto">
                <div class="dt-buttons">
                    <button class="dt-button create-new btn btn-primary" tabindex="0" aria-controls="DataTables_Table_0"
                        type="button" onclick="window.location.href='{{ route('jadwal-sidang.tambah') }}'">
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
                        <th>no</th>
                        <th>Tanggal</th>
                        <th>Mahasiswa</th>
                        <th>Skripsi</th>
                        <th>Pembimbing</th>
                        <th>Keterangan</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($jadwals as $jadwal)
                        <tr>
                            <td>{{ $jadwal->id }}</td>
                            <td class="{{ \Carbon\Carbon::parse($jadwal->tanggal)->isSameDay(now()) ? 'text-primary' : (\Carbon\Carbon::parse($jadwal->tanggal)->lt(now()) ? 'text-muted' : 'text-success') }}">
                                <strong>{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('Y-m-d') }}</strong>
                                <br>
                                <span>{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('H:i') }}</span>
                            </td>
                            <td class="" style="">
                                <div class="d-flex justify-content-start align-items-center user-name">
                                    <div class="avatar-wrapper">
                                        <div class="avatar me-2">
                                            @if ($jadwal->skripsi->mahasiswa->foto)
                                                <!-- Jika ada foto, tampilkan foto -->
                                                <div class="avatar-popup">
                                                    @if ($jadwal->skripsi->mahasiswa->foto)
                                                        <img class=""
                                                            src="{{ asset('Foto Mahasiswa') . '/' . $jadwal->skripsi->mahasiswa->foto }}"
                                                            alt="{{ $jadwal->skripsi->mahasiswa->nama }} Avatar"
                                                            style="min-width: 100px; min-height: 100px;">
                                                    @endif
                                                </div>
                                                <img class="avatar-initial rounded-circle bg-label-dark"
                                                    src="{{ url('Foto Mahasiswa') . '/' . $jadwal->skripsi->mahasiswa->foto }}" />
                                            @else
                                                <!-- Jika tidak ada foto, tampilkan inisial -->
                                                <span class="avatar-initial rounded-circle bg-label-dark">
                                                    {{ generateInitials($jadwal->skripsi->mahasiswa->nama) }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <strong class="mb-0">{{ $jadwal->skripsi->mahasiswa->npm }}</strong>
                                        <span class="emp_name text-truncate">{{ $jadwal->skripsi->mahasiswa->nama }}</span>
                                    </div>
                                </div>
                            </td>
                            <td><span>{{ $jadwal->skripsi->judul }}</span></td>
                            <td>
                                <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                    @if ($jadwal->skripsi->dosen1)
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            class="avatar avatar-sm pull-up" title="{{ $jadwal->skripsi->dosen1->nama }}">
                                            @if ($jadwal->skripsi->dosen1->foto)
                                                <img src="{{ url('Foto Dosen') . '/' . $jadwal->skripsi->dosen1->foto }}"
                                                    alt="Avatar" class="rounded-circle" />
                                            @else
                                                <span class="avatar-initial rounded-circle bg-label-dark">
                                                    {{ generateInitials($jadwal->skripsi->dosen1->nama) }}
                                                </span>
                                            @endif
                                        </li>
                                    @endif
                                    {{-- Display Dosen 2 --}}
                                    @if ($jadwal->skripsi->dosen2)
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            class="avatar avatar-sm pull-up" title="{{ $jadwal->skripsi->dosen2->nama }}">
                                            @if ($jadwal->skripsi->dosen2->foto)
                                                <img src="{{ url('Foto Dosen') . '/' . $jadwal->skripsi->dosen2->foto }}"
                                                    alt="Avatar" class="rounded-circle" />
                                            @else
                                                <span class="avatar-initial rounded-circle bg-label-dark">
                                                    {{ generateInitials($jadwal->skripsi->dosen2->nama) }}
                                                </span>
                                            @endif
                                        </li>
                                    @endif
                                </ul>
                            </td>
                            <td>{{ $jadwal->keterangan }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('jadwal-sidang.edit',$jadwal->id) }}"><i
                                                class="bx bx-edit-alt me-1"></i>
                                            Edit</a>
                                        <form id="formHapusMahasiswa" action="{{ route('jadwal-sidang.hapus',$jadwal->id) }}" method="POST"
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
