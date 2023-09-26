@extends('layout')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Ganti Password</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body text-center">
                    <div class="col-md-5 mx-auto">
                        <img src="{{ asset('assets/img/success.svg') }}" alt="">
                        <h4 class="mb-5">{{ $message }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
