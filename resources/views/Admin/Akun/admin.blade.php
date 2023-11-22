@extends('layout.layout-admin')

@section('title', 'Akun Admin')

@section('main')
    <div class="card">
        <div class="card-header d-flex flex-column flex-md-row">
            <div class="head-label text">
                <h4 class="card-title mb-0">Data Mahasiswa</h4>
            </div>
            <div class="dt-action-buttons text-end pt-3 pt-md-0 ms-md-auto">
                <div class="dt-buttons">
                    <button class="dt-button create-new btn btn-primary" tabindex="0" aria-controls="DataTables_Table_0"
                        type="button" onclick="window.location.href='{{ route('admin.tambah') }}'">
                        <span>
                            <i class="bx bx-plus me-sm-1"></i>
                            <span class="d-none d-sm-inline-block">Tambah Data</span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Nama</th>
                        <th></th>
                    </tr>
                </thead>
                <?php $no = 1; ?> 
                <tbody class="table-border-bottom-0">
                    @foreach ($admin as $akun)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $akun->username }}</td>
                            <td>{{ $akun->name }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('admin.edit', ['role' => 'admin', 'id' => $akun->id]) }}">
                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                        </a>
                                        <form id="formHapusMahasiswa" action=" {{ route('admin.hapus', ['id' => $akun->id]) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item">
                                                <i class="bx bx-trash me-1"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection