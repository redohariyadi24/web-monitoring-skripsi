@extends('layout.layout-admin')

@section('title', 'Tambah Akun')

@section('main')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Akun Admin/</span> Tambah Akun {{ $role }}</h4>
    <!-- Basic Layout -->

    <div class="col-xl mx-auto" style="max-width: 700px">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Form Pengisian Akun</h5>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('akun-'.$role.'.simpan') }}">
                    @csrf
                    @method('post')
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input name="username" type="text" class="form-control" id="username" 
                            placeholder="Masukkan username" autofocus />
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Akun</label>
                        <input name="name" type="text" class="form-control" id="name"
                            placeholder="Masukkan nama" />
                    </div>
                    <input type="hidden" name="role" value="{{ $role }}">
                    <div class="mb-3 form-password-toggle">
                        <label class="form-label" for="password">Password</label>
                        <div class="input-group input-group-merge">
                            <input name="password" type="password" id="password" class="form-control"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password" />
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
