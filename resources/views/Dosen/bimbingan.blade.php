@extends('layout.layout-dosen')

@section('title', 'Bimbingan')

@section('main')
    <div class="row">
        @foreach ($skripsis as $skripsi)
            @php
                $bimbingansMenungguKonfirmasi = $skripsi->bimbingans->where('status', 'menunggu konfirmasi');
            @endphp
            @if ($bimbingansMenungguKonfirmasi->count() > 0)
                <div class="col-12 mx-auto">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center p-3">
                            <!-- Informasi Mahasiswa yang melakukan bimbingan -->
                            <div class="col-8">
                                <div class="d-flex justify-content-start align-items-center user-name">
                                    <div class="avatar-wrapper">
                                        <div class="avatar me-2">
                                            @if ($skripsi->mahasiswa->foto)
                                                <!-- Jika ada foto, tampilkan foto -->
                                                <div class="avatar-popup">
                                                    <img class=""
                                                        src="{{ asset('Foto Mahasiswa') . '/' . $skripsi->mahasiswa->foto }}"
                                                        alt="{{ $skripsi->mahasiswa->nama }} Avatar"
                                                        style="min-width: 100px; min-height: 100px;">
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
                                        <strong class="mb-0">{{ $skripsi->mahasiswa->nama }}</strong>
                                        <span class="emp_name text-truncate">{{ $skripsi->mahasiswa->npm }}</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Tombol Lihat Riwayat -->
                            <div class="col-4 text-end">
                                <button type="button" class="btn btn-sm btn-secondary">Lihat Riwayat</button>
                            </div>
                        </div>
                        <div class="card-body p-2"
                            style="background-color: rgb(218, 218, 218); border-radius:0rem 0rem 0.5rem 0.5rem;">
                            <!-- Informasi Bimbingan yang statusnya masih 'menunggu konfirmasi' -->
                            @foreach ($bimbingansMenungguKonfirmasi as $bimbingan)
                                <div
                                    class="card-header text-dark d-flex justify-content-between align-items-center pb-2 pt-2">
                                    <h5 class="mb-0"><strong>{{ $bimbingan->nama }}</strong></h5>
                                    <p class="mb-0 text-end">{{ $bimbingan->created_at->format('l, d F Y') }}</p>
                                </div>
                                <div class="card mx-3 mb-3">
                                    <div class="row p-3 d-flex justify-content-between align-items-center">
                                        <div class="col-7 col-md-7 col-lg-8">
                                            @if ($bimbingan->subbab)
                                                <h6 class="mb-0"><strong>Bab {{ $bimbingan->subbab->nama }}</strong></h6>
                                            @elseif ($bimbingan->bab)
                                                <h6 class="mb-0"><strong>{{ $bimbingan->bab->nama }}</strong></h6>
                                            @else
                                                <h6 class="mb-0"><strong>No Bab/Subbab specified</strong></h6>
                                            @endif
                                        </div>
                                        <div class="col-5 col-md-5 col-lg-4 text-end">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <form method="POST" action="{{ route('hasil-bimbingan') }}">
                                                    @csrf
                                                    <input type="hidden" name="bimbingan_id" value="{{ $bimbingan->id }}">
                                                    <input type="hidden" name="hasil" value="acc">
                                                    <button type="submit" class="btn btn-success btn-sm me-1">ACC</button>
                                                </form>

                                                <form method="POST" action="{{ route('hasil-bimbingan') }}">
                                                    @csrf
                                                    <input type="hidden" name="bimbingan_id" value="{{ $bimbingan->id }}">
                                                    <input type="hidden" name="hasil" value="revisi">
                                                    <button type="submit" class="btn btn-warning btn-sm">Revisi</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
@endsection
