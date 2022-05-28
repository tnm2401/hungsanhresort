

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng nhập quản trị</title>
    <link rel="shortcut icon" href="{{ asset('storage') }}/uploads/setting/{{ Setting::first()->faviconadmin }}" type="image/x-icon">
    {{-- <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet"> --}}
    {{-- <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css"> --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/auth/css/login.css">
</head>

<body>
    <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
        <div class="container">
            <div class="card login-card">
                <div class="row no-gutters">

                    <div class="col-md-5">
                        <img src="{{ asset('backend') }}/auth/images/login.png" alt="login" class="login-card-img">
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <p class="login-card-description">Đăng nhập quản trị</p>

                            <div class="brand-wrapper">
                                <img src="{{ asset('storage') }}/uploads/setting/{{ Setting::first()->logoindex }}" alt="logo" class="logo"> <span><strong>{{ Setting::first()->translations->name ?? '' }}</strong></span>
                            </div>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="email" class="sr-only">Email</label>
                                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email address">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="form-group mb-4">
                                    <label for="password" class="sr-only">Mật khẩu</label>
                                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="***********">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <input name="login" id="login" class="btn btn-block login-btn mb-4" type="submit" value="Đăng nhập">
                            </form>

                            {{-- <a href="#!" class="forgot-password-link">Quên mật khẩu ?</a> --}}
                            {{-- <p class="login-card-footer-text">Don't have an account? <a href="#!" class="text-reset">Register here</a></p> --}}
                            <nav >
                              <small>  <a style="color: #fabec6" href="#!">Designed by AIB</a></small>

                            </nav>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>
