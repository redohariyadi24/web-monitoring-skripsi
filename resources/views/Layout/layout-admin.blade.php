<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>@yield('title', 'Default Title')</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    <script src="{{ asset('assets/js/config.js') }}"></script>

    <script src="path/to/toastify.js"></script>

    @yield('styles')
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Sidebar -->
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <!-- Logo & Nama Web -->
                <div class="app-brand demo">
                    {{-- Link jika logo di klik --}}
                    <a href="{{ route('landing-page') }}" class="app-brand-link">
                        {{-- Logo --}}
                        <span class="app-brand-logo demo">

                        </span>
                        {{-- Nama Web --}}
                        <span class="app-brand-text demo menu-text fw-bolder ms-2">Web Skripsi</span>
                    </a>

                    <a href="{{ route('landing-page') }}"
                        class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>
                <!-- Logo & Nama Web -->
                <!-- User -->
                <ul class="menu-item navbar-dropdown dropdown-user dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                        <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar avatar-online">
                                    <span class="avatar-initial rounded-circle bg-label-dark">
                                        {{ generateInitials($user->name) }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <span class="fw-semibold d-block">{{ $user->name }}</span>
                                <small class="text-muted">Admin</small>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="/logout">
                                <i class="bx bx-power-off me-2"></i>
                                <span class="align-middle">Log Out</span>
                            </a>
                        </li>
                    </ul>
                </ul>
                <!--/ User -->
                <div class="menu-inner-shadow"></div>
                {{-- Menu Sidebar --}}
                <ul class="menu-inner py-1">
                    <!-- Dashboard -->
                    <li class="menu-item">
                        <a href="/dashboard" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Analytics">Dashboard</div>
                        </a>
                    </li>

                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Manajemen Pengguna</span>
                    </li>
                    <li
                        class="menu-item {{ request()->is('data-mahasiswa') || request()->is('data-dosen') ? 'menu-item active open' : 'menu-item' }}">
                        <a href="#" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-dock-top"></i>
                            <div data-i18n="">Data</div>
                        </a>
                        <ul class="menu-sub ">
                            <li class="menu-item">
                                <a href="/data-mahasiswa" class="menu-link">
                                    <div data-i18n="Account">Data Mahasiswa</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="/data-dosen" class="menu-link">
                                    <div data-i18n="Notifications">Data Dosen</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li
                        class="menu-item {{ request()->is('akun/mahasiswa', 'akun/dosen', 'akun/admin') ? 'menu-item active open' : 'menu-item' }}">
                        <a href="#" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-user"></i>
                            <div data-i18n="">Akun</div>
                        </a>
                        <ul class="menu-sub ">
                            <li class="menu-item">
                                <a href="/akun/mahasiswa" class="menu-link">
                                    <div data-i18n="Account">Akun Mahasiswa</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="/akun/dosen" class="menu-link">
                                    <div data-i18n="Notifications">Akun Dosen</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="/akun/admin" class="menu-link">
                                    <div data-i18n="Notifications">Akun Admin</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Components -->
                    <li class="menu-header small text-uppercase"><span class="menu-header-text">Manajemen
                            Skripsi</span></li>
                    <!-- Cards -->
                    <li class="menu-item">
                        <a href="/progres-skripsi" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-pie-chart"></i>
                            <div data-i18n="Basic">Progres Skripsi</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="/bimbingan-admin" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-conversation"></i>
                            <div data-i18n="Basic">Bimbingan</div>
                        </a>
                    </li>
                    <!-- User interface -->
                    <li class="menu-item">
                        <a href="/jadwal-sidang" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-calendar"></i>
                            <div data-i18n="User interface">Jadwal Sidang</div>
                            @if ($jumlahSkripsiTanpaSeminarHasil > 0)
                                <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-primary ms-2"
                                    data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top"
                                    data-bs-html="true"
                                    title="<span>Belum Seminar Hasil</span>">{{ $jumlahSkripsiTanpaSeminarHasil }}</span>
                            @endif
                            @if ($jumlahSkripsiTanpaSidangSkripsi > 0)
                                <span
                                    class="badge rounded-pill badge-center h-px-20 w-px-20 bg-primary ms-2"
                                    data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top"
                                    data-bs-html="true"
                                    title="<span>Belum Sidang Skripsi</span>">{{ $jumlahSkripsiTanpaSidangSkripsi }}</span>
                            @endif
                        </a>
                    </li>
                </ul>
            </aside>
            <!-- / Sidebar -->
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>
                </nav>
                <!-- / Navbar -->
                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        @yield('main')
                        <!-- Footer -->
                        <footer class="content-footer footer bg-footer-theme">
                            <div
                                class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                                <div class="mb-2 mb-md-0">
                                    ©
                                    <script>
                                        document.write(new Date().getFullYear());
                                    </script>,
                                    <a href="" target="_blank" class="footer-link fw-bolder">PPL</a>
                                </div>
                            </div>
                        </footer>
                        <!-- / Footer -->
                        <div class="content-backdrop fade"></div>
                    </div>
                    <!-- Content wrapper -->
                </div>
                <!-- / Layout container -->
            </div>
            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>
            <!-- / Overlay -->
        </div>
        <!-- / Layout wrapper -->


        <!-- Core JS -->
        <!-- build:js assets/vendor/js/core.js -->
        <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
        <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

        <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
        <!-- endbuild -->

        <!-- Vendors JS -->
        <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

        <!-- Main JS -->
        <script src="{{ asset('assets/js/main.js') }}"></script>


        <!-- Page JS -->
        <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
        <script src="{{ asset('assets/js/ui-toasts.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>

        <script>
            // Get the current URL path
            var path = window.location.pathname;

            // Find the corresponding menu item and make it active
            $('.menu-item a').each(function() {
                var href = $(this).attr('href');
                if (path === href) {
                    $(this).closest('.menu-item').addClass('active');
                }
            });

            // Find the corresponding submenu item and make its parent menu item active and open
            $('.menu-sub a').each(function() {
                var href = $(this).attr('href');
                if (path === href) {
                    $(this).closest('.menu-item').addClass('active open');
                    $(this).closest('.menu-sub').addClass('active');
                }
            });
        </script>



        {{-- <script>
            // Get the current URL path
            var path = window.location.pathname;

            // Find the corresponding menu item and make it active
            $('.menu-item a').each(function() {
                var href = $(this).attr('href');
                if (path === href) {
                    $(this).closest('.menu-item').addClass('active');
                }
            });

            // Find the corresponding submenu item and make its parent menu item active
            $('.menu-sub a').each(function() {
                var href = $(this).attr('href');
                if (path === href) {
                    $(this).closest('.menu-item').addClass('active');
                }
            });
        </script> --}}

        @yield('scripts')

        <!-- Place this tag in your head or just before your close body tag. -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
