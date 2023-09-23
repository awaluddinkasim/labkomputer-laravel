@extends('layout')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1 class="mr-auto">Edit Informasi</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-lg-7 d-none d-lg-flex align-self-center">
                    <img src="{{ asset('assets/img/informasi-edit.svg') }}" alt="" class="w-75 mx-auto">
                </div>
                <div class="col-lg-5">
                    <div class="card">
                        <form action="{{ route('admin.informasi-update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ Request::get('id') }}">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="judul">Judul</label>
                                    <input type="text" class="form-control" id="judul" name="judul" autocomplete="off" value="{{ $informasi->judul }}"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="konten">Konten</label>
                                    <textarea class="form-control" id="konten" name="konten" rows="12" required>{{ $informasi->konten }}</textarea>
                                </div>
                            </div>
                            <div class="card-footer text-right pb-4">
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
