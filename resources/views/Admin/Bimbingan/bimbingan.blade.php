@extends('layout.layout-admin')

@section('title', 'Data Bimbingan')

@section('styles')
    @livewireStyles
@endsection

@section('main')
    <div class="card">
        <div class="card-header">
            <div>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
            <div class="d-flex flex-column flex-md-row">
                <div class="head-label text">
                    <h4 class="card-title mb-0">Data Bimbingan</h4>
                </div>
                <div class="d-flex ms-auto me-3">
                    <div class="input-group">
                        <div class="input-group">
                            <span class="input-group-text"><i class="tf-icons bx bx-search"></i></span>
                            <input type="text" wire:model.live="search" class="form-control"
                                placeholder="Cari Bimbingan...">
                        </div>
                    </div>
                </div>
                <div class="dt-action-buttons text-end pt-3 pt-md-0">
                    <div class="dt-buttons">
                        <button class="dt-button create-new btn btn-primary" tabindex="0"
                            aria-controls="DataTables_Table_0" type="button"
                            onclick="window.location.href='{{ route('bimbingan-admin.tambah') }}'">
                            <span>
                                <i class="bx bx-plus me-sm-1"></i>
                                <span class="d-none d-sm-inline-block">Tambah Data</span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Mahasiswa</th>
                        <th>Bimbingan</th>
                        <th>Bab</th>
                        <th>Pembimbing</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <?php
                // Mendapatkan nilai $no dari sesi atau mengatur ke 1 jika tidak ada
                $no = 1;
                ?>
                <tbody class="table-border-bottom-0">
                    @foreach ($bimbingans as $bimbingan)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td class="" style="">
                                <div class="d-flex justify-content-start align-items-center user-name">
                                    <div class="avatar-wrapper">
                                        <div class="avatar me-2">
                                            @if ($bimbingan->mahasiswa->foto)
                                                <!-- Jika ada foto, tampilkan foto -->
                                                <div class="avatar-popup">
                                                    @if ($bimbingan->mahasiswa->foto)
                                                        <img class=""
                                                            src="{{ asset('Foto Mahasiswa') . '/' . $bimbingan->mahasiswa->foto }}"
                                                            alt="{{ $bimbingan->mahasiswa->nama }} Avatar"
                                                            style="min-width: 100px; min-height: 100px;">
                                                    @endif
                                                </div>
                                                <img class="avatar-initial rounded-circle bg-label-dark"
                                                    src="{{ url('Foto Mahasiswa') . '/' . $bimbingan->mahasiswa->foto }}" />
                                            @else
                                                <!-- Jika tidak ada foto, tampilkan inisial -->
                                                <span class="avatar-initial rounded-circle bg-label-dark">
                                                    {{ generateInitials($bimbingan->mahasiswa->nama) }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span class="emp_name text-truncate">{{ $bimbingan->mahasiswa->nama }}</span>
                                        <small
                                            class="emp_post text-truncate text-muted">{{ $bimbingan->mahasiswa->npm }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <strong>{{ $bimbingan->nama }}</strong>
                                    <p class="mb-0">{{ $bimbingan->tanggal }}</p>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if ($bimbingan->subbab)
                                        <p class="mb-0">Bab {{ $bimbingan->subbab->nama }}</p>
                                    @else
                                        <p class="mb-0">{{ $bimbingan->bab->nama }}</p>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <p class="mb-0">{{ $bimbingan->dosen->nama }}</p>
                                </div>
                            </td>
                            <td>
                                @if ($bimbingan->status == 'menunggu konfirmasi')
                                    <span class="badge bg-label-primary">{{ $bimbingan->status }}</span>
                                @elseif($bimbingan->status == 'revisi')
                                    <span class="badge bg-label-warning">{{ $bimbingan->status }}</span>
                                @elseif($bimbingan->status == 'acc')
                                    <span class="badge bg-label-success">{{ $bimbingan->status }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item"
                                            href="{{ route('bimbingan-admin.edit', $bimbingan->id) }}"><i
                                                class="bx bx-edit-alt me-1"></i>
                                            Edit</a>
                                        <form id="formHapusMahasiswa"
                                            action="{{ route('bimbingan-admin.hapus', $bimbingan->id) }}" method="POST"
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
            <div class="demo-inline-spacing mx-3">
                {{-- {{ $dosens->links() }} --}}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @livewireScripts
@endsection
