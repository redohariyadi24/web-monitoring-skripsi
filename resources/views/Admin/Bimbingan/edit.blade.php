@extends('layout.layout-admin')

@section('title', 'Edit Data Bimbingan')

@section('main')
    <h4 class="fw-bold py-3 mb-4"><a href="/bimbingan-admin" class="text-muted fw-light" >Data Bimbingan/</a> Tambah Data Bimbingan</h4>

    <div class="col-xl mx-auto" style="max-width: 700px">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Form Pengisian Data Bimbingan</h5>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('bimbingan-admin.update', $bimbingan->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <div class="mb-3">
                        <div class="form-floating">
                            <input name="nama" type="text" class="form-control" id="floatingInput"
                                placeholder="Bimbingan" value="{{ $bimbingan->nama }} "
                                aria-describedby="floatingInputHelp" />
                            <label for="floatingInput">Nama Bimbingan</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <input name="tanggal" type="date" class="form-control" id="floatingInput"
                                aria-describedby="floatingInputHelp" value="{{ $bimbingan->tanggal }}" />
                            <label for="floatingInput">Tanggal</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <input name="mahasiswa_id" class="form-control" list="datalistOptions" id="exampleDataList"
                                placeholder="Cari NPM Mahasiswa ..." aria-describedby="floatingInputHelp"
                                value="{{ $bimbingan->mahasiswa->npm }}" />
                            <datalist id="datalistOptions">
                                @foreach ($mahasiswas as $mahasiswa)
                                    <option value="{{ $mahasiswa->npm }}">{{ $mahasiswa->nama }}</option>
                                @endforeach
                            </datalist>
                            <label for="floatingInput">NPM Mahasiswa</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <input name="dospem_id" class="form-control" list="datalistOptions2" id="exampleDataList2"
                                placeholder="Cari NIP Dosen ..." aria-describedby="floatingInputHelp"
                                value="{{ $bimbingan->dosen->nip }}" />
                            <datalist id="datalistOptions2">
                                @foreach ($dosens as $dosen)
                                    <option value="{{ $dosen->nip }}">{{ $dosen->nama }}</option>
                                @endforeach
                            </datalist>
                            <label for="floatingInput">NIP Dosen</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <select class="form-select" id="bab" name="bab_id" aria-label="Default select example">
                                <option selected value="{{ $bimbingan->bab->id }}">{{ $bimbingan->bab->nama }}</option>
                                @foreach ($babs as $bab)
                                    <option value="{{ $bab->id }}">{{ $bab->nama }}</option>
                                @endforeach
                            </select>
                            <label for="floatingInput">Bab</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <select class="form-select" id="subBab" name="subbab_id" aria-label="Default select example">
                                @if ($bimbingan->subbab)
                                    <option value="{{ $bimbingan->subbab->id }}" selected>{{ $bimbingan->subbab->nama }}</option>
                                @else
                                    <option selected>Pilih Sub Bab</option>
                                @endif
                                @foreach ($subBabs as $subBab)
                                    <option value="{{ $subBab->id }}" data-parent="{{ $subBab->bab->id }}">
                                        {{ $subBab->nama }}</option>
                                @endforeach
                            </select>
                            <label for="floatingInput">Sub Bab</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <select class="form-select" id="status" name="status" aria-label="Default select example">
                                <option value="menunggu konfirmasi"
                                    {{ $bimbingan->status === 'menunggu konfirmasi' ? 'selected' : '' }}>Menunggu
                                    Konfirmasi</option>
                                <option value="revisi" {{ $bimbingan->status === 'revisi' ? 'selected' : '' }}>Revisi
                                </option>
                                <option value="acc" {{ $bimbingan->status === 'acc' ? 'selected' : '' }}>ACC</option>

                            </select>
                            <label for="floatingInput">Status</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let babSelect = document.getElementById("bab");
            let subBabSelect = document.getElementById("subBab");

            babSelect.addEventListener("change", function() {
                let selectedBabId = babSelect.value;

                // Clear existing options
                subBabSelect.innerHTML = '<option value="" selected>Pilih Sub Bab</option>';

                // Filter subBabs based on the selected Bab
                let filteredSubBabs = @json($subBabs->groupBy('bab_id')->toArray())[
                    selectedBabId
                ] || [];

                // Populate subBabSelect with filtered options
                filteredSubBabs.forEach(function(subBab) {
                    let option = document.createElement("option");
                    option.value = subBab.id;
                    option.textContent = subBab.nama;
                    subBabSelect.appendChild(option);
                });
            });

            // Jika opsi "Pilih Sub Bab" yang dipilih, atur nilai subbab_id menjadi null
            subBabSelect.addEventListener("change", function() {
                if (subBabSelect.value === "") {
                    subBabSelect.value = null;
                }
            });
        });
    </script>
@endsection
