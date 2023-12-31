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
                <h4 class="card-title mb-0">Jadwal Sidang Skripsi</h4>
            </div>
            <div class="d-flex ms-auto me-3">
                <div class="input-group">
                    <div class="input-group">
                        <span class="input-group-text"><i class="tf-icons bx bx-search"></i></span>
                        <input type="text" wire:model.live="search" class="form-control"
                            placeholder="Cari Jadwal...">
                    </div>
                </div>
            </div>
            <div class="dt-action-buttons text-end pt-3 pt-md-0">
                <div class="dt-buttons">
                    <button class="dt-button create-new btn btn-primary" tabindex="0"
                        aria-controls="DataTables_Table_0" type="button"
                        onclick="window.location.href='{{ route('jadwal-sidang.tambah') }}'">
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
                    <th>Tanggal</th>
                    <th>Mahasiswa</th>
                    <th>Skripsi</th>
                    <th>Pembimbing</th>
                    <th></th>
                </tr>
            </thead>
            <?php $no = 1; ?>
            <tbody class="table-border-bottom-0">
                @if (count($jadwals) > 0)
                    @foreach ($jadwals as $index => $jadwal)
                        <tr>
                            <td>{{ $jadwals->firstItem() + $index }}</td>
                            <td
                                class="{{ \Carbon\Carbon::parse($jadwal->tanggal)->isSameDay(now()) ? 'text-primary' : (\Carbon\Carbon::parse($jadwal->tanggal)->lt(now()) ? 'text-muted' : 'text-success') }}">
                                <strong class="mb-0" style="font-size: 1.1rem">{{ $jadwal->jenis }}</strong><br>
                                <strong>{{ \Carbon\Carbon::parse($jadwal->tanggal)->locale('id_ID')->isoFormat('dddd, D MMMM YYYY') }}</strong>
                                <br>
                                <span>Pukul
                                    {{ \Carbon\Carbon::parse($jadwal->tanggal)->locale('id_ID')->isoFormat('H:mm') }}</span>
                            </td>
                            <td class="" style="">
                                <div class="d-flex justify-content-start align-items-center user-name">
                                    <div class="avatar-wrapper">
                                        <div class="avatar me-2">
                                            @if ($jadwal->skripsi->mahasiswa->foto)
                                                <!-- Jika ada foto, tampilkan foto -->
                                                <div class="avatar-popup">
                                                    @if ($jadwal->skripsi->mahasiswa->foto)
                                                        <img class=""
                                                            src="{{ asset('Foto Mahasiswa') . '/' . $jadwal->skripsi->mahasiswa->foto }}"
                                                            alt="{{ $jadwal->skripsi->mahasiswa->nama }} Avatar"
                                                            style="min-width: 100px; min-height: 100px;">
                                                    @endif
                                                </div>
                                                <img class="avatar-initial rounded-circle bg-label-dark"
                                                    src="{{ url('Foto Mahasiswa') . '/' . $jadwal->skripsi->mahasiswa->foto }}" />
                                            @else
                                                <!-- Jika tidak ada foto, tampilkan inisial -->
                                                <span class="avatar-initial rounded-circle bg-label-dark">
                                                    {{ generateInitials($jadwal->skripsi->mahasiswa->nama) }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <strong class="mb-0">{{ $jadwal->skripsi->mahasiswa->npm }}</strong>
                                        <span
                                            class="emp_name text-truncate">{{ $jadwal->skripsi->mahasiswa->nama }}</span>
                                    </div>
                                </div>
                            </td>
                            <td><span>{{ $jadwal->skripsi->judul }}</span></td>
                            <td>
                                <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                    @if ($jadwal->skripsi->dosen1)
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            class="avatar avatar-sm pull-up"
                                            title="{{ $jadwal->skripsi->dosen1->nama }}">
                                            @if ($jadwal->skripsi->dosen1->foto)
                                                <img src="{{ url('Foto Dosen') . '/' . $jadwal->skripsi->dosen1->foto }}"
                                                    alt="Avatar" class="rounded-circle" />
                                            @else
                                                <span class="avatar-initial rounded-circle bg-label-dark">
                                                    {{ generateInitials($jadwal->skripsi->dosen1->nama) }}
                                                </span>
                                            @endif
                                        </li>
                                    @endif
                                    {{-- Display Dosen 2 --}}
                                    @if ($jadwal->skripsi->dosen2)
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            class="avatar avatar-sm pull-up"
                                            title="{{ $jadwal->skripsi->dosen2->nama }}">
                                            @if ($jadwal->skripsi->dosen2->foto)
                                                <img src="{{ url('Foto Dosen') . '/' . $jadwal->skripsi->dosen2->foto }}"
                                                    alt="Avatar" class="rounded-circle" />
                                            @else
                                                <span class="avatar-initial rounded-circle bg-label-dark">
                                                    {{ generateInitials($jadwal->skripsi->dosen2->nama) }}
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
                                            href="{{ route('jadwal-sidang.edit', $jadwal->id) }}"><i
                                                class="bx bx-edit-alt me-1"></i>
                                            Edit</a>
                                        <form id="formHapusMahasiswa"
                                            action="{{ route('jadwal-sidang.hapus', $jadwal->id) }}" method="POST"
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
                @else
                    <tr>
                        <td colspan="7" class="text-center py-5">Tidak ada jadwal saat ini.</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <div class="demo-inline-spacing mx-3">
            {{ $jadwals->links() }}
        </div>
    </div>
</div>
