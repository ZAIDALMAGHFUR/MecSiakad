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
        }
    </style>
</head>

<body>
    {{-- Header --}}

    <table style="border-bottom:3px solid;width:100%; border-bottom-style: double; color: #000000">
        <tr style="width: 100%">
            <td style="width: 1%">
                {{-- <img src="{{ asset('assets/images/6.png') }}" alt="makan" width="90"> --}}
                <img src="{{ public_path() . '/assets/images/6.png' }}" alt="makan" width="80">
            </td>
            <td style="width: 90%; text-align: center">
                <div style="font-weight: bold;">AKADEMI TEKNIK INDONESIA CUT MEUTIA</div>
                <div style="font-weight: bold"> (ATI - CM)</div>
            </td>
        </tr>
    <tr style="width: 100%">
        <td colspan="2" style="font-size: 12px;font-weight: lighter; text-align: center">
            Kampus Utama : Jl. Medan - Binjai KM 16,5, Sei Semayang, Sunggal, Deli Serdang  Web :
            <u>aticutmeutia.ac.id<u>
        </td>
    </tr>

    <tr style="width: 100%">
        <td colspan="2" style="font-size: 12px;font-weight: lighter; text-align: center">
            Kampus II : Jl. AH. Nasution No. 18, Pangkalan Masyhur, Medan Johor, Medan E-mail :
            <u>aticutmeutia89@gmail.com<u>
        </td>
    </tr>

    </table>


    {{-- Info --}}
    <table style="width: 100%; margin-top: 3%; font-size: 12px">
        <tr>
            <td style="width: 50%">
                <table>
                    <tr>
                        <td>Nama</td>
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
                    <tr>
                        <td>Tahun Akademik</td>
                        <td>:</td>
                        <td>{{ $data->tahun_academic->tahun_akademik }} - {{ $data->tahun_academic->semester }}</td>
                    </tr>
                    <tr>
                        <td>Program Studi</td>
                        <td>:</td>
                        <td>{{ $data->mhs->program_studies->name }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    {{-- Info --}}
    <table style="width: 100%; margin-top: 3%; font-size: 12px;" border="1" cellspacing="0" cellpadding="7">
        {{-- Thead --}}
        <tr style="text-align: center">
            <td>No</td>
            <td>Mata Kuliah</td>
            <td>SKS</td>
            <td>NH</td>
            <td>NB</td>
            <td>SKS X NB</td>
        </tr>

        <tr style="text-align: center">
            <td>(1)</td>
            <td>(2)</td>
            <td>(3)</td>
            <td>(4)</td>
            <td>(5)</td>
            <td>(6)</td>
        </tr>

        {{-- Body --}}
        @foreach ($select_krs as $khs)
            <tr>
                <td style="text-align: center">{{ $loop->iteration }}</td>
                <td>{{ $khs->name_mata_kuliah}}</td>
                <td style="text-align: center">{{ $khs->sks }}</td>
                <td style="text-align: center">{{ $nilai_akhirs[$loop->iteration - 1]->nilai_akhir }}</td>
                <td style="text-align: center">{{ $nilai_akhirs[$loop->iteration - 1]->bobot }}</td>
                <td style="text-align: center">{{ $khs->sks * $nilai_akhirs[$loop->iteration - 1]->bobot}}</td>
            </tr>
        @endforeach
        <tr>
            <td></td>
            <td style="text-align: center">Jumlah SKS</td>
            <td style="text-align: center">{{ $total_sks }}</td>
            <td colspan="2"></td>
            <td style="text-align: center">{{ $total_nilai }}</td>
        </tr>
    </table>

    <table style="margin-top:20px" border="1" align="center" cellpadding="3" cellspacing="0">
        <tr>
            <td>Indeks Prestasi</td>
            <td>{{ $ipk }}</td>
        </tr>
        <tr>
            <td>Beban Kredit (K) Semester Berikutnya</td>
            <td></td>
        </tr>
    </table>

    {{-- Tanda Tangan --}}
    <table style="width: 100%; margin-top: 3%">
        <tr>
            <td>
                <div>Tebing Tinggi, ......................</div>
                <div>Ketua Prodi {{ $data->mhs->program_studies->name }}</div>
                <div style="height: 80px"></div>
                <div style="font-weight: bold;">{{ $ketua_prodi_id->dosen->nama_dosen }}</div>
            </td>
        </tr>
    </table>



</body>

</html>

