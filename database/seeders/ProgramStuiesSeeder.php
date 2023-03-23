<?php

namespace Database\Seeders;

use App\Models\Program_studies;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramStuiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Program_studies::create([
            'name' => 'Teknik Informatika',
            'jenjang' => 'S1',
            'kode_prodi' => 'TI',
        ]);

        Program_studies::create([
            'name' => 'Sistem Informasi',
            'jenjang' => 'S1',
            'kode_prodi' => 'SI',
        ]);

        Program_studies::create([
            'name' => 'Teknik Komputer',
            'jenjang' => 'S1',
            'kode_prodi' => 'TK',
        ]);

        Program_studies::create([
            'name' => 'Teknik Elektro',
            'jenjang' => 'S1',
            'kode_prodi' => 'TE',
        ]);

        Program_studies::create([
            'name' => 'Biologi',
            'jenjang' => 'S1',
            'kode_prodi' => 'BIG',
        ]);

        Program_studies::create([
            'name' => 'Fisika',
            'jenjang' => 'S1',
            'kode_prodi' => 'FIS',
        ]);

        Program_studies::create([
            'name' => 'Kimia',
            'jenjang' => 'S1',
            'kode_prodi' => 'KIM',
        ]);

        Program_studies::create([
            'name' => 'Matematika',
            'jenjang' => 'S1',
            'kode_prodi' => 'MAT',
        ]);

        Program_studies::create([
            'name' => 'Teknik Industri',
            'jenjang' => 'S1',
            'kode_prodi' => 'TI',
        ]);

        Program_studies::create([
            'name' => 'Pendidikan Bahasa Inggris',
            'jenjang' => 'S1',
            'kode_prodi' => 'PBI',
        ]);

        Program_studies::create([
            'name' => 'Pendidikan Bahasa Jepang',
            'jenjang' => 'S1',
            'kode_prodi' => 'PBJ',
        ]);

        Program_studies::create([
            'name' => 'Pendidikan Bahasa Mandarin',
            'jenjang' => 'S1',
            'kode_prodi' => 'PBM',
        ]);

        Program_studies::create([
            'name' => 'Pendidikan Bahasa Arab',
            'jenjang' => 'S1',
            'kode_prodi' => 'PBA',
        ]);
    }
}
