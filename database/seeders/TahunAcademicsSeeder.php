<?php

namespace Database\Seeders;

use App\Models\TahunAcademic;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TahunAcademicsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TahunAcademic::create([
            'tahun_akademik' => '2020/2021',
            'semester' => 'Ganjil',
            'status' => 'aktif',
        ]);

        TahunAcademic::create([
            'tahun_akademik' => '2021/2022',
            'semester' => 'Genap',
            'status' => 'tidak aktif',
        ]);
    }
}
