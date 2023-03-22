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
    }
}
