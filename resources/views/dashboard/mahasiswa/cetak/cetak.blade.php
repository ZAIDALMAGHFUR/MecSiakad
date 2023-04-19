<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        html,
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12px;
        }
    </style>
</head>

<body>
    {{-- Header --}}
    <table style="width: 100%">
        <tr>
            <td style="width: 10%">
                <img src="{{ asset('\img\logo.png') }}" alt="" width="80">
            </td>
            <td style="width: 90%; text-align: center">
                <div style="font-weight: bold;font-size=20px">KARTU RENCANA STUDI (KRS)</div>
                <div style="font-weight: bold;font-size=20px">SEKOLAH TINGGI ILMU TARBIYAH (STIT) AL-HIKMAH TEBING
                    TINGGI</div>
                <div style="font-weight: bold;font-size=20px">TAHUN AKADEMIK 2020/2021
                </div>
            </td>
        </tr>
    </table>

    {{-- Info --}}
    <table style="width: 100%; margin-top: 3%">
        <tr>
            <td style="width: 50%">
                <table>
                    <tr>
                        <td>NAMA</td>
                        <td>:</td>
                        <td>Saipul</td>
                    </tr>
                    <tr>
                        <td>NPM</td>
                        <td>:</td>
                        <td>89767575</td>
                    </tr>
                </table>
            </td>
            <td style="width: 50%;">
                <table>
                    <tr>
                        <td>SEMESTER</td>
                        <td>:</td>
                        <td>4</td>
                    </tr>
                    <tr>
                        <td>PROGRAM STUDI</td>
                        <td>:</td>
                        <td>Tekik Informatik</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    {{-- Info --}}
    <table style="width: 100%; margin-top: 3%" border="1" cellspacing="0" cellpadding="7">
        {{-- Thead --}}
        <tr style="text-align: center">
            <td rowspan="2" style="width: 2%">No</td>
            <td rowspan="2" style="width: 15%">Mata Kuliah</td>
            <td rowspan="2" style="width: 2%">SKS</td>
            <td colspan="2">Kode</td>
            <td rowspan="2" style="width: 10%">Nama Dosen</td>
            <td rowspan="2" style="width: 3%">KET</td>
        </tr>
        <tr style="text-align: center">
            <td style="width: 5%">MK</td>
            <td style="width: 5%">Dosen</td>
        </tr>
        {{-- Body --}}
        {{-- @foreach ($krs as $krs_data)
            <tr>
                <td align="center">{{ $loop->iteration }}</td>
                <td>{{ $krs_data->nama_mk }}</td>
                <td align="center">{{ $krs_data->jumlah_sks }}</td>
                <td align="center">{{ $krs_data->kode_mk }}</td>
                <td align="center">{{ $krs_data->kode_dosen }}</td>
                <td>{{ $krs_data->nama_dosen }}</td>
                <td align="center">-</td>
            </tr>
        @endforeach --}}
        <tr>
            <td></td>
            <td>Jumlah SKS</td>
            <td align="center">22</td>
            <td colspan="4"></td>
        </tr>
    </table>

    {{-- Tanda Tangan --}}
    <table style="width: 100%; margin-top: 3%">
        <tr>
            <td>
                <div>Mengetahui,</div>
                <div>Ketua Prodi Teknik Informatika </div>
                <div style="height: 80px"></div>
                <div style="font-weight: bold;">Mega MPDI</div>
            </td>
            <td>
                <div>Menyetujui,</div>
                <div>Penasehat Akademik</div>
                <div style="height: 80px"></div>
                <div style="font-weight: bold;">
                    Puan MPDI</div>
            </td>
            <td>
                <div>Tebing Tinggi, ......................</div>
                <div>Mahasiswa</div>
                <div style="height: 80px"></div>
                <div style="font-weight: bold;">Saipul</div>
            </td>
        </tr>
    </table>

</body>

</html>