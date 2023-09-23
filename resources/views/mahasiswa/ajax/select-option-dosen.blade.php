<option value="" selected hidden>Pilih Dosen</option>
@foreach ($daftarPengampu as $pengampu)
    <option value="{{ $pengampu->dosen->nidn }}">{{ $pengampu->dosen->nama }}</option>
@endforeach
