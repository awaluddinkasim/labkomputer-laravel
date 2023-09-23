@extends('layout')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Slip Pembayaran</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Praktikum</th>
                                <th>Dosen</th>
                                <th>Jumlah Slip</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($daftarData as $data)
                                <tr onclick="document.location.href = '{{ route('admin.slip') }}?id={{ encrypt($data->praktikum->id) }}'">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->praktikum->nama }}</td>
                                    <td data-toggle="tooltip" data-placement="top" title="NIDN: {{ $data->nidn_dosen }}">
                                        {!! $data->pengampu ? $data->pengampu->nama : '-' !!}
                                    </td>
                                    <td>{{ $data->praktikum->slip->count() }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">
                                        <i>Tidak ada data</i>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
    <style>
        tr td {
            cursor: pointer;
        }
    </style>
@endpush
