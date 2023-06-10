<?php

namespace App\Exports;

use App\Models\Nilai;
use Maatwebsite\Excel\Concerns\{WithHeadings, FromQuery, WithColumnWidths, WithStyles};
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class NilaiExport implements FromQuery, WithHeadings, WithColumnWidths, WithMapping, WithStyles
{
    use Exportable;

    public function __construct(int $ta, int $ps)
    {
        $this->ta = $ta;
        $this->ps = $ps;
    }

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
            'A' => 35,
            'B' => 35,
            'C' => 35,
            'D' => 35,
            'E' => 35,
            'F' => 35,
            'G' => 35,
            'H' => 35,
            'I' => 35,
        ];
    }
    
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
            '2:50' => ['alignment' => ['horizontal' => 'left']],
        ];
    }

    public function map($nilai): array
    {
        //dd($nilai);
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
        $nilai = Nilai::query();
            $id_mhs = [];
            $datas = $nilai->with('mahasiswa.program_studies', 'mataKuliah')->get();
            if ($this->ta != 0 && $this->ps != 0) {
                foreach ($datas as $data) {
                    $data->mahasiswa->program_studies->id == $this->ps ? $id_mhs[] = $data->mahasiswa->id : '';
                }
                $nilai->where('tahun_academic_id', $this->ta)
                    ->whereIn('mahasiswas_id', $id_mhs);
            } elseif ($this->ta != 0) {
                $nilai->where('tahun_academic_id', $this->ta);
            } elseif ($this->ps != 0) {
                foreach ($datas as $data) {
                    $data->mahasiswa->program_studies->id == $this->ps ? $id_mhs[] = $data->mahasiswa->id : '';
                }
                $nilai->whereIn('mahasiswas_id', $id_mhs);
            }

         return $nilai;
    }
    
}