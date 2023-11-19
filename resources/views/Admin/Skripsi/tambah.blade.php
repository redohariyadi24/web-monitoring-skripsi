@extends('layout.layout-admin')

@section('title', 'Progres Skripsi')

@section('menu-sidebar')
    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item">
            <a href="{{ route('dashboard-admin') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Beranda</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Manajemen Data</span>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">Data</div>
            </a>
            <ul class="menu-sub ">
                <li class="menu-item">
                    <a href="{{ route('data-mahasiswa.index') }}" class="menu-link">
                        <div data-i18n="Account">Data Mahasiswa</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('data-dosen.index') }}" class="menu-link">
                        <div data-i18n="Notifications">Data Dosen</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
                <div data-i18n="Authentications">Akun</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="auth-login-basic.html" class="menu-link" target="_blank">
                        <div data-i18n="Basic">Akun Mahasiswa</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="auth-register-basic.html" class="menu-link" target="_blank">
                        <div data-i18n="Basic">Akun Dosen</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="auth-forgot-password-basic.html" class="menu-link" target="_blank">
                        <div data-i18n="Basic">Akun Admin</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- Components -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Manajemen
                Skripsi</span></li>
        <!-- Cards -->
        <li class="menu-item active">
            <a href="{{ route('progres-skripsi.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Progres Skripsi</div>
            </a>
        </li>
        <!-- User interface -->
        <li class="menu-item">
            <a href="javascript:void(0)" class="menu-link">
                <i class="menu-icon tf-icons bx bx-box"></i>
                <div data-i18n="User interface">Jadwal Sidang</div>
            </a>
        </li>
    </ul>
@endsection

@section('main')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Progres Skripsi/</span> Tambah Progres Skripsi</h4>
    <!-- Basic Layout -->

    <div class="col-xl mx-auto" style="max-width: 700px">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Form Pengisian Data Progres Skripsi</h5>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('progres-skripsi.simpan') }}" enctype="">
                    @csrf
                    @method('post')
                    <div class="mb-3">
                        <label for="exampleDataList" class="form-label">NPM Mahasiswa</label>
                        <input name="mahasiswa_id" class="form-control" list="datalistOptions" id="exampleDataList"
                            placeholder="Cari NPM Mahasiswa ..." />
                        <datalist id="datalistOptions">
                            @foreach ($mahasiswas as $mahasiswa)
                                <option value="{{ $mahasiswa->npm }}">{{ $mahasiswa->nama }}</option>
                            @endforeach
                        </datalist>
                    </div>
                    <div class="mb-3">
                        <label for="exampleDataListDosen1" class="form-label">Pilih Dosen Pembimbing 1</label>
                        <input name="dosen1_id" class="form-control" list="datalistOptionsDosen1" id="exampleDataListDosen1"
                            placeholder="Cari Dosen Pembimbing 1" />
                        <datalist id="datalistOptionsDosen1">
                            @foreach ($dosens as $dosen)
                                <option value="{{ $dosen->nama }}">{{ $dosen->nip }}</option>
                            @endforeach
                        </datalist>
                    </div>
                    <!-- Repeat the above code with unique IDs for Dosen Pembimbing 2 -->
                    <div class="mb-3">
                        <label for="exampleDataListDosen2" class="form-label">Pilih Dosen Pembimbing 2</label>
                        <input name="dosen2_id" class="form-control" list="datalistOptionsDosen2" id="exampleDataListDosen2"
                            placeholder="Cari Dosen Pembimbing 2" />
                        <datalist id="datalistOptionsDosen2">
                            @foreach ($dosens as $dosen)
                                <option value="{{ $dosen->nama }}">{{ $dosen->nip }}</option>
                            @endforeach
                        </datalist>
                    </div>
                    <div class="mb-3">
                        <label for="defaultFormControlInput" class="form-label">Judul Skripsi</label>
                        <input name="judul" type="text" class="form-control" id="defaultFormControlInput"
                            placeholder="Judul Skripsi" aria-describedby="defaultFormControlHelp" />
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            // Simpan data mahasiswa untuk digunakan nanti
            var mahasiswaData = @json($mahasiswas);

            // Fungsi untuk memperbarui datalist berdasarkan input pengguna
            function updateDataList(inputValue) {
                // Filter data mahasiswa sesuai dengan input pengguna
                var filteredData = mahasiswaData.filter(function(mahasiswa) {
                    return mahasiswa.npm.includes(inputValue);
                });

                // Batasi jumlah data yang ditampilkan maksimal 5
                filteredData = filteredData.slice(0, 5);

                // Hapus semua opsi datalist
                $('#datalistOptions').empty();

                // Tambahkan opsi baru sesuai dengan data yang difilter
                filteredData.forEach(function(mahasiswa) {
                    $('#datalistOptions').append('<option value="' + mahasiswa.npm + '">' + mahasiswa.nama +
                        '</option>');
                });
            }

            // Tangkap perubahan input dan perbarui datalist
            $('#exampleDataList').on('input', function() {
                updateDataList($(this).val());
            });

            // Pembaruan awal datalist saat halaman dimuat
            updateDataList('');
        });
    </script>

@endsection
