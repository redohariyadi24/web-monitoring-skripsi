@extends('layout.layout-admin')

@section('title', 'Edit Jadwal Sidang')
@section('main')
    <div class="col-xl mx-auto" style="max-width: 700px">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Form Edit Jadwal Sidang</h5>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('jadwal-sidang.update', ['jadwal' => $jadwal->id]) }}">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <label class="form-label">Jenis</label>
                        <select class="form-select" name="jenis" aria-label="Default select example">
                            <option value="Seminar Hasil" {{ $jadwal->jenis === 'Seminar Hasil' ? 'selected' : '' }}>Seminar
                                Hasil</option>
                            <option value="Sidang Skripsi" {{ $jadwal->jenis === 'Sidang Skripsi' ? 'selected' : '' }}>
                                Sidang Skripsi</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">Mahasiswa</label>
                        <select name="skripsi_id" class="form-select" id="exampleFormControlSelect1"
                            aria-label="Default select example">
                            <option selected disabled>-- Pilih Mahasiswa --</option>

                            {{-- Option untuk mahasiswa yang dipilih (edit) --}}
                            <option value="{{ $jadwal->skripsi->mahasiswa->npm }}" selected>
                                {{ $jadwal->skripsi->mahasiswa->npm }} - {{ $jadwal->skripsi->mahasiswa->nama }}
                            </option>

                            {{-- Option untuk mahasiswa yang belum memiliki jadwal --}}
                            @foreach ($mahasiswasBelumJadwal as $mahasiswa)
                                <option value="{{ $mahasiswa->npm }}">
                                    {{ $mahasiswa->npm }} - {{ $mahasiswa->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label">Jadwal Sidang</label>
                        <input name="tanggal" id="tanggal" class="form-control" type="datetime-local"
                            value="{{ $jadwal->tanggal }}" />
                        <p class="text-warning m-1" id="error-message" style="font-size: 0.9em"></p>
                    </div>
                    <button type="submit" class="btn btn-primary">Perbarui Data</button>
                </form>
            </div>
        </div>
    </div>
@endsection
