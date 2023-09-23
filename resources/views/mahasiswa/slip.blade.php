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
                    <div class="alert alert-info d-flex align-items-center" role="alert">
                        <i class="fas fa-info-circle"></i>
                        <span class="ml-3">Silahkan upload slip pembayaran melalui aplikasi Android</span>
                    </div>

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
                                            <button class="btn btn-secondary btn-sm" disabled>
                                                <ion-icon name="open"></ion-icon>
                                            </button>
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
    </script>
@endpush
