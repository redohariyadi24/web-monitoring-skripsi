@extends('layout.layout-mahasiswa')

@section('title', 'Beranda')

@section('main')
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-8">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Hallo {{ $user->name }}</h5>
                            <strong>{{ $skripsi->judul }}</strong>
                            <p class="mx-auto">
                                Kamu telah menyelesaikan <span class="fw-bold"
                                    style="color: 
                                    @if ($skripsi->progres == 0) #8592a3; /* abu-abu jika progres 0 */
                                    @elseif($skripsi->progres <= 50) 
                                        #ffab00; /* kuning jika progres 1-50 */
                                    @elseif($skripsi->progres <= 99) 
                                        #007bff; /* biru jika progres 51-99 */
                                    @else
                                        #71dd37; /* hijau jika progres 100 */ @endif">
                                    {{ $skripsi->progres }}%
                                </span> Skripsi kamu.
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-4 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}" height="140"
                                alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                data-app-light-img="illustrations/man-with-laptop-light.png" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6 col-xxl-6 mb-4 ">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Progres Skripsi</h5>
                    </div>
                    <div class="dropdown">
                        <button class="btn p-0" type="button" id="deliveryExceptions" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="deliveryExceptions">
                            <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                            <a class="dropdown-item" href="javascript:void(0);">Share</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="chart1">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xxl-6 mb-4 order-1 order-xxl-3">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xxl-12 mb-4">
                    <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <div class="card-title mb-0">
                                <h5 class="m-0 me-2">Bimbingan</h5>
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="deliveryExceptions" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="deliveryExceptions">
                                    <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Share</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @if ($terbaruBimbingan)
                                <div class="card"
                                    style="background-color: {{ getStatusColor($terbaruBimbingan->status) }}">
                                    <div
                                        class="card-header text-white d-flex justify-content-between align-items-center pb-1 pt-3">
                                        <strong class="me-auto">{{ $terbaruBimbingan->nama }} </strong>
                                        <p id="tanggal-terbaru" class="mb-0 text-end"></p>
                                    </div>
                                    <div class="card mx-3 mb-3">
                                        <div class="row p-3 d-flex justify-content-between align-items-center">
                                            <div class="col-7 col-md-7 col-lg-8">
                                                @if ($terbaruBimbingan->subbab)
                                                    <h6 class="mb-0">Bab {{ $terbaruBimbingan->subbab->nama }}</h6>
                                                @elseif ($terbaruBimbingan->bab)
                                                    <h6 class="mb-0">{{ $terbaruBimbingan->bab->nama }}</h6>
                                                @else
                                                    <h6 class="mb-0">No Bab/Subbab specified</h6>
                                                @endif
                                                <small class="mb-0">Pembimbing
                                                    {{ $terbaruBimbingan->dosen->nama }}</small>
                                            </div>
                                            <div class="col-5 col-md-5 col-lg-4 text-end">
                                                <small class="mb-0"
                                                    style="color: {{ getStatusColor($terbaruBimbingan->status) }};">{{ ucwords($terbaruBimbingan->status) }}</small>
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
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12 col-xxl-12">
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
                                    <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Share</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @php
                                $jumlahJadwal = $jadwals->count();
                            @endphp

                            @if ($jumlahJadwal > 0)
                                @if ($jumlahJadwal > 1)
                                    <!-- Carousel -->
                                    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            @foreach ($jadwals as $index => $jadwal)
                                                <div class="carousel-item @if ($index === 0) active @endif">
                                                    <div class="card bg-success">
                                                        <div class="mb-4 mt-3">
                                                            <div class="mx-3 mb-auto text-white">
                                                                <h5 class="text-white mb-2"><strong
                                                                        class="text-white">{{ $jadwal->jenis }}</strong>
                                                                </h5>
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
                                            @endforeach
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExample" role="button"
                                            data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExample" role="button"
                                            data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </a>
                                    </div>
                                @else
                                    <!-- Tampilkan satu jadwal jika hanya ada satu jadwal -->
                                    <div class="card bg-success">
                                        <div class="mb-4 mt-3">
                                            <div class="mx-3 mb-auto text-white">
                                                <h5 class="text-white mb-2"><strong
                                                        class="text-white">{{ $jadwals[0]->jenis }}</strong></h5>
                                                <div class="d-flex align-item-center justify-content">
                                                    <i class="bx bx-xs bx-calendar me-2 mt-1 pb-1"></i>
                                                    <p class="mb-0">
                                                        {{ \Carbon\Carbon::parse($jadwals[0]->tanggal)->locale('id_ID')->isoFormat('dddd, D MMMM YYYY') }}
                                                    </p>
                                                </div>
                                                <div class="d-flex align-item-center justify-content">
                                                    <i class="bx bx-xs bx-time me-2 mt-1 pb-1"></i>
                                                    <p class="mb-0">
                                                        Pukul
                                                        {{ \Carbon\Carbon::parse($jadwals[0]->tanggal)->locale('id_ID')->isoFormat('H:mm') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @else
                                <!-- Tampilkan pesan jika tidak ada jadwal -->
                                <div class="card" style="background-color: var(--bs-gray);">
                                    <div class="mb-4 mt-3">
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
        </div>
    </div>

@endsection

@section('button')
    <div class="mt-3">
        <div class="add-button">
            <button type="button" class="btn-add-button rounded-pill btn-icon btn-xl" data-bs-toggle="modal"
                data-bs-target="#modalCenter">
                <span class="tf-icons bx bx-plus bx-lg"></span>
            </button>
        </div>
    </div>
    @include('mahasiswa.tambah-bimbingan')
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var progress = {{ $skripsi->progres }};
            var color;

            if (progress == 0) {
                color = '#8592a3'; // Grey color for 0
            } else if (progress >= 1 && progress <= 50) {
                color = '#ffab00'; // Yellow color for 1-50
            } else if (progress >= 51 && progress <= 99) {
                color = '#007bff'; // Blue color for 51-99
            } else if (progress == 100) {
                color = '#71dd37'; // Green color for 100
            }

            var options = {
                chart: {
                    height: 400,
                    type: 'radialBar',
                },
                series: [progress],
                labels: ['Progres'],
                plotOptions: {
                    radialBar: {
                        hollow: {
                            margin: 15,
                            size: '55%',
                        },
                        dataLabels: {
                            showOn: 'always',
                            name: {
                                offsetY: -10,
                                show: true,
                                color: '#888',
                                fontSize: '13px',
                            },
                            value: {
                                color: color, // Set color based on progress value
                                fontSize: '30px',
                                show: true,
                            },
                        }
                    }
                },
                colors: [color] // Set color for the entire chart
            };

            var chart = new ApexCharts(document.querySelector("#chart1"), options);

            chart.render();
        });
    </script>
    <script>
        var options = {
            chart: {
                height: 280,
                type: "radialBar",
            },

            series: [{{ $skripsi->progres }}],
            colors: ["#007bff"],
            plotOptions: {
                radialBar: {
                    hollow: {
                        margin: 0,
                        size: "70%",
                        background: "#293450"
                    },
                    track: {
                        dropShadow: {
                            enabled: true,
                            top: 2,
                            left: 0,
                            blur: 4,
                            opacity: 0.15
                        }
                    },
                    dataLabels: {
                        name: {
                            offsetY: -10,
                            color: "#fff",
                            fontSize: "13px"
                        },
                        value: {
                            color: "#fff",
                            fontSize: "30px",
                            show: true
                        }
                    }
                }
            },
            fill: {
                type: "gradient",
                gradient: {
                    shade: "dark",
                    type: "horizontal",
                    gradientToColors: ["#20E647"],
                    stops: [0, 100]
                }
            },
            stroke: {
                lineCap: "round"
            },
            labels: ["Progress"]
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);

        chart.render();
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let babSelect = document.getElementById("bab");
            let subBabSelect = document.getElementById("subBab");

            babSelect.addEventListener("change", function() {
                let selectedBabId = babSelect.value;

                // Clear existing options
                subBabSelect.innerHTML = '<option selected>Pilih Sub Bab</option>';

                // Filter subBabs based on the selected Bab
                let filteredSubBabs = @json($subBabs->groupBy('bab_id')->toArray())[
                    selectedBabId
                ] || [];

                // Populate subBabSelect with filtered options
                filteredSubBabs.forEach(function(subBab) {
                    let option = document.createElement("option");
                    option.value = subBab.id;
                    option.textContent = subBab.nama;
                    subBabSelect.appendChild(option);
                });
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var terbaruBimbingan = @json($terbaruBimbingan);

            if (terbaruBimbingan) {
                // Get the formatted date for terbaruBimbingan
                var dateTerbaruBimbingan = terbaruBimbingan.tanggal;
                var formattedDateTerbaruBimbingan = formatDate(dateTerbaruBimbingan);
                document.getElementById("tanggal-terbaru").textContent = formattedDateTerbaruBimbingan;
            }
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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let babSelect = document.getElementById("bab");
            let subBabSelect = document.getElementById("subBab");

            babSelect.addEventListener("change", function() {
                let selectedBabId = babSelect.value;

                // Clear existing options
                subBabSelect.innerHTML = '<option value="" selected>Pilih Sub Bab</option>';

                // Filter subBabs based on the selected Bab
                let filteredSubBabs = @json($subBabs->groupBy('bab_id')->toArray())[
                    selectedBabId
                ] || [];

                // Populate subBabSelect with filtered options
                filteredSubBabs.forEach(function(subBab) {
                    let option = document.createElement("option");
                    option.value = subBab.id;
                    option.textContent = subBab.nama;
                    subBabSelect.appendChild(option);
                });
            });

            // Jika opsi "Pilih Sub Bab" yang dipilih, atur nilai subbab_id menjadi null
            subBabSelect.addEventListener("change", function() {
                if (subBabSelect.value === "") {
                    subBabSelect.value = null;
                }
            });
        });
    </script>
@endsection
