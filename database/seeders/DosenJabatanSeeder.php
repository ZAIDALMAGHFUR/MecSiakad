<?php

namespace Database\Seeders;

use App\Models\DosenJabatan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DosenJabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DosenJabatan::create([
            'dosen_id' => '1',
            'jabatan_id' => 1,
            'program_studies_id' => '1',
            'tahun_academics_id' => '1',
        ]);
        DosenJabatan::create([
            'dosen_id' => '2',
            'jabatan_id' => 2,
            'program_studies_id' => '1',
            'tahun_academics_id' => '1',
        ]);
    }
}
