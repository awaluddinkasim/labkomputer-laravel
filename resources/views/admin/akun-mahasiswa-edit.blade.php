@extends('layout')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1 class="mr-auto">Edit Mahasiswa</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-lg-7 d-none d-lg-flex align-self-center">
                    <img src="{{ asset('assets/img/edit-akun.svg') }}" alt="" class="w-75 mx-auto">
                </div>
                <div class="col-lg-5">
                    <div class="card">
                        <form action="{{ route('admin.mhs-update', $mahasiswa->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="text-center mb-4">
                                    <img src="{{ asset('f/avatar/' . $mahasiswa->foto) }}" alt="" class="pict-oval">
                                </div>
                                <div class="form-group">
                                    <label class="mb-0" for="nim">Nomor Induk Mahasiswa</label>
                                    <input type="text" class="form-control" id="nim" name="nim"
                                        value="{{ $mahasiswa->nim }}" autocomplete="off" disabled>
                                </div>
                                <div class="form-group">
                                    <label class="mb-0" for="nama">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        value="{{ $mahasiswa->nama }}" autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                    <label class="mb-0" for="no_hp">No. Handphone</label>
                                    <input type="text" class="form-control" id="no_hp" name="no_hp"
                                        value="{{ $mahasiswa->no_hp }}" autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                    <label class="mb-0" for="prodi">Program Studi</label>
                                    <select class="custom-select mr-sm-2" id="prodi" name="prodi" required>
                                        <option selected hidden value="">Pilih</option>
                                        @foreach ($daftarFakultas as $fakultas)
                                            @if ($fakultas->prodi->count())
                                            <optgroup label="Fakultas {{ $fakultas->nama }}">
                                                @foreach ($fakultas->prodi as $prodi)
                                                    <option value="{{ $prodi->id }}" {{ $mahasiswa->id_prodi == $prodi->id ? 'selected' : '' }}>{{ $prodi->nama }}</option>
                                                @endforeach
                                            </optgroup>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="mb-0" for="level">Role</label>
                                    <select class="custom-select mr-sm-2" id="level" name="level" required>
                                        <option selected hidden value="">Pilih</option>
                                        <option value="asisten" {{ $mahasiswa->level == "asisten" ? 'selected' : '' }}>Asisten Lab</option>
                                        <option value="mahasiswa" {{ $mahasiswa->level == "mahasiswa" ? 'selected' : '' }}>Mahasiswa</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="mb-0" for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        value="">
                                    <small id="passHelp" class="form-text text-muted">Kosongkan jika tidak ingin mengganti password</small>
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
