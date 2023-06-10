<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DosenMatkul;

class DosenMatkulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DosenMatkul::create([
            'dosen_id' => 1,
            'mata_kuliah_id' => 1,
            'program_studies_id' => 1,
            'tahun_academics_id' => 1,
        ]);
        DosenMatkul::create([
            'dosen_id' => 2,
            'mata_kuliah_id' => 3,
            'program_studies_id' => 1,
            'tahun_academics_id' => 1,
        ]);
    }
}
