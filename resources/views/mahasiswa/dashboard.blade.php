@extends('layout')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <ion-icon name="document"></ion-icon>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jumlah Praktikum</h4>
                            </div>
                            <div class="card-body">
                                <span>0</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <ion-icon name="receipt-outline"></ion-icon>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Slip Terupload</h4>
                            </div>
                            <div class="card-body">
                                <span>0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

