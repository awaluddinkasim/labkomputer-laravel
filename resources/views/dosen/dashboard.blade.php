@extends('layout')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <img src="{{ asset('assets/img/welcome.svg') }}" alt="" class="w-75">
                        </div>
                        <div class="col-md-6 d-flex align-items-center">
                            <div class="container-fluid">
                                <h2>Selamat Datang!</h2>
                                <p>
                                    Selamat datang di Aplikasi Lab Komputer UIM. Anda dapat dengan mudah
                                    memeriksa bukti pembayaran praktikum dari mahasiswa Anda di sini. Silakan pilih
                                    praktikum yang Anda ampu dan periksa setiap bukti pembayaran dengan cermat.
                                </p>
                                <p>

                                    Jika Anda memerlukan bantuan atau menemui masalah teknis, silahkan menghubungi Admin.
                                    Terima
                                    kasih atas perhatiannya. Semoga Anda memiliki pengalaman yang baik menggunakan sistem
                                    ini!
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
