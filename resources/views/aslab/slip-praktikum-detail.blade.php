@extends('layout')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1 class="mr-auto">{{ $praktikum }}</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <button class="btn btn-primary mb-3" onclick="document.location.href = '{{ route('asisten.slip') }}'">
                        Kembali
                    </button>
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
                                        <a href="{{ route('asisten.mahasiswa-detail', $slip->dataPraktikan->praktikan->id) }}"
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
    </script>
@endpush
