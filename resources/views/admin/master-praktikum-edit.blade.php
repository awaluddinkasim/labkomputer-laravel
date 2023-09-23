@extends('layout')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ $praktikum->nama }}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.praktikum-update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" value="{{ Request::get('id') }}">
                                <div class="form-group">
                                    <label for="nama">Nama Praktikum</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        autocomplete="off" value="{{ $praktikum->nama }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="semester">Semester</label>
                                    <select class="custom-select mr-sm-2" id="semester" name="semester" required>
                                        <option selected hidden value="">Pilih</option>
                                        @for ($i = 1; $i <= 8; $i++)
                                            <option value="{{ $i }}" {{ $praktikum->semester == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="prodi">Program Studi</label>
                                    <select class="custom-select mr-sm-2" id="prodi" name="prodi" required>
                                        <option selected hidden value="">Pilih</option>
                                        @foreach ($daftarFakultas as $fakultas)
                                            @if ($fakultas->prodi->count())
                                                <optgroup label="Fakultas {{ $fakultas->nama }}">
                                                    @foreach ($fakultas->prodi as $prodi)
                                                        <option value="{{ $prodi->id }}" {{ $praktikum->id_prodi == $prodi->id ? 'selected' : '' }}>{{ $prodi->nama }}</option>
                                                    @endforeach
                                                </optgroup>
                                            @endif
                                        @endforeach
                                    </select>
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
    </section>
@endsection
