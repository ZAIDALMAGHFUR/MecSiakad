<?php

namespace Database\Seeders;

use App\Models\Pengumuman;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PengugumanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pengumuman::create([
            'id_pengumuman' => 'ANN230003',
            'id_pendaftaran' => '1',
            'users_id' => '4',
            'hasil_seleksi' => 'Lulus',
            'prodi_penerima' => '1',
            'nilai_interview' => '90',
            'nilai_test' => '90',
            // 'status' => '0',
        ]);
    }
}
