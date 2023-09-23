@extends('layout')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1 class="mr-auto">{{ $mahasiswa->nama }}</h1>
            @if (!$mahasiswa->active)
                <div class="d-none d-lg-block">
                    <button class="btn btn-outline-danger" onclick="action('tolak')">Tolak</button>
                    <button class="btn btn-success" onclick="action('verifikasi')">Verifikasi</button>
                </div>
            @else
                <button class="btn btn-info" onclick="document.location.href = '{{ route('admin.mhs-edit', $mahasiswa->id) }}'">
                    <i class="fas fa-edit"></i>
                </button>
            @endif
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mr-auto">Data Mahasiswa</h5>
                            <span
                                class="badge badge-{{ $mahasiswa->active ? 'success' : 'danger' }}">{{ $mahasiswa->active ? 'Aktif' : 'Pending' }}</span>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <img src="{{ asset('f/avatar/' . $mahasiswa->foto) }}" alt="" class="pict-oval">
                            </div>
                            <div class="form-group mb-2">
                                <label class="mb-0" for="nim">Nomor Induk Mahasiswa</label>
                                <input type="text" class="form-control-plaintext" id="nim"
                                    value="{{ $mahasiswa->nim }}" disabled>
                            </div>
                            <div class="form-group mb-2">
                                <label class="mb-0" for="nama">Nama</label>
                                <input type="text" class="form-control-plaintext" id="nama"
                                    value="{{ $mahasiswa->nama }}" disabled>
                            </div>
                            <div class="form-group mb-2">
                                <label class="mb-0" for="no_hp">No. Handphone</label>
                                <input type="text" class="form-control-plaintext" id="no_hp"
                                    value="{{ $mahasiswa->no_hp }}" disabled>
                            </div>
                            <div class="form-group mb-2">
                                <label class="mb-0" for="fakultas">Fakultas</label>
                                <input type="text" class="form-control-plaintext" id="fakultas"
                                    value="{{ $mahasiswa->prodi->fakultas->nama }}" disabled>
                            </div>
                            <div class="form-group mb-2">
                                <label class="mb-0" for="prodi">Program Studi</label>
                                <input type="text" class="form-control-plaintext" id="prodi"
                                    value="{{ $mahasiswa->prodi->nama }}" disabled>
                            </div>
                        </div>
                        @if (!$mahasiswa->active)
                            <div class="card-footer text-right d-lg-none">
                                <button class="btn btn-outline-danger">Tolak</button>
                                <button class="btn btn-success">Verifikasi</button>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-7 d-none d-lg-flex align-self-center">
                    <img src="{{ asset('assets/img/profil.svg') }}" alt="" class="w-75 mx-auto">
                </div>
            </div>
        </div>
    </section>

    <form action="{{ route('admin.mhs-action', 'verifikasi') }}" method="POST" id="formVerifikasi">
        @csrf
        <input type="hidden" name="id" value="{{ $mahasiswa->id }}">
    </form>
    <form action="{{ route('admin.mhs-action', 'tolak') }}" method="POST" id="formTolak">
        @csrf
        <input type="hidden" name="id" value="{{ $mahasiswa->id }}">
    </form>
@endsection

@push('scripts')
    <script>
        function action(jenis) {
            switch (jenis) {
                case "verifikasi":
                    $('#formVerifikasi').submit();
                    break;

                case "tolak":
                    $('#formTolak').submit();
                    break;

                default:
                    break;
            }
        }
    </script>
@endpush
