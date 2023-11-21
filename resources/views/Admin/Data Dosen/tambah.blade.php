@extends('layout.layout-admin')

@section('title', 'Edit Data Dosen')

@section('main')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Data Dosen/</span> Tambah Data Dosen</h4>
    <!-- Basic Layout -->

    <div class="col-xl mx-auto" style="max-width: 700px">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Form Pengisian Data Dosen</h5>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('data-dosen.simpan') }}" enctype="multipart/form-data"> 
                    @csrf
                    @method('post')
                    <div class="mb-3">
                        <div class="form-floating">
                            <input name="nip" type="text" class="form-control" id="floatingInput" placeholder="19xxxxxxxxxxx"
                                aria-describedby="floatingInputHelp" style="text-transform: uppercase;"/>
                            <label for="floatingInput">NIP</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <input name="nama" type="text" class="form-control" id="floatingInput" placeholder="John Doe"
                                aria-describedby="floatingInputHelp" />
                            <label for="floatingInput">Nama</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <input name="email" type="email" class="form-control" id="floatingInput" placeholder="email@example.com"
                                aria-describedby="floatingInputHelp" />
                            <label for="floatingInput">Email</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Foto Dosen</label>
                        <input name="foto" class="form-control" type="file" id="formFile" accept=".jpg, .jpeg, .png" />
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
