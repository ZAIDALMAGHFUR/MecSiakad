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

    <table style="border-bottom:3px solid;width:100%; border-bottom-style: double; color: #408C67">
        <tr style="width: 100%">
            <td style="width: 10%">
                {{-- <img src="{{ asset('assets/logo.png') }}" alt="makan" width="90"> --}}
                <img src="{{ public_path() . '/assets/logo.png' }}" alt="makan" width="90">
            </td>
            <td style="width: 90%; text-align: center">
                <div style="font-weight: lighter;">YAYASAN PERGURUAN TINGGI ISLAM AL-HIKMAH (YASPETIA)</div>
                <div style="font-weight: bold">SEKOLAH TINGGI ILMU TARBIYAH (STIT)</div>
                <div style="font-weight: bold">AL-HIKMAH TEBING TINGGI</div>
                <div style="font-weight: bold; letter-spacing: 2px;"><span
                        style="background-color: #FEF400">TERAKREDITASI </span></div>
                <div style="font-size: 12px;font-weight: lighter">BAN-PT. Nomor : 4025/SK/BAN-PT/Akred/PT/X/2017</div>
                <div style="font-size: 12px;font-weight: lighter">Prodi : </div>
                <table align="center">
                    <tr>
                        <td>
                            <div style="font-size: 12px;font-weight: lighter">1. S1 Pendidikan Agama Islam (PAI)
                            </div>
                            <div style="font-size: 12px;font-weight: lighter">2. S1 Pendidikan Guru Madrasah Ibtidaiyah
                                (PGMI)</div>
                        </td>
                        <td>
                            <div style="font-size: 12px;font-weight: lighter">3. S1 Pendidikan Islam Anak Usia Dini
                                (PIAUD)</div>
                            <div style="font-size: 12px;font-weight: lighter">4. S1 Pendidikan/Tadris Matematika
                                (TMM)</div>
                        </td>
                    </tr>
                </table>




            </td>
        </tr>
        <tr style="width: 100%">
            <td colspan="2" style="font-size: 12px;font-weight: lighter; text-align: center">
                KAMPUS : Jln. Gatot Subroto Km 3 No. 3 Tebing Tinggi Telp. ( 0621 ) 21428 E-mail :
                <u>stitalhikmah.ttsu@gmail.com<u>
            </td>
        </tr>
    </table>

    <p>Saya yang bertanda tangan di bawah ini:</p>

    {{-- Info --}}
    <table style="width: 100%; margin-top: 3%; font-size: 12px">
        <tr>
            <td style="width: 50%">
                <table>
                    <tr>
                        <td>Nama</td>
                        <td>: {{ $pengajuan[0]['mahasiswa']->name }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>NIM</td>
                        <td>: {{ $pengajuan[0]['mahasiswa']->nim }}</td>
                        <td></td>
                    </tr>
                        <tr>
                            <td>Tahun Akademik</td>
                            <td>: {{ $tahun_akademik->tahun_akademik }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Program Studi</td>
                            <td>: {{ $pengajuan[0]['mahasiswa']->program_studies->name }}</td>
                            <td></td>
                        </tr>
                </table>
            </td>
        </tr>
    </table>

    <p>{{ $pengajuan[0]['deskripsi'] }} :</p>

    <p>JUDUL ACC</p>

    {{-- Judul Skripsi --}}
    <table style="width: 100%; margin-top: 3%; font-size: 12px">
        <tr>
            <td style="width: 50%">
                <table>
                    <tr>
                        <td>Judul Skripsi Acc</td>
                        <td>: {{ $pengajuan[0]['judul_acc'] }}</td>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

        <p>sekian dari saya terimakasih</p>

    {{-- Tanda Tangan --}}
    <table style="width: 100%; margin-top: 3%">
        <tr>
            <td>
                <div>Tebing Tinggi, ......................</div>
                <div>Mahasiswa </div>
                <div style="height: 80px"></div>
                <div style="font-weight: bold;">{{ $pengajuan[0]['mahasiswa']->name }}</div>
            </td>
        </tr>
    </table>



</body>

</html>