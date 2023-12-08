@extends('layout.layout-mahasiswa')

@section('title', 'Skripsi')

@section('main')
    <div class="row">
        @foreach ($babs as $bab)
            <div class="col-12">
                <div class="card mb-2">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="text-bold mb-0"><strong>{{ $bab->nama }}</strong></h5>
                            <i class="bx bx-sm bx-chevron-down px-2" data-bs-toggle="collapse" href="#subbab{{ str_replace(' ', '_', $bab->nama) }}"
                                role="button" aria-expanded="false" aria-controls="subbab{{ str_replace(' ', '_', $bab->nama) }}"
                                @if ($subbabs->where('bab_id', $bab->id)->isNotEmpty()) style="display: block;"
                                @else
                                    style="display: none;" @endif>
                            </i>
                        </div>
                        {{-- <div>
                            <a class="btn btn-sm btn-success me-1" data-bs-toggle="collapse" href="#{{ str_replace(' ', '_', $bab->nama) }}" role="button"
                                aria-expanded="false" aria-controls="{{ str_replace(' ', '_', $bab->nama) }}">
                                Detail
                            </a>
                        </div> --}}
                    </div>
                    <div class="card-body pb-0">
                        <div class="card-body collapse px-0 pt-0 pb-3" id="subbab{{ str_replace(' ', '_', $bab->nama) }}">
                            @if ($subbabs->where('bab_id', $bab->id)->isNotEmpty())
                                <ul>
                                    @foreach ($subbabs->where('bab_id', $bab->id) as $subbab)
                                        <h6><strong>{{ $subbab->nama }}</strong></h6>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                        {{-- <div class="card-body collapse px-0 pt-0 pb-4" id="{{ str_replace(' ', '_', $bab->nama) }}">
                            <ul class="mb-1">
                                <li>
                                    <small class="mb-1">Dosen {{ $dosen1->nama }} <span class="text-success">ACC</span>
                                        pada
                                        Senin, 27 November 2023</small>
                                </li>
                                <li>
                                    <small class="mb-1">Dosen {{ $dosen2->nama }} <span class="text-success">ACC</span>
                                        pada
                                        Selasa, 28 November 2023</small>
                                </li>
                            </ul>
                        </div> --}}
                    </div>
                </div>
            </div>
        @endforeach
        <div class="col-12">
            <div class="card mb-2">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="text-bold mb-0"><strong>Bab 6</strong></h5>
                        <i class="bx bx-sm bx-lock-alt px-2" data-bs-toggle="collapse" href="#subBab6" role="button"
                            aria-expanded="false" aria-controls="subBab6"></i>
                    </div>
                    <div>
                        <a class="btn btn-sm btn-secondary me-1" data-bs-toggle="collapse" href="#detailBab6"
                            role="button" aria-expanded="false" aria-controls="detailBab6" disabled>
                            Detail
                        </a>
                    </div>
                </div>
                <div class="card-body pb-0">
                    <div class="card-body collapse px-0 pt-0 pb-3" id="subBab6">
                        <ul>
                            <h6><strong>6.1 Latar Belakang</strong></h6>
                            <h6><strong>6.2 Rumusan Masalah</strong></h6>
                            <h6><strong>6.3 Batasan Masalah</strong></h6>
                            <h6><strong>6.4 Tujuan Penelitian</strong></h6>
                        </ul>
                    </div>
                    <div class="card-body collapse px-0 pt-0 pb-4" id="detailBab6">
                        <ul class="mb-1">
                            <li>
                                <small class="mb-1">Dosen {{ $dosen1->nama }} <span class="text-success">ACC</span>
                                    pada
                                    Senin, 27 November 2023</small>
                            </li>
                            <li>
                                <small class="mb-1">Dosen {{ $dosen2->nama }} <span class="text-success">ACC</span>
                                    pada
                                    Selasa, 28 November 2023</small>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
