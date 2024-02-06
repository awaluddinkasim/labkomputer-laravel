@extends('layout')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1 class="mr-auto">Slip Pembayaran</h1>
            <button class="btn btn-primary" data-toggle="modal" data-target="#formModal">
                <i class="fas fa-plus"></i>
            </button>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @php
                        $semuaSlipTerupload = false;
                        foreach ($daftarData as $data) {
                            if (!$data->slip) {
                                $semuaSlipTerupload = true;
                            } else {
                                $semuaSlipTerupload = false;
                            }
                        }
                    @endphp
                    @if ($upload == 'closed')
                        <div class="alert alert-info" role="alert">
                            <i class="fas fa-info-circle"></i>
                            <span class="ml-3">Upload slip praktikum sudah tertutup</span>
                        </div>
                    @endif

                    <table id="table" class="table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Praktikum</th>
                                <th>Semester</th>
                                <th>Dosen</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($daftarData->sortBy(['praktikum.semester', 'praktikum.nama']) as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->praktikum->nama }}</td>
                                    <td>{{ $data->praktikum->semester }}</td>
                                    <td data-toggle="tooltip" data-placement="top" title="NIDN: {{ $data->nidn_dosen }}">
                                        {!! $data->pengampu ? $data->pengampu->nama : '-' !!}
                                    </td>
                                    <td>
                                        @if ($data->slip)
                                            <span class="badge badge-pill py-1 badge-success">Terupload</span>
                                        @else
                                            <span class="text-danger">Belum Upload</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($data->slip)
                                            <button class="btn btn-primary btn-sm"
                                                onclick="window.open(
                                            '{{ asset(
                                                'f/slip/' .
                                                    $data->slip->dataPraktikan->praktikum->prodi->nama .
                                                    '/' .
                                                    str_replace('/', '-', $data->praktikum->nama) .
                                                    '/' .
                                                    $data->slip->slip,
                                            ) }}',
                                            '_blank'
                                        )">
                                                <ion-icon name="open"></ion-icon>
                                            </button>
                                        @else
                                            @if ($upload != 'closed')
                                                <button class="btn btn-primary btn-sm" data-toggle="modal"
                                                    data-target="#upload{{ $loop->iteration }}">
                                                    Upload
                                                </button>

                                                @push('modals')
                                                    <div class="modal fade" id="upload{{ $loop->iteration }}" tabindex="-1"
                                                        aria-labelledby="uploadLabel{{ $loop->iteration }}" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="uploadLabel{{ $loop->iteration }}">
                                                                        Upload Slip</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form action="{{ route('slip.store') }}" method="post"
                                                                    enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="modal-body">
                                                                        <input type="hidden" name="id"
                                                                            value="{{ $data->id }}" required>

                                                                        <div class="form-group">
                                                                            <label class="mb-0"
                                                                                for="nominal{{ $loop->iteration }}">Nominal</label>
                                                                            <input type="text" class="form-control"
                                                                                id="nominal{{ $loop->iteration }}"
                                                                                name="nominal" autocomplete="off" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="mb-0"
                                                                                for="tgl{{ $loop->iteration }}">Tanggal
                                                                                Pembayaran</label>
                                                                            <input type="date" class="form-control"
                                                                                id="tgl{{ $loop->iteration }}" name="tgl"
                                                                                autocomplete="off" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="mb-0"
                                                                                for="slip{{ $loop->iteration }}">Bukti
                                                                                Slip</label>
                                                                            <input type="file" class="form-control"
                                                                                id="slip{{ $loop->iteration }}" name="slip"
                                                                                accept=".jpeg, .jpg, .png" required>
                                                                            <small class="form-text text-muted">Ukuran maksimal
                                                                                2 MB</small>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Tutup</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Upload</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endpush
                                            @else
                                                <button class="btn btn-primary btn-sm" disabled>
                                                    Upload
                                                </button>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('modals')
    <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Tambah Praktikum</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('tambah-praktikum') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="praktikum">Praktikum</label>
                            <select class="select" name="praktikum" id="praktikum" onchange="fetchDosen()" required>
                                <option value="" selected>Pilih Praktikum</option>
                                @foreach ($daftarPraktikum as $praktikum)
                                    <option value="{{ $praktikum->id }}">{{ $praktikum->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="dosen">Dosen</label>
                            <select class="custom-select" name="dosen" id="dosen" disabled required>
                                <option value="" selected hidden>Pilih Dosen</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endpush


@push('styles')
    @include('includes.datatables.styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/selectize/selectize.bootstrap4.min.css') }}">
    <style>
        .custom-select {
            font-size: inherit;
        }
    </style>
@endpush

@push('scripts')
    @include('includes.datatables.scripts')
    <script src="{{ asset('assets/plugins/selectize/selectize.min.js') }}"></script>

    <script>
        let prak;

        $(document).ready(function() {
            $('#table').DataTable({
                responsive: true,
                sort: false
            });

            fetchDosen();
        });

        $(".select").selectize();

        function fetchDosen() {
            prak = $('select[name=praktikum] option').filter(':selected').val()

            if (prak) {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('ajax.dosen-praktikum') }}?praktikum=' + prak,
                    success: function(response) {
                        $("#dosen").removeAttr('disabled');
                        $("#dosen").html(response);
                    }
                });
            }
        }

        $('input[name="slip"]').on('change', function() {
            var fileExtension = ['jpeg', 'jpg', 'png'];
            if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                $('input[name="slip"]').val(null)
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Jenis file tidak valid'
                })
            }

            const size = (this.files[0].size / 1024 / 1024).toFixed(2)

            if (size > 2) {
                $('input[name="slip"]').val(null)
                Swal.fire({
                    icon: 'error',
                    title: 'Ukuran terlalu besar!',
                    text: 'Pastikan ukuran gambar tidak lebih dari 2 MB'
                })
            }
        })
    </script>

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
