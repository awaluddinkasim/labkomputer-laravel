<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @include('includes.styles')
    @stack('styles')
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            @auth('admin')
                @include('includes.admin.navbar')
                @include('includes.admin.sidebar')
            @endauth
            @auth('dosen')
                @include('includes.dosen.navbar')
                @include('includes.dosen.sidebar')
            @endauth
            @auth('mahasiswa')
                @include('includes.mahasiswa.navbar')
                @include('includes.mahasiswa.sidebar')
            @endauth

            <!-- Main Content -->
            <div class="main-content">
                @yield('content')
            </div>

            <footer class="main-footer">
                <div class="footer-left">
                    @php
                        if (date('Y') == 2020) {
                            $year = '2020';
                        } else {
                            $year = '2020 - ' . date('Y');
                        }
                    @endphp
                    Copyright &copy; {{ $year }} <div class="bullet"></div> {{ config('app.name') }}
                </div>
            </footer>
        </div>
    </div>

    <div class="modal fade" id="settings" tabindex="-1" aria-labelledby="settingsLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="settingsLabel">Pengaturan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.pengaturan-save') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="card-title">
                            <h6>Pengaturan sistem</h6>
                        </div>
                        <div class="form-group row">
                            <label for="semester" class="col-sm-6 col-form-label align-self-center">Semester</label>
                            <div class="col-sm-6">
                                <select class="custom-select mr-sm-2" id="semester" name="semester" required>
                                    <option selected hidden value="">Pilih</option>
                                    <option value="ganjil" {{ $settings['semester']->value == 'ganjil' ? 'selected' : '' }}>
                                        Ganjil</option>
                                    <option value="genap" {{ $settings['semester']->value == 'genap' ? 'selected' : '' }}>
                                        Genap</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="upload" class="col-sm-6 col-form-label align-self-center">Opsi Upload
                                Slip</label>
                            <div class="col-sm-6">
                                <select class="custom-select mr-sm-2" id="upload" name="upload" required>
                                    <option selected hidden value="">Pilih</option>
                                    <option value="open" {{ $settings['upload']->value == 'open' ? 'selected' : '' }}>
                                        Upload Terbuka</option>
                                    <option value="closed" {{ $settings['upload']->value == 'closed' ? 'selected' : '' }}>
                                        Upload Tertutup</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-title">
                            <h6>Kontak</h6>
                        </div>
                        <div class="form-group">
                            <label for="kepala_lab">Kepala Lab</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">+62</span>
                                </div>
                                <input type="text" class="form-control" id="kepala_lab" name="kepala_lab"
                                    autocomplete="off" value="{{ $settings['kepala_lab']->value }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="asisten1">Asisten Lab 1</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">+62</span>
                                </div>
                                <input type="text" class="form-control" id="asisten1" name="asisten1"
                                    autocomplete="off" value="{{ $settings['asisten1']->value }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="asisten2">Asisten Lab 2</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">+62</span>
                                </div>
                                <input type="text" class="form-control" id="asisten2" name="asisten2"
                                    autocomplete="off" value="{{ $settings['asisten2']->value }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @stack('modals')

    @include('includes.scripts')

    @if (Auth::guard('admin')->check() || Auth::user()->level == 'asisten')
        <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
        <script>
            var pusher = new Pusher('02a61b9baa791a2610a5', {
                cluster: 'ap1'
            });

            var channel = pusher.subscribe('account');
            channel.bind('user-registered', function(data) {
                if ($('#unverified').length > 0) {
                    $('#unverified').text(data.totalUnverified);
                } else {
                    $('.mhs').html('Mahasiswa <span id="unverified" class="badge badge-danger ml-auto">' + data
                        .totalUnverified + '</span>');
                    $('.daftar-mhs').html('Daftar Mahasiswa <span id="unverified" class="badge badge-danger ml-auto">' +
                        data.totalUnverified + '</span>');
                }
            });
        </script>
    @endif
    @stack('scripts')
</body>

</html>
