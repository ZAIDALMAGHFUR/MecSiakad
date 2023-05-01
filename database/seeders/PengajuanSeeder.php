<?php

namespace Database\Seeders;

use App\Models\Pengajuan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PengajuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pengajuan::create([
            'mahasiswa_id' => 1,
            'dosen_id' => 1,
            'judul' => 'Pengajuan Judul',
            'judul_1' => 'Pengajuan Judul 1',
            'judul_2' => 'Pengajuan Judul 2',
            'judul_3' => 'Pengajuan Judul 3',
            'deskripsi' => 'Pengajuan Judul',
            'pesan' => 'Pengajuan Judul bagus',
            'status' => 'diterima',
        ]);
    }
}
