@extends('layout')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Bebas Lab</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body text-center">
                    @if ($bebasLab->status == 'pending')
                        <div class="col-sm-8 col-md-5 mx-auto">
                            <img src="{{ asset('assets/img/bl-pending.svg') }}" alt="" class="w-75">
                            <h4>Berkas kamu dalam tahap proses</h4>
                            <p>Silahkan kembali lagi nanti</p>
                        </div>
                    @elseif ($bebasLab->status == 'selesai')
                        <div class="col-sm-8 col-md-5 mx-auto">
                            <img src="{{ asset('assets/img/bl-done.svg') }}" alt="" class="w-75">
                            <h4>Berkas kamu telah selesai</h4>
                            <p>Silahkan datang ke Laboratorium Komputer untuk mengambil berkas</p>
                        </div>
                    @elseif ($bebasLab->status == 'ditolak')
                        <div class="col-sm-8 col-md-5 mx-auto">
                            <img src="{{ asset('assets/img/bl-ditolak.svg') }}" alt="" class="w-75">
                            <h4>Berkas kamu ditolak</h4>
                            <p>
                                @if ($bebasLab->catatan)
                                    {{ $bebasLab->catatan }}
                                @else
                                    Silahkan mengajukan ulang dan harap perhatikan dengan baik berkas yang diupload
                                @endif
                            </p>
                            <button class="btn btn-primary mb-4"
                                onclick="document.location.href = '{{ route('bebas-lab.upload') }}'">Ajukan ulang</button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
