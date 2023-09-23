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
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($daftarPraktikum as $praktikum)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $praktikum->nama }}</td>
                                <td>{{ $praktikum->prodi->nama }}</td>
                                <td>{{ $praktikum->semester }}</td>
                                <td class="text-center">
                                    <button class="btn btn-info btn-sm" onclick="document.location.href = '{{ route('admin.praktikum-edit') }}?id={{ $praktikum->id }}'">
                                        <ion-icon name="create"></ion-icon>
                                    </button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteData({{ $praktikum->id }})">
                                        <ion-icon name="trash"></ion-icon>
                                    </button>
                                    <form action="{{ route('admin.praktikum-delete') }}" class="d-inline" method="POST" id="formDelete{{ $praktikum->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{ $praktikum->id }}">
                                    </form>
                                </td>
                            </tr>
                            @endforeach --}}
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
                text: "Data slip pembayaran yang terdaftar pada praktikum ini akan ikut terhapus.",
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
