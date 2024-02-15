<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">

    {{-- LANDING PAGE STYLE --}}
    <link rel="stylesheet" href="{{ asset('assets/lp/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/lp/slick/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/lp/fancybox/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/lp/aos/aos.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    {{-- CUSTOM STYLE --}}
    <link rel="stylesheet" href="{{ asset('assets/lp/style.css') }}">
</head>

<body class="body-wrapper" data-spy="scroll" data-target=".privacy-nav">
    <noscript>You don't have javascript enabled! Please download Google Chrome!</noscript>
    <nav class="navbar main-nav navbar-expand-lg px-2 px-sm-0 py-2 py-lg-0">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('assets/img/logo.png') }}" alt="logo" style="height: 35px">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#FAQ">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                    <li class="nav-item d-flex align-self-center justify-content-center">
                        <button class="btn btn-primary btn-sm px-3 ml-lg-3"
                            onclick="document.location.href = '{{ route('login') }}'">
                            @if (Auth::check() || Auth::guard('admin')->check() || Auth::guard('dosen')->check())
                                Dashboard
                            @else
                                Login
                            @endif
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="section gradient-banner">
        <div class="shapes-container">
            <div class="shape" data-aos="fade-down-left" data-aos-duration="1500" data-aos-delay="100"></div>
            <div class="shape" data-aos="fade-down" data-aos-duration="1000" data-aos-delay="100"></div>
            <div class="shape" data-aos="fade-up-right" data-aos-duration="1000" data-aos-delay="200"></div>
            <div class="shape" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200"></div>
            <div class="shape" data-aos="fade-down-left" data-aos-duration="1000" data-aos-delay="100"></div>
            <div class="shape" data-aos="fade-down-left" data-aos-duration="1000" data-aos-delay="100"></div>
            <div class="shape" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="300"></div>
            <div class="shape" data-aos="fade-down-right" data-aos-duration="500" data-aos-delay="200"></div>
            <div class="shape" data-aos="fade-down-right" data-aos-duration="500" data-aos-delay="100"></div>
            <div class="shape" data-aos="zoom-out" data-aos-duration="2000" data-aos-delay="500"></div>
            <div class="shape" data-aos="fade-up-right" data-aos-duration="500" data-aos-delay="200"></div>
            <div class="shape" data-aos="fade-down-left" data-aos-duration="500" data-aos-delay="100"></div>
            <div class="shape" data-aos="fade-up" data-aos-duration="500" data-aos-delay="0"></div>
            <div class="shape" data-aos="fade-down" data-aos-duration="500" data-aos-delay="0"></div>
            <div class="shape" data-aos="fade-up-right" data-aos-duration="500" data-aos-delay="100"></div>
            <div class="shape" data-aos="fade-down-left" data-aos-duration="500" data-aos-delay="0"></div>
        </div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 order-2 order-md-1 text-center text-md-left">
                    <h1 class="text-white font-weight-bold mb-4">Laboratorium Komputer</h1>
                    <h4 class="text-white mb-5">Universitas Islam Makassar</h4>
                </div>
                <div class="col-md-6 text-center order-1 order-md-2">
                    <img class="w-50" src="{{ asset('assets/img/UIM.png') }}" alt="screenshot">
                </div>
            </div>
        </div>
    </section>

    <section class="section pt-0 position-relative pull-top">
        <div class="container">
            <div class="rounded shadow p-5 bg-white">
                <div class="row">
                    <div class="col-lg-4 col-md-6 mt-5 mt-md-0 text-center">
                        <i class="fa fa-code fa-2x text-primary"></i>
                        <h3 class="mt-4 text-capitalize h5 ">Software Development</h3>
                        <p class="regular text-muted">Pengembangan perangkat lunak mulai dari aplikasi desktop,
                            website, hingga mobile.</p>
                    </div>
                    <div class="col-lg-4 col-md-6 mt-5 mt-md-0 text-center">
                        <i class="fa fa-robot fa-2x text-primary"></i>
                        <h3 class="mt-4 text-capitalize h5 ">Robotics</h3>
                        <p class="regular text-muted">Desain, konstruksi, dan operasi berbagai jenis robot yang
                            diprogram melalui mikrokontroller.</p>
                    </div>
                    <div class="col-lg-4 col-md-6 mt-5 mt-md-0 text-center">
                        <i class="fa fa-network-wired fa-2x text-primary"></i>
                        <h3 class="mt-4 text-capitalize h5 ">Network Systems</h3>
                        <p class="regular text-muted">Mengenali dan memahami tentang teknologi jaringan, server, dan
                            keamanan perangkat jaringan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="feature section pt-0" id="FAQ">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 ml-auto justify-content-center">
                    <!-- Feature Mockup -->
                    <div class="image-content" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="100">
                        <img class="img-fluid" src="{{ asset('assets/img/FAQ.svg') }}" alt="iphone">
                    </div>
                </div>
                <div class="col-lg-6 mr-auto align-self-center">
                    <div class="feature-content">
                        <!-- Feature Title -->
                        <h2>Frequently Asked Question</h2>
                        <!-- Feature Description -->
                        <div class="accordion" id="questions">
                            <h2 class="mb-0">
                                <button
                                    class="btn btn-link btn-block text-left text-decoration-none text-dark font-weight-bold d-flex"
                                    type="button" data-toggle="collapse" data-target="#pertanyaan1"
                                    aria-expanded="true" aria-controls="pertanyaan1">
                                    Bagaimana cara melakukan pendaftaran?
                                    <div class="ml-auto bd-highlight align-self-center pl-3"><i
                                            class="fa fa-chevron-down"></i></div>
                                </button>
                            </h2>
                            <div id="pertanyaan1" class="collapse collapsed" aria-labelledby="headingOne"
                                data-parent="#questions">
                                <div class="card-body">
                                    <p class="mb-2">Silahkan masuk ke halaman Register untuk
                                        melakukan registrasi akun.</p>
                                </div>
                            </div>

                            <h2 class="mb-0">
                                <button
                                    class="btn btn-link btn-block text-left text-decoration-none text-dark font-weight-bold d-flex"
                                    type="button" data-toggle="collapse" data-target="#pertanyaan3"
                                    aria-expanded="true" aria-controls="pertanyaan3">
                                    Saya sudah mendaftar tapi kenapa belum bisa login?
                                    <div class="ml-auto bd-highlight align-self-center pl-3"><i
                                            class="fa fa-chevron-down"></i></div>
                                </button>
                            </h2>
                            <div id="pertanyaan3" class="collapse collapsed" aria-labelledby="headingThree"
                                data-parent="#questions">
                                <div class="card-body">
                                    <p class="mb-0">Anda baru bisa login setelah diverifikasi oleh <b>admin</b> atau
                                        <b>asisten</b>.
                                    </p>
                                </div>
                            </div>

                            <h2 class="mb-0">
                                <button
                                    class="btn btn-link btn-block text-left text-decoration-none text-dark font-weight-bold d-flex"
                                    type="button" data-toggle="collapse" data-target="#pertanyaan2"
                                    aria-expanded="true" aria-controls="pertanyaan2">
                                    Bagaimana jika akun saya ditolak?
                                    <div class="ml-auto bd-highlight align-self-center pl-3"><i
                                            class="fa fa-chevron-down"></i></div>
                                </button>
                            </h2>
                            <div id="pertanyaan2" class="collapse collapsed" aria-labelledby="headingTwo"
                                data-parent="#questions">
                                <div class="card-body">
                                    <p class="mb-0">Silahkan <b>daftar ulang</b> dan perhatikan
                                        dengan baik data yang Anda masukkan.</p>
                                </div>
                            </div>

                            <h2 class="mb-0">
                                <button
                                    class="btn btn-link btn-block text-left text-decoration-none text-dark font-weight-bold d-flex"
                                    type="button" data-toggle="collapse" data-target="#pertanyaan4"
                                    aria-expanded="true" aria-controls="pertanyaan4">
                                    Lupa password akun?
                                    <div class="ml-auto bd-highlight align-self-center pl-3"><i
                                            class="fa fa-chevron-down"></i></div>
                                </button>
                            </h2>
                            <div id="pertanyaan4" class="collapse collapsed" aria-labelledby="headingFour"
                                data-parent="#questions">
                                <div class="card-body">
                                    <p class="mb-0">Silahkan menghubungi <b>admin</b> atau <b>asisten</b>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section bg-blue" id="contact">
        <div class="container" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
            <div class="card my-3 py-4">
                <div class="card-body">
                    <h2 class="text-center">Hubungi Kami</h2>
                    <hr class="mb-5" style="width: 100px; margin: auto">
                    <div class="row">
                        <div class="col-lg text-center mt-3">
                            <i class="fa fa-user fa-4x text-muted"></i>
                            <h5 class="mt-4">Asisten Lab</h5>
                            <div class="contact">
                                <p><i class="fab fa-whatsapp"></i> +62{{ $asisten1 }}</p>
                            </div>
                        </div>
                        <div class="col-lg text-center mt-3">
                            <i class="fa fa-user fa-4x text-muted"></i>
                            <h5 class="mt-4">Kepala Lab</h5>
                            <div class="contact">
                                <p><i class="fab fa-whatsapp"></i> +62{{ $kepalaLab }}</p>
                            </div>
                        </div>
                        <div class="col-lg text-center mt-3">
                            <i class="fa fa-user fa-4x text-muted"></i>
                            <h5 class="mt-4">Asisten Lab</h5>
                            <div class="contact">
                                <p><i class="fab fa-whatsapp"></i> +62{{ $asisten2 }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="footer-main">
            <div class="container text-center px-lg-5">
                <h4 class="text-white">{{ config('app.name') }}</h4>
                <small class="text-secondary">
                    @php
                        if (date('Y') == 2020) {
                            $year = '2020';
                        } else {
                            $year = '2020 - ' . date('Y');
                        }
                    @endphp
                    Copyright &copy; {{ $year }}
                </small>
            </div>
        </div>
    </footer>

    <div class="scroll-top-to">
        <i class="fa fa-chevron-up"></i>
    </div>

    {{-- LANDING PAGE JS --}}
    <script src="{{ asset('assets/plugins/jquery/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('assets/lp/slick/slick.min.js') }}"></script>
    <script src="{{ asset('assets/lp/fancybox/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('assets/lp/syotimer/jquery.syotimer.min.js') }}"></script>
    <script src="{{ asset('assets/lp/aos/aos.js') }}"></script>

    {{-- CUSTOM SCRIPT --}}
    <script src="{{ asset('assets/lp/script.js') }}"></script>
</body>

</html>
