@extends('layout.layout')

@section('title', 'Login')

@section('main')
    <div class="row p-4">
        <div class="col-9">
        </div>
        <div class="col-3 d-flex justify-content-end">
            <div class="flex-row align-items-center ">
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    <a href="{{ route('landing-page') }}" class="btn btn-secondary d-flex align-items-center"
                        style="width: max-content">
                        <span class="tf-icons bx bx-arrow-back me-md-1"></span>
                        <span class="d-none d-md-block">Kembali</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="authentication-wrapper authentication-basic ">
        <div class="authentication-inner">
            <div class="card">
                <div class="card-body">
                    <h2>Login</h2>
                    <hr class="dark horizontal">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            @endforeach
                        </div>
                    @endif
                    <form class="mb-3" action="" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required
                                value="{{ old('username') }}" placeholder="Masukkan Username Anda" autofocus />
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password">Password</label>
                            </div>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password" class="form-control" required name="password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password" />
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>
                        <div class="mb-3 d-flex justify-content-center">
                            <button class="btn btn-primary d-grid w-20" type="submit">Log in</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
