@extends('layout.layout-admin')

@section('title', 'Edit Akun ' . ucfirst($role))

@section('main')
    <div class="col-xl mx-auto" style="max-width: 700px">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Form Pengisian Akun</h5>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route($role . '.update', ['id' => $user->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input name="username" type="text" class="form-control" id="username"
                            placeholder="Masukkan username" value="{{ old('username', $user->username) }}" autofocus />
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Akun</label>
                        <input name="name" type="text" class="form-control" id="name" placeholder="Masukkan nama"
                            value="{{ old('name', $user->name) }}" />
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
