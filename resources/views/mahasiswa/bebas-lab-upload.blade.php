@extends('layout')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Upload Berkas</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-md-6 text-center">
                    <img src="{{ asset('assets/img/upload.svg') }}" alt="" class="w-75">
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('bebas-lab.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="bukti-bayar" class="form-label">Bukti Pembayaran (.pdf)</label>
                                    <input type="file" class="form-control" id="bukti-bayar" name="bukti-bayar" accept=".pdf" required>
                                </div>
                                <div class="mb-3">
                                    <label for="berkas" class="form-label">Berkas (.pdf)</label>
                                    <input type="file" class="form-control" id="berkas" name="berkas" accept=".pdf" required>
                                    <small id="noteHelp" class="form-text text-danger">* Pastikan terdapat Slip Praktikum, KRS, dan KHS yang menampilkan nilai lulus dari setiap praktikum</small>
                                </div>
                                <div class="mb-3">
                                    <label for="catatan" class="form-label">Catatan (opsional)</label>
                                    <textarea class="form-control" id="catatan" rows="4"></textarea>
                                </div>
                                <button class="btn btn-primary">Upload</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
