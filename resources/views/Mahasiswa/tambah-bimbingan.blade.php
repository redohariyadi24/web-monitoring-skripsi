<form method="post" action="{{ route('bimbingan-mahasiswa.simpan') }}">
    @csrf
    @method('post')
    <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <input name="nama" type="text" class="form-control modal-title-input" id="bimbinganTitle"
                        placeholder="Bimbingan" value="Bimbingan 2">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="basic-default-name">Tanggal</label>
                        <div class="col-sm-9">
                            <input name="tanggal" type="text" class="form-control" id="basic-default-name"
                                value="{{ now()->format('Y-m-d') }}" readonly />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="basic-default-name">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="basic-default-name"
                                value="{{ $mahasiswa->nama }}" readonly />
                            <input type="hidden" name="mahasiswa_id" value="{{ $mahasiswa->id }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="basic-default-name">Nama Dosen</label>
                        <div class="col-sm-9">
                            <select name="dospem_id" class="form-select" id="exampleFormControlSelect1"
                                aria-label="Default select example">
                                <option selected>Pilih Dosen</option>
                                <option value="{{ $dosen1->id }}">{{ $dosen1->nama }}</option>
                                <option value="{{ $dosen2->id }}">{{ $dosen2->nama }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="bab">Bab</label>
                        <div class="col-sm-9">
                            <select class="form-select" id="bab" name="bab_id"
                                aria-label="Default select example">
                                <option selected>Pilih Bab</option>
                                @foreach ($babs as $bab)
                                    <option value="{{ $bab->id }}">{{ $bab->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="subBab">Sub Bab</label>
                        <div class="col-sm-9">
                            <select class="form-select" id="subBab" name="subbab_id"
                                aria-label="Default select example">
                                <option selected>Pilih Sub Bab</option>
                                @foreach ($subBabs as $subBab)
                                    <option value="{{ $subBab->id }}" data-parent="{{ $subBab->bab->id }}">
                                        {{ $subBab->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
</form>
