@extends('layout')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1 class="mr-auto">Edit Profil</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-lg-7 d-none d-lg-flex align-self-center">
                    <img src="{{ asset('assets/img/edit-akun.svg') }}" alt="" class="w-75 mx-auto">
                </div>
                <div class="col-lg-5">
                    <div class="card">
                        <form action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="text-center mb-4">
                                    <img src="{{ asset('f/avatar/' . auth()->user()->foto) }}" alt=""
                                        class="pict-oval">
                                </div>
                                <div class="form-group">
                                    <label class="mb-0" for="nim">Nomor Induk Mahasiswa</label>
                                    <input type="text" class="form-control" id="nim" name="nim"
                                        value="{{ auth()->user()->nim }}" autocomplete="off" maxlength="11" disabled>
                                </div>
                                <div class="form-group">
                                    <label class="mb-0" for="nama">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        value="{{ auth()->user()->nama }}" autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                    <label class="mb-0" for="prodi">Program Studi</label>
                                    <select class="custom-select mr-sm-2" id="prodi" name="prodi" required>
                                        <option selected hidden value="">Pilih</option>
                                        @foreach ($daftarFakultas as $fakultas)
                                            @if ($fakultas->prodi->count())
                                                <optgroup label="Fakultas {{ $fakultas->nama }}">
                                                    @foreach ($fakultas->prodi as $prodi)
                                                        <option value="{{ $prodi->id }}"
                                                            {{ auth()->user()->id_prodi == $prodi->id ? 'selected' : '' }}>
                                                            {{ $prodi->nama }}</option>
                                                    @endforeach
                                                </optgroup>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="mb-0" for="no_hp">No. Handphone</label>
                                    <input type="text" class="form-control" id="no_hp" name="no_hp"
                                        value="{{ auth()->user()->no_hp }}" autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                    <label class="mb-0" for="foto">Ganti Foto</label>
                                    <input type="file" class="form-control" id="foto" name="foto"
                                        accept=".jpg, .jpeg, .png">
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

@push('scripts')
    @if (Session::has('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ Session::get('success') }}'
            })
        </script>
    @endif
    @if (Session::has('failed'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ Session::get('failed') }}'
            })
        </script>
    @endif
@endpush
