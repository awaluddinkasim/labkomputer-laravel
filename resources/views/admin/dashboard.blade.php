@extends('layout')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <ion-icon name="receipt-outline"></ion-icon>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Slip Pembayaran</h4>
                            </div>
                            <div class="card-body">
                                <span>{{ $slip }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <ion-icon name="person-outline"></ion-icon>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Mahasiswa Aktif</h4>
                            </div>
                            <div class="card-body">
                                <span>{{ $mahasiswaAktif }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <ion-icon name="time-outline"></ion-icon>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Mahasiswa Pending</h4>
                            </div>
                            <div class="card-body">
                                <span class="pending">{{ $unverifiedUser }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        channel.bind('user-registered', function(data) {
            $('.pending').text(data.totalUnverified);
        });
    </script>
@endpush
