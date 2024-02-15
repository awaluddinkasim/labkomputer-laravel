<table>
    <thead>
        <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Nominal</th>
            <th>Tanggal Pembayaran</th>
            <th>Tanggal Upload</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($daftarSlip as $slip)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $slip->dataPraktikan->praktikan->nim }}</td>
                <td>{{ $slip->dataPraktikan->praktikan->nama }}</td>
                <td>{{ $slip->nominal }}</td>
                <td>{{ Carbon\Carbon::parse($slip->tgl_slip)->isoFormat('DD MMMM YYYY') }}</td>
                <td>{{ Carbon\Carbon::parse($slip->created_at)->isoFormat('DD MMMM YYYY') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
