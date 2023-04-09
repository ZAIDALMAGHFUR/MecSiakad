<?php

namespace Database\Seeders;

use App\Models\Mata_Kuliah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MataKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Pemrograman Web',
            'kode_mata_kuliah' => 'TI001',
            'sks' => 4,
            'semester' => 1,
            'program_studies_id' => 1,
        ]);

        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Pemrograman Mobile',
            'kode_mata_kuliah' => 'TI002',
            'sks' => 4,
            'semester' => 1,
            'program_studies_id' => 1,
        ]);
    }
}
