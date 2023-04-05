<?php

namespace Database\Seeders;

use App\Models\jadwal_pmbs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JadwalPmbSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        jadwal_pmbs::create([
            'nama_kegiatan' => 'Gelombang 1 | Reguler',
            'jenis_kegiatan' => 'Pendaftaran',
            'tgl_mulai' => '2023-04-05',
            'tgl_akhir' => '2023-04-07',
        ]);
    }
}
