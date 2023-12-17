@extends('layout.layout-dosen')

@section('title', 'Bimbingan')

@section('main')
    <div class="row">
        <div class="col-12">
            @if (session('message'))
                @if (session('message') == 'Bimbingan berhasil di ACC')
                    <div class="alert alert-success alert-dismissible" role="alert">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif(session('message') == 'Hasil Bimbingan adalah Revisi')
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            @endif
        </div>
    </div>
    <div class="row">
        @if ($bimbingans->count() > 0)
            @foreach ($bimbingans as $bimbingan)
                <div class="col-12 mx-auto">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center p-3">
                            <!-- Informasi Mahasiswa yang melakukan bimbingan -->
                            <div class="col-8">
                                <div class="d-flex justify-content-start align-items-center user-name">
                                    <div class="avatar-wrapper">
                                        <div class="avatar me-2">
                                            @if ($bimbingan->mahasiswa->foto)
                                                <!-- Jika ada foto, tampilkan foto -->
                                                <div class="avatar-popup">
                                                    <img class=""
                                                        src="{{ asset('Foto Mahasiswa') . '/' . $bimbingan->mahasiswa->foto }}"
                                                        alt="{{ $bimbingan->mahasiswa->nama }} Avatar"
                                                        style="min-width: 100px; min-height: 100px;">
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
                                        <strong class="mb-0">{{ $bimbingan->mahasiswa->nama }}</strong>
                                        <span class="emp_name text-truncate">{{ $bimbingan->mahasiswa->npm }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal"
                                    data-bs-target="#{{ $bimbingan->mahasiswa->npm }}">Lihat Riwayat</button>
                            </div>
                            <div class="modal fade" id="{{ $bimbingan->mahasiswa->npm }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalScrollableTitle">Riwayat Bimbingan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="d-flex justify-content-center mb-3">
                                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                                    @if ($bimbingan->mahasiswa->foto)
                                                        <!-- Jika ada foto, tampilkan foto -->
                                                        <img src="{{ url('Foto Mahasiswa') . '/' . $bimbingan->mahasiswa->foto }}"
                                                            alt="user-avatar" class="d-block rounded" height="100"
                                                            width="100" id="uploadedAvatar" />
                                                    @else
                                                        <div class="card rounded bg-label-dark"
                                                            style="height: 100px; width: 100px; display: flex; align-items: center; justify-content: center;">
                                                            <h1 class="mb-0"><strong>
                                                                    {{ generateInitials($bimbingan->mahasiswa->nama) }}
                                                                </strong></h1>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <h3 class="mb-0" style="font-weight: lighter">
                                                    {{ $bimbingan->mahasiswa->nama }}</h3>
                                                <p class=" mb-0 text-muted">{{ $bimbingan->mahasiswa->email }}</p>
                                                <div class="text-dark" style="font-weight: bold">
                                                    <p class="mb-0 d-inline">{{ $bimbingan->mahasiswa->npm }}</p>
                                                    </h6>
                                                    <span class="mx-1">&#124;</span>
                                                    <p class="mb-0 d-inline">Semester {{ $bimbingan->mahasiswa->semester }}
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
                                                        <div class="col-4 d-flex justify-content-between">
                                                            <p>Judul</p>
                                                            <p class="me-2">:</p>
                                                        </div>
                                                        <div class="col-8">
                                                            <p>{{ $bimbingan->skripsi->judul }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <div class="col-4 d-flex justify-content-between">
                                                            <p>Progres</p>
                                                            <p class="me-2">:</p>
                                                        </div>
                                                        <div class="col-8">
                                                            <div class="d-flex align-items-center">
                                                                <div div="" class="progress"
                                                                    style="height: 8px; min-width: 75px">
                                                                    <div class="progress-bar" role="progressbar"
                                                                        style="width:{{ $bimbingan->skripsi->progres }}%;
                                                                    @if ($bimbingan->skripsi->progres == 0) background-color: #8592a3;
                                                                    @elseif($bimbingan->skripsi->progres >= 1 && $bimbingan->skripsi->progres <= 50)
                                                                        background-color: #ffab00;
                                                                    @elseif($bimbingan->skripsi->progres >= 51 && $bimbingan->skripsi->progres <= 99)
                                                                        background-color: #007bff;
                                                                    @else
                                                                        background-color: #71dd37; @endif"
                                                                        aria-valuenow="{{ $bimbingan->skripsi->progres }}"
                                                                        aria-valuemin="0" aria-valuemax="100">
                                                                    </div>
                                                                </div>
                                                                <div class="text-body ms-3">
                                                                    {{ $bimbingan->skripsi->progres }}%
                                                                </div>
                                                            </div>
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
                                                @foreach ($riwayatmahasiswas[$bimbingan->mahasiswa->id]['riwayatBimbingans'] as $index => $riwayatBimbingan)
                                                    <div class="mb-4">
                                                        <div
                                                            class="d-flex justify-content-between align-items-center mb-2">
                                                            <h6 class="mb-0 ">
                                                                <strong>{{ $riwayatBimbingan->nama }}</strong>
                                                            </h6>
                                                            <h6 class="mb-0">
                                                                {{ \Carbon\Carbon::parse(optional($riwayatBimbingan)->tanggal)->locale('id_ID')->isoFormat('dddd, D MMMM YYYY') }}
                                                            </h6>
                                                        </div>
                                                        <div class="card ms-md-4 p-3"
                                                            style="background-color: {{ getStatusColor($riwayatBimbingan->status) }};">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <div>
                                                                    @if ($riwayatBimbingan->subbab)
                                                                        <h6 class="mb-0 text-white"><strong>Bab
                                                                                {{ $riwayatBimbingan->subbab->nama }}</strong>
                                                                        </h6>
                                                                    @elseif ($riwayatBimbingan->bab)
                                                                        <h6 class="mb-0 text-white">
                                                                            <strong>{{ $riwayatBimbingan->bab->nama }}</strong>
                                                                        </h6>
                                                                    @endif
                                                                </div>
                                                                <div>
                                                                    <h6 class="m-0 text-end text-white">
                                                                        <strong>{{ ucwords($riwayatBimbingan->status) }}</strong>
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
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
                        <div class="card-body p-2"
                            style="background-color: rgb(218, 218, 218); border-radius:0rem 0rem 0.5rem 0.5rem;">
                            <!-- Informasi Bimbingan yang statusnya masih 'menunggu konfirmasi' -->
                            <div class="card-header text-dark d-flex justify-content-between align-items-center pb-2 pt-2">
                                <h5 class="mb-0"><strong>{{ $bimbingan->nama }}</strong></h5>
                                <p class="mb-0 text-end" id="tanggal-{{ $loop->index }}">{{ $bimbingan->tanggal }}</p>
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
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12 mx-auto">
                <div class="mb-4 mt-3" style="height: 70vh;">
                    <div class="mx-3 mb-auto">
                        <p class="text-muted my-5 text-center">Belum Ada Mahasiswa yang Melakukan Bimbingan</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @foreach ($bimbingans as $index => $bimbingan)
                var tanggalElement{{ $index }} = document.getElementById("tanggal-{{ $index }}");
                var tanggalValue{{ $index }} = tanggalElement{{ $index }}.textContent;

                if (tanggalValue{{ $index }}) {
                    var formattedDate{{ $index }} = formatDate(tanggalValue{{ $index }});
                    tanggalElement{{ $index }}.textContent = formattedDate{{ $index }};
                }
            @endforeach

            // Function to format date
            function formatDate(dateString) {
                var currentDate = new Date(dateString);
                console.log("Input Date:", dateString);
                var monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus",
                    "September", "Oktober", "November", "Desember"
                ];

                var dayName = getDayName(currentDate.getDay());
                var day = currentDate.getDate();
                var month = monthNames[currentDate.getMonth()];
                var year = currentDate.getFullYear();

                return dayName + ", " + day + " " + month + " " + year;
            }

            // Function to get day name
            function getDayName(dayIndex) {
                var dayNames = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
                return dayNames[dayIndex];
            }
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @foreach ($riwayatmahasiswas as $riwayatmahasiswa)
                @foreach ($riwayatmahasiswa['riwayatBimbingans'] as $index => $riwayatBimbingan)
                    var dateRiwayatBimbingan{{ $index }} = "{{ optional($riwayatBimbingan)->tanggal }}";
                    if (dateRiwayatBimbingan{{ $index }}) {
                        var formattedDateRiwayatBimbingan{{ $index }} = formatDate(
                            dateRiwayatBimbingan{{ $index }});
                        document.getElementById("tanggal-riwayat-{{ $index }}").textContent =
                            formattedDateRiwayatBimbingan{{ $index }};
                    }
                @endforeach
            @endforeach
        });

        // Function to format date
        function formatDate(dateString) {
            var currentDate = new Date(dateString);
            var monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus",
                "September", "Oktober", "November", "Desember"
            ];

            var dayName = getDayName(currentDate.getDay());
            var day = currentDate.getDate();
            var month = monthNames[currentDate.getMonth()];
            var year = currentDate.getFullYear();

            return dayName + ", " + day + " " + month + " " + year;
        }

        // Function to get day name
        function getDayName(dayIndex) {
            var dayNames = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
            return dayNames[dayIndex];
        }
    </script>
@endsection
