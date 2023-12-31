@extends('layout')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1 class="mr-auto">Bebas Lab</h1>
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
                    <table id="table" class="table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIM</th>
                                <th>Nama Mahasiswa</th>
                                <th>Tanggal Pengajuan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($daftarPengajuan as $bebasLab)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $bebasLab->mahasiswa->nim }}</td>
                                    <td>{{ $bebasLab->mahasiswa->nama }}</td>
                                    <td>{{ Carbon\Carbon::parse($bebasLab->created_at)->isoFormat('D MMMM YYYY') }}</td>
                                    <td>
                                        <span class="{{ $bebasLab->status == 'selesai' ? 'text-success' : 'text-danger' }}">
                                            {{ Str::ucfirst($bebasLab->status) }}
                                        </span>
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
