@extends('layout')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1 class="mr-auto">Master Fakultas</h1>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formModal">
                Tambah
            </button>
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
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block">
                    <img src="{{ asset('assets/img/master-data.svg') }}" class="w-100">
                </div>
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Fakultas</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($daftarFakultas as $fakultas)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $fakultas->nama }}</td>
                                                <td class="text-center">
                                                    <button class="btn btn-info btn-sm" onclick="document.location.href = '{{ route('admin.fakultas-edit') }}?id={{ $fakultas->id }}'">
                                                        <ion-icon name="create"></ion-icon>
                                                    </button>
                                                    <button class="btn btn-danger btn-sm" onclick="deleteData({{ $fakultas->id }})">
                                                        <ion-icon name="trash"></ion-icon>
                                                    </button>
                                                    <form action="{{ route('admin.fakultas-delete') }}" class="d-inline" method="POST" id="formDelete{{ $fakultas->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="id" value="{{ $fakultas->id }}">
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center">
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
            </div>
        </div>
    </section>
@endsection

@push('modals')
    <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Tambah fakultas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="fakultas">Nama Fakultas</label>
                            <input type="text" class="form-control" id="fakultas" name="fakultas" autocomplete="off"
                                required>
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

@push('scripts')
    <script>
        function deleteData(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Semua data yang terkait dengan fakultas ini akan terhapus.",
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
