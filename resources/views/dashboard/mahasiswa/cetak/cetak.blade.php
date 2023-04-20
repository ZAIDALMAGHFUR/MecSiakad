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
            {{-- <td style="width: 10%">
                <img src="{{ Storage::url($data->mhs->foto) }}" alt="foto mahasiswa" width="80">
            </td> --}}
            <td style="width: 90%; text-align: center">
                <div style="font-weight: bold;font-size=20px">KARTU RENCANA STUDI (KRS)</div>
                <div style="font-weight: bold;font-size=20px">SEKOLAH TINGGI ILMU TARBIYAH (STIT) AL-HIKMAH TEBING
                    TINGGI</div>
                <div style="font-weight: bold;font-size=20px">TAHUN AKADEMIK {{ $data->tahun_academic->tahun_akademik }}
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
                        <td>{{ $data->mhs->name }}</td>
                    </tr>
                    <tr>
                        <td>NIM</td>
                        <td>:</td>
                        <td>{{ $data->mhs->nim }}</td>
                    </tr>
                </table>
            </td>
            <td style="width: 50%;">
                <table>
                    {{-- <tr>
                        <td>SEMESTER</td>
                        <td>:</td>
                        <td>4</td>
                    </tr> --}}
                    <tr>
                        <td>PROGRAM STUDI</td>
                        <td>:</td>
                        <td>{{ $data->mhs->program_studies->name }}</td>
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
        @foreach ($select_krs as $krs_data)
            <tr>
                <td align="center">{{ $loop->iteration }}</td>
                <td>{{ $krs_data->name_mata_kuliah }}</td>
                <td align="center">{{ $krs_data->sks }}</td>
                <td align="center">{{ $krs_data->kode_mata_kuliah }}</td>
                <td align="center">{{ $dsnmatkul[$loop->iteration - 1]->dosen->kode_dosen }}</td>
                <td>{{ $dsnmatkul[$loop->iteration - 1]->dosen->nama_dosen }}</td>
                <td align="center">-</td>
            </tr>
        @endforeach
        <tr>
            <td></td>
            <td>Jumlah SKS</td>
            <td align="center">{{ $data->total_sks }}</td>
            <td colspan="4"></td>
        </tr>
    </table>

    {{-- Tanda Tangan --}}
    <table style="width: 100%; margin-top: 3%">
        <tr>
            <td>
                <div>Mengetahui,</div>
                <div>Ketua Prodi {{ $data->mhs->program_studies->name }} </div>
                <div style="height: 80px"></div>
                <div style="font-weight: bold;">{{ $ketua_prodi_id->dosen->nama_dosen }}</div>
            </td>
            {{-- <td>
                <div>Menyetujui,</div>
                <div>Penasehat Akademik</div>
                <div style="height: 80px"></div>
                <div style="font-weight: bold;">
                    Puan MPDI</div>
            </td> --}}
            <td>
                <div>Tebing Tinggi, ......................</div>
                <div>Mahasiswa</div>
                <div style="height: 80px"></div>
                <div style="font-weight: bold;">{{ $data->mhs->name }}</div>
            </td>
        </tr>
    </table>

</body>

</html>