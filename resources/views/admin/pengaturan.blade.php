@extends('layout')

@section('content')
    <form action="" method="POST" id="formPengaturan">
        <section class="section">
            <div class="section-header">
                <h1 class="mr-auto">Pengaturan</h1>
                <button class="btn btn-success" onclick="save()">
                    <i class="fas fa-save mr-2"></i>
                    <span>Simpan</span>
                </button>
            </div>

            @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ Session::get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="section-body">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h5>Pengaturan sistem</h5>
                                </div>
                                <div class="form-group row">
                                    <label for="semester" class="col-sm-6 col-form-label align-self-center">Semester</label>
                                    <div class="col-sm-6">
                                        <select class="custom-select mr-sm-2" id="semester" name="semester" required>
                                            <option selected hidden value="">Pilih</option>
                                            <option value="ganjil" {{ $semester->value == 'ganjil' ? 'selected' : '' }}>
                                                Ganjil</option>
                                            <option value="genap" {{ $semester->value == 'genap' ? 'selected' : '' }}>
                                                Genap</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="upload" class="col-sm-6 col-form-label align-self-center">Opsi Upload
                                        Slip</label>
                                    <div class="col-sm-6">
                                        <select class="custom-select mr-sm-2" id="upload" name="upload" required>
                                            <option selected hidden value="">Pilih</option>
                                            <option value="open" {{ $upload->value == 'open' ? 'selected' : '' }}>
                                                Terbuka untuk Upload</option>
                                            <option value="closed" {{ $upload->value == 'closed' ? 'selected' : '' }}>
                                                Tidak Bisa Upload</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h5>Kontak</h5>
                                </div>
                                <div class="form-group">
                                    <label for="kepala_lab">Kepala Lab</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">+62</span>
                                        </div>
                                        <input type="text" class="form-control" id="kepala_lab" name="kepala_lab"
                                            autocomplete="off" value="{{ $kepala_lab->value }}" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="asisten1">Asisten Lab</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">+62</span>
                                        </div>
                                        <input type="text" class="form-control" id="asisten1" name="asisten1"
                                            autocomplete="off" value="{{ $asisten1->value }}" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="asisten2">Asisten Lab</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">+62</span>
                                        </div>
                                        <input type="text" class="form-control" id="asisten2" name="asisten2"
                                            autocomplete="off" value="{{ $asisten2->value }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
@endsection
