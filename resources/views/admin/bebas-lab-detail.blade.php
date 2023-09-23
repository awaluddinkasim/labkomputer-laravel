@extends('layout')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1 class="mr-auto">Detail Bebas Lab</h1>
            <div class="d-none d-lg-block">
                <form action="{{ route('admin.bebas-lab.update', $bebasLab->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <button class="btn btn-outline-danger" name="status" value="ditolak">Tolak</button>
                    <button class="btn btn-success" name="status" value="selesai">Selesai</button>
                </form>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <h5>Data Mahasiswa</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-2">
                                <label class="mb-0" for="nim">Nomor Induk Mahasiswa</label>
                                <input type="text" class="form-control-plaintext" id="nim"
                                    value="{{ $bebasLab->mahasiswa->nim }}" disabled>
                            </div>
                            <div class="form-group mb-2">
                                <label class="mb-0" for="nama">Nama</label>
                                <input type="text" class="form-control-plaintext" id="nama"
                                    value="{{ $bebasLab->mahasiswa->nama }}" disabled>
                            </div>
                            <div class="form-group mb-2">
                                <label class="mb-0" for="no_hp">No. Handphone</label>
                                <input type="text" class="form-control-plaintext" id="no_hp"
                                    value="{{ $bebasLab->mahasiswa->no_hp }}" disabled>
                            </div>
                            <div class="form-group mb-2">
                                <label class="mb-0" for="fakultas">Fakultas</label>
                                <input type="text" class="form-control-plaintext" id="fakultas"
                                    value="{{ $bebasLab->mahasiswa->prodi->fakultas->nama }}" disabled>
                            </div>
                            <div class="form-group mb-2">
                                <label class="mb-0" for="prodi">Program Studi</label>
                                <input type="text" class="form-control-plaintext" id="prodi"
                                    value="{{ $bebasLab->mahasiswa->prodi->nama }}" disabled>
                            </div>
                            <div class="form-group mb-2">
                                <label class="mb-0" for="tanggal">Tanggal Pengajuan</label>
                                <input type="text" class="form-control-plaintext" id="tanggal"
                                    value="{{ Carbon\Carbon::parse($bebasLab->created_at)->isoFormat('D MMMM YYYY') }}"
                                    disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header">
                            <h5>Lampiran Berkas</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="col-1">#</th>
                                            <th scope="col">File</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row" class="col-1">1</th>
                                            <td>Bukti Pembayaran</td>
                                            <td class="text-center">
                                                <a href="{{ asset('f/bebaslab/' . $bebasLab->mahasiswa->nim . '/' . $bebasLab->bukti_bayar) }}"
                                                    class="btn btn-primary" target="_blank">
                                                    Buka
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="col-1">2</th>
                                            <td>Berkas Praktikum</td>
                                            <td class="text-center">
                                                <a href="{{ asset('f/bebaslab/' . $bebasLab->mahasiswa->nim . '/' . $bebasLab->berkas) }}"
                                                    class="btn btn-primary" target="_blank">
                                                    Buka
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
