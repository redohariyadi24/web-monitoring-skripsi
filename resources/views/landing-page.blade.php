@extends('layout.layout')

@section('title', 'Landing Page')

@section('main')
    <div class="row p-4">
        <div class="col-9">
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
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div id="boxchart">

                            </div>
                        </div>
                        <div class="col-6">

                        </div>
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
                series: [{
                    data: [

                        @foreach ($result as $item)
                            {
                                x: '{{ $item['x'] }}',
                                y: {{ $item['y'] }},
                            },
                        @endforeach

                    ]
                }]
            }

            var chart = new ApexCharts(document.querySelector("#boxchart"), options);

            chart.render();
        });
    </script>
@endsection
