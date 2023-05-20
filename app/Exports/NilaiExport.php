<?php

namespace App\Exports;

use App\Models\Nilai;
use Maatwebsite\Excel\Concerns\{WithHeadings, FromQuery, WithColumnWidths};
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;

class NilaiExport implements FromQuery, WithHeadings, WithColumnWidths, WithMapping
{
    use Exportable;

    public function headings(): array
    {
        return [
            'Tahun Academic',
            'Nama Mahasiswa',
            'Mata Kuliah',
            'Tugas',
            'Kuis',
            'Partisipasi Pembelajaran',
            'UTS',
            'UAS',
            'Nilai Akhir',
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
        ];
    }

    public function map($nilai): array
    {
        return [
            $nilai->mahasiswa->TahunAcademic->tahun_akademik, // Ambil nama tahun academic melalui relasi
            $nilai->Mahasiswa->name, // Ambil nama mahasiswa melalui relasi
            $nilai->mataKuliah->name_mata_kuliah, // Ambil nama mata kuliah melalui relasi
            $nilai->tugas,
            $nilai->kuis,
            $nilai->partisipasi_pembelajaran,
            $nilai->uts,
            $nilai->uas,
            $nilai->nilai_akhir,
        ];
    }

    public function query()
    {
        return Nilai::query()->with(['mahasiswa.tahunAcademic', 'mataKuliah']);
    }
}
