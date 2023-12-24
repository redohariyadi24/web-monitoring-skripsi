@extends('layout.layout')

@section('title', 'Web Monitoring Skripsi')

@section('main')
    <div class="row p-4">
        <div class="col-9">
            <div>
                <h2 class="text-white">Selamat Datang di Web Monitoring Skripsi</h2>
            </div>
        </div>
        <div class="col-3 d-flex justify-content-end">
            <div class="flex-row align-items-center ">
                @if (Route::has('login'))
                    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                        @auth
                            <a href="{{ Auth::user()->role === 'mahasiswa' ? route('dashboard-mahasiswa') : (Auth::user()->role === 'dosen' ? route('dashboard-dosen') : route('dashboard-admin')) }}"
                                class="btn btn-secondary d-flex align-items-center" style="width: max-content">
                                <span class="tf-icons bx bx-user me-md-1"></span>
                                <span class="d-none d-md-block">Beranda</span>
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-secondary d-flex align-items-center"
                                style="width: max-content">
                                <span class="tf-icons bx bx-user me-md-1"></span>
                                <span class="d-none d-md-block">Log In</span>
                            </a>
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6 mx-auto ">
            <div class="card">
                <div class="card-body p-md-5">
                    <div>
                        <h5 class="text-center">
                            <strong>Progres Skripsi Mahasiswa Fakultas Teknik</strong>
                        </h5>
                    </div>
                    <div id="boxchart">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var dataArray = @json($result);

            var options = {
                chart: {
                    type: 'bar'
                },
                plotOptions: {
                    bar: {
                        horizontal: true
                    }
                },
                legend: {
                    show: true,
                    showForSingleSeries: true,
                    customLegendItems: ['Belum Mengerjakan', 'Progres < 50%', 'Progres > 50%', 'Selesai'],
                    markers: {
                        fillColors: ['#8592a3', '#ffab00', '#007bff', '#71dd37']
                    }
                },
                series: [{
                    name: 'Mahasiswa',
                    data: dataArray.map(item => ({
                        x: item['x'],
                        y: item['y'],
                        fillColor: item['color']
                    }))
                }],
                colors: dataArray.map(item => item['color']),
                // Set colors for the entire chart
            }

            var chart = new ApexCharts(document.querySelector("#boxchart"), options);

            chart.render();
        });
    </script>
@endsection
