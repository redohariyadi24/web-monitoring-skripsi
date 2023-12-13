@extends('layout.layout-mahasiswa')

@section('title', 'Skripsi')

@section('main')
    <div class="row">
        @foreach ($babs as $bab)
            <div class="col-12">
                <div class="card mb-2">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="text-bold mb-0" style="color: {{ $babColors[$bab->id]['babColor'] ?? '' }}">
                                <strong>{{ $bab->nama }}</strong>
                            </h5>
                            <i class="bx bx-sm bx-chevron-down px-2" data-bs-toggle="collapse"
                                href="#subbab{{ str_replace(' ', '_', $bab->nama) }}" role="button" aria-expanded="false"
                                aria-controls="subbab{{ str_replace(' ', '_', $bab->nama) }}"
                                @if ($subbabs->where('bab_id', $bab->id)->isNotEmpty()) style="display: block;" @else
                    style="display: none;" @endif>
                            </i>
                        </div>
                        <div>
                            @if ($accs->where('bab_id', $bab->id)->isNotEmpty())
                                @php
                                    $subbabsExist = $accs
                                        ->where('bab_id', $bab->id)
                                        ->whereNotNull('subbab_id')
                                        ->isNotEmpty();
                                @endphp

                                @if ($subbabsExist)
                                    <a class="btn btn-sm btn-success me-1" data-bs-toggle="collapse"
                                        href="#sub{{ str_replace(' ', '_', $bab->nama) }}" role="button" aria-expanded="false"
                                        aria-controls="sub{{ str_replace(' ', '_', $bab->nama) }}">
                                        Detail
                                    </a>
                                @else
                                    <a class="btn btn-sm btn-success me-1" data-bs-toggle="collapse"
                                        href="#{{ str_replace(' ', '_', $bab->nama) }}" role="button" aria-expanded="false"
                                        aria-controls="{{ str_replace(' ', '_', $bab->nama) }}">
                                        Detail
                                    </a>
                                @endif
                            @endif
                        </div>
                    </div>
                    <div class="card-body pb-0">
                        <div class="card-body collapse px-0 pt-0 pb-3" id="subbab{{ str_replace(' ', '_', $bab->nama) }}">
                            @if ($subbabs->where('bab_id', $bab->id)->isNotEmpty())
                                <ul>
                                    @foreach ($subbabs->where('bab_id', $bab->id) as $subbab)
                                        <h6 style="color: {{ $babColors[$bab->id]['subbabColors'][$subbab->id] ?? '' }}">
                                            <strong>{{ $subbab->nama }}</strong>
                                        </h6>
                                        <div class="card-body collapse px-0 pt-0 pb-3"
                                            id="sub{{ str_replace(' ', '_', $bab->nama) }}">
                                            @php
                                                $subbabFoundInAccs = false;
                                            @endphp

                                            @foreach ($accs as $acc)
                                                @if ($acc->subbab_id === $subbab->id)
                                                    @php
                                                        $subbabFoundInAccs = true;
                                                    @endphp
                                                    <li>
                                                        <small class="mb-1">
                                                            Dosen {{ $acc->dosen->nama }}
                                                            <span class="text-success">{{ $acc->status }}</span>
                                                            Bab <span class="">{{ $acc->subbab->nama }}</span>
                                                            pada
                                                            {{ \Carbon\Carbon::parse($acc->updated_at)->locale('id_ID')->isoFormat('dddd, D MMMM YYYY') }}
                                                        </small>
                                                    </li>
                                                @endif
                                            @endforeach

                                            @if (!$subbabFoundInAccs)
                                                <li>
                                                    <small class="mb-1">
                                                        Sub Bab belum di acc
                                                    </small>
                                                </li>
                                            @endif
                                        </div>
                                    @endforeach
                                </ul>
                            @endif

                        </div>
                        <div class="card-body collapse px-0 pt-0 pb-4" id="{{ str_replace(' ', '_', $bab->nama) }}">
                            <ul class="mb-1">
                                @php
                                    $babFoundInAccs = false;
                                @endphp

                                @foreach ($accs as $acc)
                                    @if ($acc->bab_id === $bab->id)
                                        @php
                                            $babFoundInAccs = true;
                                        @endphp
                                        <li>
                                            <small class="mb-1">
                                                Dosen {{ $acc->dosen->nama }}
                                                <span class="text-success">{{ $acc->status }}</span>

                                                @if ($acc->subbab)
                                                    Bab <span class="">{{ $acc->subbab->nama }}</span>
                                                @else
                                                    <span class="">{{ $acc->bab->nama }}</span>
                                                @endif

                                                pada
                                                {{ \Carbon\Carbon::parse($acc->updated_at)->locale('id_ID')->isoFormat('dddd, D MMMM YYYY') }}
                                            </small>
                                        </li>
                                    @endif
                                @endforeach

                                @if (!$babFoundInAccs)
                                    <li>
                                        <small class="mb-1">
                                            Bab belum di acc
                                        </small>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{-- <div class="col-12">
            <div class="card mb-2">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="text-bold mb-0"><strong>Bab 6</strong></h5>
                        <i class="bx bx-sm bx-lock-alt px-2" data-bs-toggle="collapse" href="#subBab6" role="button"
                            aria-expanded="false" aria-controls="subBab6"></i>
                    </div>
                    <div>
                        <a class="btn btn-sm btn-secondary me-1" data-bs-toggle="collapse" href="#detailBab6" role="button"
                            aria-expanded="false" aria-controls="detailBab6" disabled>
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
        </div> --}}
    </div>
@endsection
