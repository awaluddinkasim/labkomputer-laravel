@extends('layout')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Ganti Password</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="d-flex justify-content-center align-items-center col-md-6">
                            <form action="{{ route('password.update') }}" method="post" style="width: 350px; max-width: 100%">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <label class="mb-0" for="old_password">Password Lama</label>
                                    <input type="password" class="form-control" id="old_password" name="old_password"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label class="mb-0" for="new_password">Password Baru</label>
                                    <input type="password" class="form-control" id="new_password" name="new_password"
                                        required>
                                </div>
                                <button class="btn btn-primary btn-block">Submit</button>
                            </form>
                        </div>
                        <div class="d-none d-md-block col-md-6 text-center">
                            <img src="{{ asset('assets/img/password.svg') }}" alt="" class="w-75">
                        </div>
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
                title: 'Gagal!',
                text: '{{ Session::get('failed') }}'
            })
        </script>
    @endif
@endpush
