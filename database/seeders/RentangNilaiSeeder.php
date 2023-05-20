<?php

namespace Database\Seeders;

use App\Models\BobotNilai;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RentangNilaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BobotNilai::create([
            'nama_rentang_nilai' => '90',
            'rentang_nilai' => '100',
            'huruf_nilai' => 'A',
            'bobot_nilai' => '4',
        ]);

        BobotNilai::create([
            'nama_rentang_nilai' => '80',
            'rentang_nilai' => '90',
            'huruf_nilai' => 'B',
            'bobot_nilai' => '3',
        ]);

        BobotNilai::create([
            'nama_rentang_nilai' => '70',
            'rentang_nilai' => '80',
            'huruf_nilai' => 'C',
            'bobot_nilai' => '2',
        ]);

        BobotNilai::create([
            'nama_rentang_nilai' => '60',
            'rentang_nilai' => '70',
            'huruf_nilai' => 'D',
            'bobot_nilai' => '1',
        ]);

        BobotNilai::create([
            'nama_rentang_nilai' => '0',
            'rentang_nilai' => '60',
            'huruf_nilai' => 'E',
            'bobot_nilai' => '0',
        ]);
    }
}
