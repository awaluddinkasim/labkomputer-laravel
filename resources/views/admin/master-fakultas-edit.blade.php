@extends('layout')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ $fakultas->nama }}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.fakultas-update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" value="{{ Request::get('id') }}">
                                <div class="form-group">
                                    <label for="fakultas">Nama Fakultas</label>
                                    <input type="text" class="form-control" id="fakultas" name="fakultas"
                                        autocomplete="off" value="{{ $fakultas->nama }}" required>
                                </div>
                                <div class="clearfix">
                                    <button type="submit" class="btn btn-success float-right">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 text-center d-none d-md-block">
                    <img src="{{ asset('assets/img/edit-master.svg') }}" class="w-75">
                </div>
            </div>
        </div>
    </section>
@endsection
