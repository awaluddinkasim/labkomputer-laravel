@extends('layout')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1 class="mr-auto">Master Praktikum</h1>
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
            <div class="card">
                <div class="card-body">
                    <table id="table" class="table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Praktikum</th>
                                <th>Program Studi</th>
                                <th>Semester</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($daftarPraktikum as $praktikum)
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
                    <h5 class="modal-title" id="formModalLabel">Tambah praktikum</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @if ($daftarFakultas->count() > 0)
                <form action="" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Nama Praktikum</label>
                            <input type="text" class="form-control" id="nama" name="nama" autocomplete="off"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="semester">Semester</label>
                            <select class="custom-select mr-sm-2" id="semester" name="semester" required>
                                <option selected hidden value="">Pilih</option>
                                @for ($i = 1; $i <= 8; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                              </select>
                        </div>
                        <div class="form-group">
                            <label for="prodi">Program Studi</label>
                            <select class="custom-select mr-sm-2" id="prodi" name="prodi" required>
                                <option selected hidden value="">Pilih</option>
                                @foreach ($daftarFakultas as $fakultas)
                                    @if ($fakultas->prodi->count())
                                    <optgroup label="Fakultas {{ $fakultas->nama }}">
                                        @foreach ($fakultas->prodi as $prodi)
                                            <option value="{{ $prodi->id }}">{{ $prodi->nama }}</option>
                                        @endforeach
                                    </optgroup>
                                    @endif
                                @endforeach
                              </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
                @else
                <div class="modal-body py-5 text-center">
                    <p>Harap isi data program studi terlebih dahulu</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
                @endif
            </div>
        </div>
    </div>
@endpush

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
