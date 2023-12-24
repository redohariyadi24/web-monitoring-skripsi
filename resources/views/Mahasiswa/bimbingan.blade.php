@extends('layout.layout-mahasiswa')

@section('title', 'Bimbingan')

@section('main')
    <div class="row">
        <div class="col-12">
            @if (session('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-10 col-lg-10 col-xl-11 mx-auto">
            @if ($terbaruBimbingan)
                <div class="card mb-4" style="background-color: {{ getStatusColor($terbaruBimbingan->status) }};">
                    <div class="card-header text-white d-flex justify-content-between align-items-center pb-2 pt-4">
                        <h5 class="me-auto mb-0 text-white"><strong>{{ $terbaruBimbingan->nama }} </strong></h5>
                        <p id="tanggal-terbaru" class="mb-0 text-end"></p>
                    </div>
                    <div class="card mx-4 mb-4">
                        <div class="row p-3 d-flex justify-content-between align-items-center">
                            <div class="col-7 col-md-7 col-lg-8">
                                @if ($terbaruBimbingan->subbab)
                                    <h6 class="mb-1"><strong>Bab {{ $terbaruBimbingan->subbab->nama }}</strong></h6>
                                @elseif ($terbaruBimbingan->bab)
                                    <h6 class="mb-1"><strong>{{ $terbaruBimbingan->bab->nama }}</strong></h6>
                                @else
                                    <h6 class="mb-1"><strong>No Bab/Subbab specified</strong></h6>
                                @endif
                                <h6 class="mb-0">Pembimbing {{ $terbaruBimbingan->dosen->nama }}</h6>
                            </div>
                            <div class="col-5 col-md-5 col-lg-4 text-end">
                                <h6 class="m-0" style="color: {{ getStatusColor($terbaruBimbingan->status) }}">
                                    <strong>{{ ucwords($terbaruBimbingan->status) }}</strong>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="card" style="background-color: var(--bs-gray);">
                    <div class="mb-4 mt-3">
                        <div class="mx-3 mb-auto">
                            <p class="text-muted my-5 text-center">Belum Ada Bimbingan</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="col-12">
            <div class="">
                <div class="card-header pb-0">
                    <div>
                        <h3 class="">Riwayat Bimbingan</h3>
                    </div>
                    <div class="dropdown-divider pb-2">
                    </div>
                </div>
                @if ($riwayatBimbingan)
                    @foreach ($riwayatBimbingan as $index => $bimbingan)
                        <div class="card-body pt-0 pb-3">
                            <div class="">
                                <div class="d-flex mb-1">
                                    <h5 class="mb-0 me-4"><strong>{{ $bimbingan->nama }}</strong></h5>
                                    <p id="tanggal-riwayat-{{ $index }}" class="mb-0"></p>
                                </div>
                                <div class="card ms-md-4 p-3">
                                    <div class="row">
                                        <div class="col-6 col-sm-6 col-md-8 col-lg-8 col-xl-8">
                                            @if ($bimbingan->subbab)
                                                <h6 class="mb-0"><strong>Bab {{ $bimbingan->subbab->nama }}</strong></h6>
                                            @elseif ($bimbingan->bab)
                                                <h6 class="mb-0"><strong>{{ $bimbingan->bab->nama }}</strong></h6>
                                            @else
                                                <h6 class="mb-0"><strong>No Bab/Subbab specified</strong></h6>
                                            @endif
                                        </div>
                                        <div
                                            class="col-6 col-sm-6 col-md-4 col-lg-4 col-xl-4 d-flex justify-content-between align-items-center">
                                            <h6 class="m-0 me-4" style="white-space: nowrap; overflow: hidden;text-overflow: ellipsis;">{{ $bimbingan->dosen->nama }}</h6>
                                            <h6 class="m-0" style="color: {{ getStatusColor($bimbingan->status) }}">
                                                <strong>{{ ucwords($bimbingan->status) }}</strong>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="card" style="background-color: var(--bs-gray);">
                        <div class="mb-4 mt-3">
                            <div class="mx-3 mb-auto">
                                <p class="text-muted my-5 text-center">Belum Ada Bimbingan</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Get the formatted date for terbaruBimbingan
            var dateTerbaruBimbingan = "{{ optional($terbaruBimbingan)->tanggal }}";
            if (dateTerbaruBimbingan) {
                var formattedDateTerbaruBimbingan = formatDate(dateTerbaruBimbingan);
                document.getElementById("tanggal-terbaru").textContent = formattedDateTerbaruBimbingan;
            }

            // Get the formatted date for each riwayatBimbingan
            @foreach ($riwayatBimbingan as $index => $bimbingan)
                var dateRiwayatBimbingan{{ $index }} = "{{ optional($bimbingan)->tanggal }}";
                if (dateRiwayatBimbingan{{ $index }}) {
                    var formattedDateRiwayatBimbingan{{ $index }} = formatDate(
                        dateRiwayatBimbingan{{ $index }});
                    document.getElementById("tanggal-riwayat-{{ $index }}").textContent =
                        formattedDateRiwayatBimbingan{{ $index }};
                }
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
