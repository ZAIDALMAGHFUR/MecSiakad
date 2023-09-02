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
    <table style="border-bottom:3px solid;width:100%; border-bottom-style: double; color: #000000">
        <tr>
            <td style="width: 10%">
                <img src="{{ public_path() . '/assets/images/6.png' }}" alt="makan" width="80">
                {{-- <img src="{{ asset('assets/images/6.png') }}" alt="makan" width="90"> --}}
            </td>
            <td style="width: 90%; text-align: center">
                <div style="font-weight: bold;font-size=20px">KARTU RENCANA STUDI (KRS)</div>
                <div style="font-weight: bold;font-size=20px">AKADEMI TEKNIK INDONESIA CUT MEUTIA</div>
                <div style="font-weight: bold;font-size=20px">TAHUN AKADEMIK {{ $data->tahun_academic->tahun_akademik }}
                </div>
            </td>
        </tr>
        <tr style="width: 100%">
            <td colspan="2" style="font-size: 12px;font-weight: lighter; text-align: center">
                Kampus Utama : Jl. Medan - Binjai KM 16,5, Sei Semayang, Sunggal, Deli Serdang Web :
                <u>aticutmeutia.ac.id<u>
            </td>
        </tr>

        <tr style="width: 100%">
            <td colspan="2" style="font-size: 12px;font-weight: lighter; text-align: center">
                Kampus II : Jl. AH. Nasution No. 18, Pangkalan Masyhur, Medan Johor, Medan E-mail  :
                <u>aticutmeutia89@gmail.com<u>
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
            <td rowspan="2" style="width: 3%">PARAP</td>
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
                <td align="center">
                    @foreach ($dsnmatkul as $dosen)
                        @if ($dosen->mata_kuliah_id == $krs_data->id)
                            {{ $dosen->dosen->kode_dosen }}
                        @endif
                    @endforeach
                </td>
                <td align="center">
                    @foreach ($dsnmatkul as $dosen)
                        @if ($dosen->mata_kuliah_id == $krs_data->id)
                            {{ $dosen->dosen->nama_dosen }}
                        @endif
                    @endforeach
                </td>
                <td align="center"></td>
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
            <td>
                <div>Menyetujui,</div>
                <div>Penasehat Akademik</div>
                <div style="height: 80px"></div>
                <div style="font-weight: bold;">
                    </div>
            </td>
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
