<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="{{ asset('css/material-dashboard.css') }}">

</head>

<body class="bg-gray-200">
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <div class="d-flex justify-content-center">
            <div class="row ">
                <div class="col-12 mt-4 mb-4">
                    <div class="card">
                        <div class="card-header pb-0 text-center">
                            <h2>Login</h2>
                            <hr class="dark horizontal">
                        </div>
                        {{-- @if ($errors->any())
                    <div class="allert allert-danger">
                        @foreach ($errors->all() as $item)
                            <p>{{ $item }}</p><br>
                        @endforeach
                    </div>
                @endif --}}
                        <div class="card-body pt-0">
                            <form action="" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5>Username</h5>
                                        <div class="input-group input-group-outline my-3">
                                            <label class="form-label">Username</label>
                                            <input type="text" name="username" required value="{{ old('username') }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <h5>Password</h5>
                                        <div class="input-group input-group-outline my-3">
                                            <label class="form-label">Password</label>
                                            <input type="password" name="password" required class="form-control">
                                        </div>
                                    </div>
                                    <input type="submit" class="btn bg-gradient-info" name="submit" value="Login">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
