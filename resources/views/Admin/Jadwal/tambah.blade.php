@extends('layout.layout-admin')

@section('title', 'Tambah Jadwal Sidang')

@section('main')
    <div class="col-xl mx-auto" style="max-width: 700px">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Form Pengisian Jadwal Sidang Skripsi</h5>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('jadwal-sidang.simpan') }}" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="jenis" aria-label="Default select example">
                            <option selected value="Seminar Hasil">Seminar Hasil</option>
                            <option value="Sidang Skripsi">Sidang Skripsi</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">Mahasiswa</label>
                        <select name="skripsi_id" class="form-select" id="exampleFormControlSelect1"
                            aria-label="Default select example">
                            <option selected>Pilih Mahasiswa</option>
                            @foreach ($mahasiswas as $mahasiswa)
                                <option value="{{ $mahasiswa->npm }}">{{ $mahasiswa->npm }} - {{ $mahasiswa->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label">Jadwal Sidang</label>
                        <input name="tanggal" id="tanggal" class="form-control" type="datetime-local"
                            value="2021-06-18T12:30:00" />
                        <p class="text-warning m-1" id="error-message" style="font-size: 0.9em"></p>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        // Mendapatkan tanggal saat ini
        var currentDate = new Date();

        // Mengonversi tanggal saat ini menjadi format yang dapat diterima oleh input datetime-local
        var currentDateString = currentDate.toISOString().slice(0, 16);

        // Mengatur nilai default input tanggal menjadi tanggal saat ini
        document.getElementById('tanggal').value = currentDateString;
    </script>

    <script>
        function validateDate() {
            var selectedDate = new Date(document.getElementById('tanggal').value);
            var currentDate = new Date();

            // Periksa apakah tanggal yang dipilih kurang dari tanggal saat ini
            if (selectedDate < currentDate) {
                document.getElementById('error-message').innerHTML = 'Tanggal tidak boleh kurang dari tanggal saat ini.';
                document.getElementById('tanggal').value = currentDate.toISOString().slice(0,
                    16); // Setel kembali tanggal menjadi tanggal saat ini
            } else {
                document.getElementById('error-message').innerHTML = '';
            }
        }

        // Mendengarkan perubahan input tanggal
        document.getElementById('tanggal').addEventListener('change', validateDate);
    </script>

@endsection
