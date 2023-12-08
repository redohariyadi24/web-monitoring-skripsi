<div>
    <div class="card-header">
        <div>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
        <div class="d-flex flex-column flex-md-row align-items-center">
            <div class="head-label text">
                <h4 class="card-title mb-0">Data Mahasiswa</h4>
            </div>
            <div class="d-flex ms-auto me-3">
                <div class="input-group">
                    <div class="input-group">
                        <span class="input-group-text"><i class="tf-icons bx bx-search"></i></span>
                        <input type="text" wire:model.live="search" class="form-control"
                            placeholder="Cari Mahasiswa...">
                    </div>
                </div>
            </div>
            <div class="dt-action-buttons text-end pt-3 pt-md-0">
                <div class="dt-buttons">
                    <button class="dt-button create-new btn btn-primary" tabindex="0"
                        aria-controls="DataTables_Table_0" type="button"
                        onclick="window.location.href='{{ route('data-mahasiswa.tambah') }}'">
                        <span>
                            <i class="bx bx-plus me-sm-1"></i>
                            <span class="d-none d-sm-inline-block">Tambah Data</span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>no</th>
                    <th>NPM</th>
                    <th>Mahasiswa</th>
                    <th>Semester</th>
                    <th>Judul Skripsi</th>
                    <th>Dosen Pembimbing</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($mahasiswas as $index => $mahasiswa)
                    <tr>
                        <td>{{ $mahasiswas->firstItem() + $index }}</td>
                        <td><i class="fab"></i> <strong>{{ $mahasiswa->npm }}</strong></td>
                        <td class="" style="">
                            <div class="d-flex justify-content-start align-items-center user-name">
                                <div class="avatar-wrapper">
                                    <div class="avatar me-2">
                                        @if ($mahasiswa->foto)
                                            <!-- Jika ada foto, tampilkan foto -->
                                            <div class="avatar-popup">
                                                @if ($mahasiswa->foto)
                                                    <img class=""
                                                        src="{{ asset('Foto Mahasiswa') . '/' . $mahasiswa->foto }}"
                                                        alt="{{ $mahasiswa->nama }} Avatar"
                                                        style="min-width: 100px; min-height: 100px; border-radius:5px;">
                                                @endif
                                            </div>
                                            <img class="avatar-initial rounded-circle bg-label-dark"
                                                src="{{ url('Foto Mahasiswa') . '/' . $mahasiswa->foto }}" />
                                        @else
                                            <!-- Jika tidak ada foto, tampilkan inisial -->
                                            <span class="avatar-initial rounded-circle bg-label-dark">
                                                {{ generateInitials($mahasiswa->nama) }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="emp_name text-truncate">{{ $mahasiswa->nama }}</span>
                                    <small class="emp_post text-truncate text-muted">{{ $mahasiswa->email }}</small>
                                </div>
                            </div>
                        </td>
                        <td>Semester {{ $mahasiswa->semester }}</td>
                        <td>
                            @if ($mahasiswa->skripsi)
                                <div><strong>{{ $mahasiswa->skripsi->judul }}</strong></div>
                            @else
                                <div class="text-muted">
                                    <em>Belum ada judul skripsi</em>
                                </div>
                            @endif
                        </td>
                        <td>
                            @if ($mahasiswa->skripsi)
                                <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                    @if ($mahasiswa->skripsi->dosen1)
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            class="avatar avatar-sm pull-up"
                                            title="{{ $mahasiswa->skripsi->dosen1->nama }}">
                                            @if ($mahasiswa->skripsi->dosen1->foto)
                                                <img src="{{ url('Foto Dosen') . '/' . $mahasiswa->skripsi->dosen1->foto }}"
                                                    alt="Avatar" class="rounded-circle" />
                                            @else
                                                <span class="avatar-initial rounded-circle bg-label-dark">
                                                    {{ generateInitials($mahasiswa->skripsi->dosen1->nama) }}
                                                </span>
                                            @endif
                                        </li>
                                    @endif

                                    {{-- Display Dosen 2 --}}
                                    @if ($mahasiswa->skripsi->dosen2)
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            class="avatar avatar-sm pull-up"
                                            title="{{ $mahasiswa->skripsi->dosen2->nama }}">
                                            @if ($mahasiswa->skripsi->dosen2->foto)
                                                <img src="{{ url('Foto Dosen') . '/' . $mahasiswa->skripsi->dosen2->foto }}"
                                                    alt="Avatar" class="rounded-circle" />
                                            @else
                                                <span class="avatar-initial rounded-circle bg-label-dark">
                                                    {{ generateInitials($mahasiswa->skripsi->dosen2->nama) }}
                                                </span>
                                            @endif
                                        </li>
                                    @endif
                                </ul>
                            @else
                                <div class="text-muted">
                                    <em>Belum ada Dosen Pembimbing</em>
                                </div>
                            @endif
                        </td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item"
                                        href="{{ route('data-mahasiswa.edit', $mahasiswa->id) }}"><i
                                            class="bx bx-edit-alt me-1"></i>
                                        Edit</a>
                                    <form id="formHapusMahasiswa"
                                        action="{{ route('data-mahasiswa.hapus', $mahasiswa->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item">
                                            <i class="bx bx-trash me-1"></i>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="demo-inline-spacing mx-3">
            {{ $mahasiswas->links() }}
        </div>
    </div>
</div>
