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
                    <div style="max-height: 47%; margin-top: 50px; padding-bottom: 10px;">
                        <span>
                            <img src="{{ $image }}" alt="" {!! isset($portrait)
                                ? 'style="-webkit-transform:rotate(-90deg); -moz-transform:rotate(-90deg); -o-transform: rotate(-90deg); transform: rotate(90deg); max-height: 20.2cm; max-width: 47%;"'
                                : 'style="max-width: 20.2cm; max-height: 47%;"' !!}>
                        </span>
                    </div>
                </td>
            </tr>
            <div class="page-break"></div>
        @endforeach
    </table>
</body>

</html>
