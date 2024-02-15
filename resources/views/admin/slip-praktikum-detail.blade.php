@extends('layout')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1 class="mr-auto">{{ $praktikum }}</h1>
        </div>

        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (Session::has('failed'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ Session::get('failed') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <button class="btn btn-primary"
                            onclick="document.location.href = '{{ route('admin.slip') }}'">Kembali</button>
                        <div class="d-none d-md-block">
                            <div class="btn btn-success"
                                onclick="document.location.href = '{{ route('admin.slip-export') }}?type=excel&id={{ Request::get('id') }}'">
                                <i class="fas fa-file-excel"></i>
                            </div>
                            <div class="btn btn-danger"
                                onclick="window.open('{{ route('admin.slip-export') }}?type=pdf&id={{ Request::get('id') }}', '_blank')">
                                <i class="fas fa-file-pdf"></i>
                            </div>
                        </div>
                    </div>
                    <table id="table" class="table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Nominal</th>
                                <th>Tanggal Pembayaran</th>
                                <th>Tanggal Upload</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($daftarSlip as $slip)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $slip->dataPraktikan->praktikan->nim }}</td>
                                    <td>
                                        <a href="{{ route('admin.mhs-detail', $slip->dataPraktikan->praktikan->id) }}"
                                            class="text-decoration-none" target="_blank">
                                            {{ $slip->dataPraktikan->praktikan->nama }}
                                        </a>
                                    </td>
                                    <td>Rp. {{ number_format($slip->nominal) }}</td>
                                    <td>{{ Carbon\Carbon::parse($slip->tgl_slip)->isoFormat('D MMMM YYYY') }}</td>
                                    <td>{{ Carbon\Carbon::parse($slip->created_at)->isoFormat('D MMMM YYYY') }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-primary btn-sm"
                                            onclick="window.open(
                                            '{{ asset(
                                                'f/slip/' .
                                                    $slip->dataPraktikan->praktikum->prodi->nama .
                                                    '/' .
                                                    str_replace('/', '-', $praktikum) .
                                                    '/' .
                                                    $slip->slip,
                                            ) }}',
                                            '_blank'
                                        )">
                                            <ion-icon name="open"></ion-icon>
                                        </button>
                                        <form action="{{ route('admin.slip-delete') }}" method="post" class="d-inline"
                                            id="formDelete{{ $slip->id }}">
                                            @method('DELETE')
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $slip->id }}" required>
                                        </form>

                                        <button class="btn btn-danger btn-sm" onclick="deleteData({{ $slip->id }})">
                                            <ion-icon name="trash"></ion-icon>
                                        </button>
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

@push('styles')
    @include('includes.datatables.styles')
@endpush

@push('scripts')
    @include('includes.datatables.scripts')
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                responsive: true,
                sort: false
            });
        });

        function deleteData(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Slip pembayaran yang terhapus tak dapat dikembalikan.",
                icon: 'warning',
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    $(`#formDelete${id}`).submit();
                }
            });
        }
    </script>
@endpush
