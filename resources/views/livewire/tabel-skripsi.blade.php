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
                <h4 class="card-title mb-0">Data Progres Skripsi Mahasiswa</h4>
            </div>
            <div class="d-flex ms-auto me-3">
                <div class="input-group">
                    <div class="input-group">
                        <span class="input-group-text"><i class="tf-icons bx bx-search"></i></span>
                        <input type="text" wire:model.live="search" class="form-control"
                            placeholder="Cari Skripsi...">
                    </div>
                </div>
            </div>
            <div class="dt-action-buttons text-end pt-3 pt-md-0">
                <div class="dt-buttons">
                    <button class="dt-button create-new btn btn-primary" tabindex="0"
                        aria-controls="DataTables_Table_0" type="button"
                        onclick="window.location.href='{{ route('progres-skripsi.tambah') }}' ">
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
                    <th>No</th>
                    <th>Nama Mahasiswa</th>
                    <th>Judul Skripsi</th>
                    <th>Progres</th>
                    <th>Pembimbing</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($skripsis as $index => $skripsi)
                    <tr>
                        <td>{{ $skripsis->firstItem() + $index }}</td>
                        <td class="" style="">
                            <div class="d-flex justify-content-start align-items-center user-name">
                                <div class="avatar-wrapper">
                                    <div class="avatar me-2">
                                        @if ($skripsi->mahasiswa->foto)
                                            <!-- Jika ada foto, tampilkan foto -->
                                            <div class="avatar-popup">
                                                @if ($skripsi->mahasiswa->foto)
                                                    <img class=""
                                                        src="{{ asset('Foto Mahasiswa') . '/' . $skripsi->mahasiswa->foto }}"
                                                        alt="{{ $skripsi->mahasiswa->nama }} Avatar"
                                                        style="min-width: 100px; min-height: 100px;">
                                                @endif
                                            </div>
                                            <img class="avatar-initial rounded-circle bg-label-dark"
                                                src="{{ url('Foto Mahasiswa') . '/' . $skripsi->mahasiswa->foto }}" />
                                        @else
                                            <!-- Jika tidak ada foto, tampilkan inisial -->
                                            <span class="avatar-initial rounded-circle bg-label-dark">
                                                {{ generateInitials($skripsi->mahasiswa->nama) }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <strong class="mb-0">{{ $skripsi->mahasiswa->npm }}</strong>
                                    <span class="emp_name text-truncate">{{ $skripsi->mahasiswa->nama }}</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            {{ $skripsi->judul }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div div="" class="progress" style="height: 8px; min-width: 75px">
                                    <div class="progress-bar" role="progressbar"
                                        style="width:{{ $skripsi->progres }}%;
                                            @if ($skripsi->progres == 0) background-color: #8592a3;
                                            @elseif($skripsi->progres >= 1 && $skripsi->progres <= 50)
                                                background-color: #ffab00;
                                            @elseif($skripsi->progres >= 51 && $skripsi->progres <= 99)
                                                background-color: #007bff;
                                            @else
                                                background-color: #71dd37; @endif"
                                        aria-valuenow="{{ $skripsi->progres }}" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                                <div class="text-body ms-3">{{ $skripsi->progres }}%</div>
                            </div>
                        </td>
                        <td>
                            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                @if ($skripsi->dosen1)
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                        class="avatar avatar-sm pull-up" title="{{ $skripsi->dosen1->nama }}">
                                        @if ($skripsi->dosen1->foto)
                                            <img src="{{ url('Foto Dosen') . '/' . $skripsi->dosen1->foto }}"
                                                alt="Avatar" class="rounded-circle" />
                                        @else
                                            <span class="avatar-initial rounded-circle bg-label-dark">
                                                {{ generateInitials($skripsi->dosen1->nama) }}
                                            </span>
                                        @endif
                                    </li>
                                @endif
                                @if ($skripsi->dosen2)
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                        class="avatar avatar-sm pull-up" title="{{ $skripsi->dosen2->nama }}">
                                        @if ($skripsi->dosen2->foto)
                                            <img src="{{ url('Foto Dosen') . '/' . $skripsi->dosen2->foto }}"
                                                alt="Avatar" class="rounded-circle" />
                                        @else
                                            <span class="avatar-initial rounded-circle bg-label-dark">
                                                {{ generateInitials($skripsi->dosen2->nama) }}
                                            </span>
                                        @endif
                                    </li>
                                @endif
                            </ul>
                        </td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item"
                                        href="{{ route('progres-skripsi.edit', $skripsi->id) }}"><i
                                            class="bx bx-edit-alt me-1"></i>
                                        Edit</a>
                                    <form id="formHapusMahasiswa"
                                        action="{{ route('progres-skripsi.hapus', $skripsi->id) }}" method="POST"
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
            {{ $skripsis->links() }}
        </div>
    </div>
</div>
