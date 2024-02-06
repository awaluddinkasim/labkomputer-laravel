@extends('layout')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1 class="mr-auto">Praktikum</h1>
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
                    <div class="table-responsive">
                        <table id="table" class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Praktikum</th>
                                    <th>Jumlah Mahasiswa</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (auth()->user()->dataPraktikum as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->praktikum->nama }}</td>
                                        <td>{{ $data->praktikum->praktikan->count() }}</td>
                                        <td class="text-center col-3">
                                            <button class="btn btn-primary btn-sm"
                                                onclick="document.location.href = '{{ route('dosen.praktikum.mahasiswa', encrypt($data->praktikum->id)) }}'">
                                                Mahasiswa
                                            </button>
                                            <button class="btn btn-primary btn-sm"
                                                onclick="document.location.href = '{{ route('dosen.praktikum.slip', encrypt($data->praktikum->id)) }}'">
                                                Slip Praktikum
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
                sort: false
            });
        });
    </script>
@endpush
