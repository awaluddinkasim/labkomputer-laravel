@extends('layout')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1 class="mr-auto">Edit Profil</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-lg-7 d-none d-lg-flex align-self-center">
                    <img src="{{ asset('assets/img/edit-akun.svg') }}" alt="" class="w-75 mx-auto">
                </div>
                <div class="col-lg-5">
                    <div class="card">
                        <form action="" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="text-center mb-4">
                                    <img src="{{ asset('f/avatar/' . auth()->user()->foto) }}" alt="" class="pict-oval">
                                </div>
                                <div class="form-group">
                                    <label class="mb-0" for="email">Email</label>
                                    <input type="text" class="form-control" id="email" name="email"
                                        value="{{ auth()->user()->email }}" autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                    <label class="mb-0" for="nama">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        value="{{ auth()->user()->nama }}" autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                    <label class="mb-0" for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        value="">
                                    <small id="passHelp" class="form-text text-muted">Kosongkan jika tidak ingin mengganti password</small>
                                </div>
                            </div>
                            <div class="card-footer text-right pb-4">
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    @if (Session::has('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ Session::get('success') }}'
        })
    </script>
    @endif
    @if (Session::has('failed'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Berhasil!',
            text: '{{ Session::get('failed') }}'
        })
    </script>
    @endif
@endpush
