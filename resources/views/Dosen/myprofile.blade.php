@extends('layout.layout-dosen')

@section('title', 'Profil Saya')

@section('main')
    <div class="row">
        <div class="col-12">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card mb-4">
                <div class="card-title mb-0">
                    <div class="card-title d-flex align-items-end justify-content mb-0">
                        <div class="dropdown ms-auto">
                            <button class="btn pt-4 mx-2" type="button" id="cardOpt4" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#smallModal">Ganti
                                    Password</a>
                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#smallModal2">Ganti Foto
                                    Profil</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="d-flex justify-content-center mb-3">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            @if ($dosen->foto)
                                <!-- Jika ada foto, tampilkan foto -->
                                <img src="{{ url('Foto Dosen') . '/' . $dosen->foto }}" alt="user-avatar"
                                    class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                            @else
                                <div class="card rounded bg-label-dark"
                                    style="height: 100px; width: 100px; display: flex; align-items: center; justify-content: center;">
                                    <h1 class="mb-0"><strong>
                                            {{ generateInitials($dosen->nama) }}
                                        </strong></h1>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="text-center mb-4">
                        <h3 class="mb-0" style="font-weight: lighter">{{ $dosen->nama }}</h3>
                        <p class=" mb-0 text-muted">{{ $dosen->email }}</p>
                        <div class="" style="font-weight: bold">
                            <p class="mb-0 d-inline">{{ $dosen->nip }}</p>
                        </div>
                    </div>
                    <div class="modal fade" id="smallModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel2">Ganti Password</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="passwordForm" method="post"
                                        action="{{ route('profil-dosen.password', ['id' => $user->id]) }}">
                                        @csrf
                                        @method('post')
                                        <div class="row">
                                            <div class="col mb-3">
                                                <label for="newPassword" class="form-label">Password Baru</label>
                                                <input type="password" name="newpassword" id="newpassword"
                                                    class="form-control" placeholder="Enter New Password" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col mb-3">
                                                <label for="confirmPassword" class="form-label">Konfirmasi Password</label>
                                                <input type="password" name="conpassword" id="conpassword"
                                                    class="form-control" placeholder="Confirm Password" />
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="smallModal2" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel2">Ganti Foto Profil</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="passwordForm" method="post"
                                        action="{{ route('profil-dosen.fotoProfil2', ['id' => $user->id]) }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('post')
                                        <div class="mb-3 ">
                                            <div class="mb-3">
                                                @if ($dosen->foto)
                                                    <div
                                                        class="text-center d-flex align-items-center justify-content-center mb-2">
                                                        <img src="{{ url('Foto Dosen') . '/' . $dosen->foto }}"
                                                            alt="user-avatar" class="d-block rounded" height="100"
                                                            width="100" id="uploadedAvatar" />
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <input class="form-check-input" name="hapus_foto" type="checkbox"
                                                            id="defaultCheck1" />
                                                        <label class="form-check-label ms-2" for="defaultCheck1">Reset Foto
                                                        </label>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="mb-3">
                                                <label for="formFile" class="form-label">Foto Profil Baru</label>
                                                <input name="foto" value="" class="form-control" type="file"
                                                    id="formFile" accept=".jpg, .jpeg, .png" />
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Function to validate password conditions
            function validatePassword(password) {
                // Clear previous warning messages
                $('.password-warning').remove();

                // Validate password length and format
                if (password.length < 8 || !/^(?=.*[a-zA-Z])(?=.*\d).+$/.test(password)) {
                    $('#newpassword').after(
                        '<div class="text-warning password-warning"><small>Password berisi minimal 8 karakter, dengan kombinasi huruf dan angka</samll></div>'
                    );
                }
            }

            // Real-time validation on new password input
            $('#newpassword').on('input', function() {
                var newPassword = $(this).val();
                validatePassword(newPassword);
            });

            // Real-time validation on confirm password input
            $('#conpassword').on('input', function() {
                var confirmPassword = $(this).val();
                var newPassword = $('#newpassword').val();

                // Clear previous warning messages
                $('.password-warning').remove();

                // Check if passwords match
                if (newPassword !== confirmPassword) {
                    $('#conpassword').after(
                        '<div class="text-warning password-warning"></samll>Passwords belum sama</samll></div>'
                    );
                }
            });

            // Form submission
            $('#passwordForm').submit(function(event) {
                // Prevent form submission
                event.preventDefault();

                // Get password values
                var newPassword = $('#newpassword').val();
                var confirmPassword = $('#conpassword').val();

                // Validate password length and format
                validatePassword(newPassword);

                // Check if passwords match
                if (newPassword !== confirmPassword) {
                    $('#conpassword').after(
                        '<div class="text-danger password-warning">Passwords do not match.</div>');
                    return;
                }

                // If validation passes, submit the form
                $(this).unbind('submit').submit();
            });
        });
    </script>
@endsection