@extends('layout')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Riwayat Slip {{ $prodi->nama }}</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <table id="table" class="table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIM</th>
                                <th>Nama Lengkap</th>
                                <th>Jumlah Slip</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($prodi->mahasiswa->where('active', '1') as $user)
                                <tr onclick="document.location.href = '{{ route('admin.riwayat-slip-detail', $user->id) }}'">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->nim }}</td>
                                    <td>{{ $user->nama }}</td>
                                    <td>{{ $user->riwayatSlip->count() }}</td>
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
    <style>
        tr td:hover {
            cursor: pointer;
        }
    </style>
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
