<?php

namespace App\Exports;

use App\Models\Pengumuman;
use Maatwebsite\Excel\Concerns\{WithHeadings, FromQuery, WithColumnWidths, WithStyles};
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromQuery, WithHeadings, WithColumnWidths, WithStyles, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
        return [
            'name',
            'nim',
            'email',
            'no_hp',
            'alamat',
            'program_studies_id',
            'tempat_lahir',
            'tanggal_lahir',
            'jenis_kelamin',
            'agama',
            'status',
            'user_id',
            'foto',
            'tahun_masuk',
            'nama_ayah',
            'nama_ibu',
            'pekerjaan_ayah',
            'pekerjaan_ibu',
            'no_hp_ortu',
            'alamat_ortu',
            'asal_sekolah',
            'tahun_academics_id',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 20,
            'C' => 20,
            'D' => 20,
            'E' => 20,
            'F' => 20,
            'G' => 20,
            'H' => 20,
            'I' => 20,
            'J' => 20,
            'K' => 20,
            'L' => 20,
            'M' => 20,
            'N' => 20,
            'O' => 20,
            'P' => 20,
            'Q' => 20,
            'R' => 20,
            'S' => 20,
            'T' => 20,
            'U' => 20,
            'V' => 20,
            'W' => 20,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
            '2:50' => ['alignment' => ['horizontal' => 'left']],
        ];
    }

    public function map($pengumuman): array
    {
        return [
            $pengumuman->user->username,
            $pengumuman->user->nim,
            $pengumuman->user->email,
            $pengumuman->pendaftaran->no_hp,
            $pengumuman->pendaftaran->alamat,
            $pengumuman->prodi_penerima,
            $pengumuman->pendaftaran->tempat_lahir,
            $pengumuman->pendaftaran->tanggal_lahir,
            $pengumuman->pendaftaran->jenis_kelamin,
            $pengumuman->pendaftaran->agama,
            $pengumuman->user->status,
            $pengumuman->user->user_id,
            $pengumuman->user->foto,
            $pengumuman->user->tahun_masuk,
            $pengumuman->pendaftaran->nama_ayah,
            $pengumuman->pendaftaran->nama_ibu,
            $pengumuman->pendaftaran->pekerjaan_ayah,
            $pengumuman->pendaftaran->pekerjaan_ibu,
            $pengumuman->pendaftaran->nohp_ayah,
            $pengumuman->pendaftaran->alamat,
            $pengumuman->pendaftaran->asal_sekolah,
        ];
    }

    public function query()
    {
        return Pengumuman::query()->with('user');
    }
}
