@extends('layout')

@push('styles')
    <style>
        tr td:hover {
            cursor: pointer;
        }

        .empty {
            margin: 150px auto;
            padding: 0px 50px;
        }
    </style>
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Riwayat Slip</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-lg-5 d-none d-lg-flex justify-content-center align-items-center">
                    <img src="{{ asset('assets/img/archive.svg') }}" alt="" class="w-100">
                </div>
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-body">
                            @forelse ($daftarJurusan as $fakultas)
                                <h5>Fakultas {{ $fakultas->nama }}</h5>
                                <div class="list-group mb-3">
                                    @foreach ($fakultas->prodi as $prodi)
                                        <button type="button" class="list-group-item list-group-item-action" onclick="document.location.href = '{{ route('admin.riwayat-slip') }}?prodi={{ $prodi->id }}'">
                                            {{ $prodi->nama }}
                                        </button>
                                    @endforeach
                                </div>
                            @empty
                                <div class="empty text-center">
                                    <h4>Data Kosong</h4>
                                    <p>Data fakultas atau program studi tidak ditemukan</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
