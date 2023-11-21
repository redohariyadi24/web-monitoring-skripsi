@extends('layout.layout-admin')

@section('title', 'Edit Data Dosen')

@section('main')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Data Mahasiswa/</span> Edit Data Mahasiswa</h4>
    <div class="col-xl mx-auto" style="max-width: 700px">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Form Edit Data Mahasiswa</h5>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('data-dosen.update', ['dosen' => $dosen]) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <div class="form-floating">
                            <input name="nip" value="{{ $dosen->nip }}" type="text" class="form-control"
                                id="floatingInput" placeholder="19xxxxxxxxxxx" aria-describedby="floatingInputHelp"
                                style="text-transform: uppercase;" />
                            <label for="floatingInput">NIP</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <input name="nama" value="{{ $dosen->nama }}" type="text" class="form-control"
                                id="floatingInput" placeholder="John Doe" aria-describedby="floatingInputHelp" />
                            <label for="floatingInput">Nama</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <input name="email" value="{{ $dosen->email }}" type="email" class="form-control"
                                id="floatingInput" placeholder="email@example.com" aria-describedby="floatingInputHelp" />
                            <label for="floatingInput">Email</label>
                        </div>
                    </div>
                    <div class="mb-3 ">
                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <label for="formFile" class="form-label mb-0 pl-10">Foto Dosen</label>
                            @if ($dosen->foto)
                                <label class="form-check-label">
                                    <input type="checkbox" name="hapus_foto"> Hapus Foto
                                </label>
                            @endif
                        </div>
                        <div class="mb-3 d-flex align-items-center">
                            @if ($dosen->foto)
                                <div class="avatar me-2">
                                    <img class="img rounded" src="{{ url('Foto Dosen') . '/' . $dosen->foto }}">
                                </div>
                            @endif
                            <input name="foto" value="" class="form-control" type="file" id="formFile"
                                accept=".jpg, .jpeg, .png" />
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Perbarui Data</button>
                </form>
            </div>
        </div>
    </div>
@endsection
