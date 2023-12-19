@extends('layout.layout-mahasiswa-baru')

@section('title', 'Data Diri')

@section('main')
    <div class="col-xl-12 mx-auto">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Form Pengisian Mahasiswa</h5>
                <small>Sebelum memasuki sistem mohon lengkapi Data Diri anda terlebih dahulu</small>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('data-diri.simpan') }}" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-4">
                            <h6>Data Diri Mahasiswa</h6>
                            <!-- Input NPM -->
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input name="npm" type="text"
                                        class="form-control @error('npm') is-invalid @enderror" id="floatingInput"
                                        placeholder="G1AXXXXXX" value="{{ old('npm', $user->username) }}"
                                        aria-describedby="floatingInputHelp" style="text-transform: uppercase;"
                                        maxlength="9" required />
                                    <label for="floatingInput">NPM</label>
                                    @error('npm')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input Nama -->
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input name="nama" type="text"
                                        class="form-control @error('nama') is-invalid @enderror" id="floatingInput"
                                        placeholder="John Doe" value="{{ old('nama', $user->name) }}"
                                        aria-describedby="floatingInputHelp" required />
                                    <label for="floatingInput">Nama</label>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input Email -->
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input name="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" id="floatingInput"
                                        placeholder="email@example.com" aria-describedby="floatingInputHelp"
                                        value="{{ old('email') }}" />
                                    <label for="floatingInput">Email</label>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input Semester -->
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input name="semester" type="number"
                                        class="form-control @error('semester') is-invalid @enderror"
                                        value="{{ old('semester') }}" id="floatingInput" placeholder="5"
                                        aria-describedby="floatingInputHelp" required />
                                    <label for="floatingInput">Semester</label>
                                    @error('semester')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input Foto Mahasiswa -->
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Foto Mahasiswa</label>
                                <input name="foto" class="form-control @error('foto') is-invalid @enderror"
                                    type="file" id="formFile" accept=".jpg, .jpeg, .png" />
                                @error('foto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-8">
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <h6>Data Skripsi Mahasiswa</h6>
                                    <!-- Input Judul Skripsi -->
                                    <div class="mb-3">
                                        <label for="defaultFormControlInput" class="form-label">Judul Skripsi</label>
                                        <input name="judul" type="text"
                                            class="form-control @error('judul') is-invalid @enderror"
                                            id="defaultFormControlInput" placeholder="Judul Skripsi"
                                            aria-describedby="defaultFormControlHelp" value="{{ old('judul') }}" />
                                        @error('judul')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Input Pilih Dosen Pembimbing 1 -->
                                    <div class="mb-3">
                                        <label for="exampleDataListDosen1" class="form-label">Pilih Dosen Pembimbing
                                            1</label>
                                        <input name="dosen1_id"
                                            class="form-control @error('dosen1_id') is-invalid @enderror"
                                            list="datalistOptionsDosen1" id="exampleDataListDosen1"
                                            placeholder="Cari Dosen Pembimbing 1" />
                                        <datalist id="datalistOptionsDosen1">
                                            @foreach ($dosens as $dosen)
                                                <option value="{{ $dosen->nama }}">{{ $dosen->nip }}</option>
                                            @endforeach
                                        </datalist>
                                        @error('dosen1_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Input Pilih Dosen Pembimbing 2 -->
                                    <div class="mb-3">
                                        <label for="exampleDataListDosen2" class="form-label">Pilih Dosen Pembimbing
                                            2</label>
                                        <input name="dosen2_id"
                                            class="form-control @error('dosen2_id') is-invalid @enderror"
                                            list="datalistOptionsDosen2" id="exampleDataListDosen2"
                                            placeholder="Cari Dosen Pembimbing 2" />
                                        <datalist id="datalistOptionsDosen2">
                                            @foreach ($dosens as $dosen)
                                                <option value="{{ $dosen->nama }}">{{ $dosen->nip }}</option>
                                            @endforeach
                                        </datalist>
                                        @error('dosen2_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <h6>Akun Mahasiswa</h6>
                                    <!-- Input Password -->
                                    <div class="mb-3 form-password-toggle">
                                        <div class="d-flex justify-content-between">
                                            <label class="form-label" for="password">Password</label>
                                        </div>
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="password"
                                                class="form-control @error('password') is-invalid @enderror" required
                                                name="password"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                aria-describedby="password" />
                                            <span class="input-group-text cursor-pointer"><i
                                                    class="bx bx-hide"></i></span>
                                                    @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        </div>
                                        
                                    </div>
                                    <!-- Input Konfirmasi Password -->
                                    <div class="mb-3 form-password-toggle">
                                        <div class="d-flex justify-content-between">
                                            <label class="form-label" for="kpassword">Konfirmasi Password</label>
                                        </div>
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="kpassword"
                                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                                required name="password_confirmation"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                aria-describedby="password" />
                                            <span class="input-group-text cursor-pointer"><i
                                                    class="bx bx-hide"></i></span>
                                                    @error('password_confirmation')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <button type="button" class="btn btn-primary" style="width: max-content" data-bs-toggle="modal"
                            data-bs-target="#modalToggle">
                            Simpan
                        </button>
                    </div>

                    <div class="modal fade" id="modalToggle" aria-labelledby="modalToggleLabel" tabindex="-1"
                        style="display: none" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-bolder" id="modalToggleLabel">Konfirmasi Data</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body px-2 text-center">
                                    <p class="mb-0">Apakah anda yakin ingin menyimpan data</p>
                                    <small>Pastikan seluruh data yang anda masukkan sudah benar</small>
                                </div>
                                <div class="modal-footer d-flex align-item-center justify-content-center">
                                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
