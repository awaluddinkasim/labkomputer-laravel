<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF</title>
    <style>
        @page {
            margin: .8cm !important;
            padding: 0px 0px 0px 0px !important;
        }

        table {
            width: 100%;
            border: 0;
        }

        img {
            display: block;
            max-width: 20.2cm;
            max-height: 47%;
            padding-bottom: 10px;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    <table class="table">
        @foreach ($daftarSlip as $slip)
            @php
                $image = public_path('f/slip/' . $slip->dataPraktikan->praktikum->prodi->nama . '/' . str_replace('/', '-', $slip->dataPraktikan->praktikum->nama) . '/' . $slip->slip);
                $imageSize = getimagesize($image);
                if ($imageSize[0] < $imageSize[1]) {
                    $portrait = true;
                }
            @endphp
            <tr>
                <td>{{ $slip->dataPraktikan->praktikan->nim . ' - ' . $slip->dataPraktikan->praktikan->nama }}</td>
                <td style="text-align: right">Rp. {{ number_format($slip->nominal) }} -
                    {{ Carbon\Carbon::parse($slip->tgl_slip)->isoFormat('D MMMM YYYY') }}</td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center">
                    <img src="{{ $image }}" alt="">
                </td>
            </tr>
            <div class="page-break"></div>
        @endforeach
    </table>
</body>

</html>
