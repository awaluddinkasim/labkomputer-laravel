@extends('layout')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ $prodi->nama }}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.prodi-update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" value="{{ Request::get('id') }}">
                                <div class="form-group">
                                    <label for="fakultas">Fakultas</label>
                                    <select class="custom-select mr-sm-2" id="fakultas" name="fakultas" required>
                                        <option selected hidden value="">Pilih</option>
                                        @foreach ($daftarFakultas as $fakultas)
                                            <option value="{{ $fakultas->id }}" {{ $prodi->id_fakultas == $fakultas->id ? 'selected' : '' }}>{{ $fakultas->nama }}</option>
                                        @endforeach
                                      </select>
                                </div>
                                <div class="form-group">
                                    <label for="prodi">Program Studi</label>
                                    <input type="text" class="form-control" id="prodi" name="prodi" autocomplete="off"
                                        value="{{ $prodi->nama }}" required>
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
