<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Akun</title>
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <style>
        body {
            min-height: 100vh;
        }

        .logo {
            height: 150px;
        }
    </style>
</head>

<body class="bg-primary d-flex justify-content-center align-items-center">

    @if (Session::has('failed'))
        <div class="position-fixed p-3" style="z-index: 5; right: 0; bottom: 0;">
            <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true"
                data-autohide="false">
                <div class="toast-header">
                    <strong class="mr-auto">Gagal login</strong>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="toast-body px-5 py-3">
                    {{ Session::get('failed') }}
                </div>
            </div>
        </div>
    @endif

    <div class="card my-5" style="width: 400px">
        <div class="card-body px-5 py-5 py-md-4">

            <div class="text-center my-3">
                <img src="{{ asset('assets/img/logo.png') }}" alt="" class="logo">
            </div>
            <form action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="mb-0" for="nim">Nomor Induk Mahasiswa</label>
                    <input type="text" class="form-control" id="nim" name="nim" autocomplete="off"
                        maxlength="11" autofocus required>
                </div>
                <div class="form-group">
                    <label class="mb-0" for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" autocomplete="off"
                        autocapitalize="word" required>
                </div>
                <div class="form-group">
                    <label class="mb-0" for="prodi">Program Studi</label>
                    <select class="custom-select mr-sm-2" id="prodi" name="prodi" required>
                        <option selected hidden value="">Pilih</option>
                        @foreach ($daftarFakultas as $fakultas)
                            @if ($fakultas->prodi->count())
                                <optgroup label="Fakultas {{ $fakultas->nama }}">
                                    @foreach ($fakultas->prodi as $prodi)
                                        <option value="{{ $prodi->id }}">
                                            {{ $prodi->nama }}</option>
                                    @endforeach
                                </optgroup>
                            @endif
                        @endforeach
                    </select>
                </div>
                <label for="no_hp">No. Handphone</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="hp">+62</span>
                    </div>
                    <input type="text" class="form-control" id="no_hp" name="no_hp" aria-describedby="hp">
                </div>

                <div class="form-group">
                    <label class="mb-0" for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" minlength="6" required>
                </div>
                <div class="form-group">
                    <label class="mb-0" for="foto">Foto</label>
                    <input type="file" class="form-control" id="foto" name="foto" accept=".jpg, .jpeg, .png"
                        required>
                    <small class="form-text text-muted">Ukuran maksimal 2 MB</small>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Daftar</button>
            </form>

            <div class="small text-muted text-center mt-3 d-md-block d-none">
                @php
                    if (date('Y') == 2020) {
                        $year = '2020';
                    } else {
                        $year = '2020 - ' . date('Y');
                    }
                @endphp
                {{ config('app.name') }} | Copyright &copy; {{ $year }}
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/plugins/jquery/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script>
        $('#foto').on('change', function() {
            var fileExtension = ['jpeg', 'jpg', 'png'];
            if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                $('#foto').val(null)
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Jenis file tidak valid'
                })
                return
            }

            const size = (this.files[0].size / 1024 / 1024).toFixed(2)

            if (size > 2) {
                $('#foto').val(null)
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Ukuran gambar terlalu besar'
                })
            }
        })
    </script>
    @if (Session::has('failed'))
        <script>
            $(document).ready(function() {
                $('#liveToast').toast('show');
            });
        </script>
    @endif
</body>

</html>
