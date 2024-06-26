<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <style>
        body {
            min-height: 100vh;
        }

        .card.card-login {
            min-width: 75%;
            margin: 20px 0px;
        }

        .logo {
            height: 180px;
        }
    </style>
</head>

<body class="bg-primary d-flex justify-content-center align-items-center">

    @if (Session::has('failed'))
        <div class="position-fixed p-3" style="z-index: 5; right: 0; bottom: 0;">
            <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true"
                data-autohide="false">
                <div class="toast-header">
                    <strong class="mr-auto">Gagal login</strong>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="toast-body px-5 py-3">
                    {{ Session::get('failed') }}
                </div>
            </div>
        </div>
    @endif

    <div class="card card-login">
        <div class="card-body px-5 py-5 py-md-4 ">
            <div class="row">
                <div class="col-lg-8 d-none d-lg-flex justify-content-center">
                    <img src="{{ asset('assets/img/login.svg') }}" alt="img" class="w-75">
                </div>
                <div class="col-lg-4">
                    <div class="text-center">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="" class="logo">
                    </div>
                    <form action="{{ route('authenticate') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nim">Nomor Induk Mahasiswa</label>
                            <input type="text" class="form-control" id="nim" name="nim" autocomplete="off"
                                value="{{ old('nim') }}" autofocus required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Remember me</label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                        <div class="text-center">
                            <a href="{{ route('register') }}" class="btn btn-link">Daftar</a>
                        </div>
                    </form>

                    <hr>

                    <button type="button" class="btn btn-info btn-block"
                        onclick="document.location.href = '{{ route('dosen.login') }}'">Login Dosen</button>


                </div>
            </div>
            <div class="small text-muted text-center mt-3 d-md-block d-none">
                @php
                    if (date('Y') == 2020) {
                        $year = '2020';
                    } else {
                        $year = '2020 - ' . date('Y');
                    }
                @endphp
                {{ config('app.name') }} | Copyright &copy; {{ $year }}
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/plugins/jquery/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    @if (Session::has('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ Session::get('success') }}'
            })
        </script>
    @endif
    @if (Session::has('failed'))
        <script>
            $(document).ready(function() {
                $('#liveToast').toast('show');
            });
        </script>
    @endif
</body>

</html>
