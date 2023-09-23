@extends('layout')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Daftar Informasi</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-lg-7">
                    @forelse ($daftarInformasi as $informasi)
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $informasi->judul }}</h5>
                                <h6 class="card-subtitle font-weight-light mb-2 text-muted">{{ $informasi->tanggal }}</h6>
                                <p class="card-text" style="white-space: pre-wrap" id="informasi{{ $informasi->id }}">{{ $informasi->konten }}</p>
                                @if (Str::length($informasi->konten) > 201)
                                    <span class="text-primary toggle" id="toggle{{ $loop->iteration - 1 }}" onclick="toggleRead('#informasi{{ $informasi->id }}', {{ $loop->iteration - 1 }})">Lihat selengkapnya</span>
                                @endif
                                <div class="clearfix float-right">
                                    <button class="btn btn-info btn-sm" onclick="document.location.href = '{{ Request::url() }}?id={{ $informasi->id }}'">
                                        <ion-icon name="create"></ion-icon>
                                    </button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteData({{ $informasi->id }})">
                                        <ion-icon name="trash"></ion-icon>
                                    </button>
                                    <form action="{{ route('admin.informasi-delete') }}" class="d-inline"
                                        method="POST" id="formDelete{{ $informasi->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{ $informasi->id }}">
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="card">
                            <div class="card-body text-center py-5">
                                <div class="my-5">
                                    <div class="h5">Belum ada informasi apapun</div>
                                    <span class="text-muted">Silahkan kembali lagi nanti</span>
                                </div>
                            </div>
                        </div>
                    @endforelse
                    @if ($daftarInformasi->count() > 3)
                        <div class="card">
                            <div class="card-body text-center">
                                {{ $daftarInformasi->links() }}
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-lg-5 d-none d-lg-flex align-items-start py-5">
                    <img src="{{ asset('assets/img/informasi.svg') }}" alt="" class="w-75 mx-auto">
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .toggle {
            cursor: pointer;
        }
    </style>
@endpush

@push('scripts')
    <script>
        let fullInformasi = $('.card-text').map((_, e) => e.innerHTML)

        $(window).on('load', function() {
            let text = $('.card-text').map((_, e) => e)
            text.each((index, e) => {
                console.log(index)
                let informasi = e.innerHTML
                if (informasi.length > 201) {
                    text[index].innerHTML = informasi.substr(0, 200) + '&hellip;'
                }
            });

        });

        function toggleRead(id, index) {
            let informasi = $(id)[0].innerHTML
            if (informasi.length > 201) {
                $(id)[0].innerHTML = informasi.substr(0, 200) + '&hellip;'
                $('#toggle' + index)[0].innerHTML = "Lihat selengkapnya"
            } else {
                $(id)[0].innerHTML = fullInformasi[index]
                $('#toggle' + index)[0].innerHTML = "Sembunyikan"
            }
        }

        function deleteData(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Informasi ini akan terhapus dari database.",
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
