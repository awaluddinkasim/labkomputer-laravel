@extends('layout')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1 class="mr-auto">{{ $praktikum->nama }}</h1>
            <div class="d-none d-md-block">
                <div class="btn btn-success"
                    onclick="document.location.href = '{{ Request::url() }}/export?type=excel&id={{ encrypt($praktikum->id) }}', '_blank'">
                    <i class="fas fa-file-excel"></i>
                </div>
                <div class="btn btn-danger"
                    onclick="window.open('{{ Request::url() }}/export?type=pdf&id={{ encrypt($praktikum->id) }}', '_blank')">
                    <i class="fas fa-file-pdf"></i>
                </div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <button class="btn btn-primary mb-3"
                        onclick="document.location.href = '{{ route('dosen.praktikum') }}'">
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
                                        <a href="{{ route('dosen.praktikum.mahasiswa', encrypt($slip->dataPraktikan->praktikum->id)) }}?id={{ encrypt($slip->dataPraktikan->praktikan->id) }}"
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
                                    '{{ asset('f/slip/' . $praktikum->prodi->nama . '/' . str_replace('/', '-', $praktikum->nama) . '/' . $slip->slip) }}',
                                    '_blank'
                                )">
                                            <ion-icon name="open"></ion-icon> Lihat
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
