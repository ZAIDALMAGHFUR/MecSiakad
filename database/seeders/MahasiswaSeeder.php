<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        {
            Mahasiswa::create([
                'name' => 'saipol',
                'nim' => '123456789',
                'email' => 'mhs@gmail.com',
                'user_id' => 3,
                'no_hp' => '08123456789',
                'alamat' => 'Jl. Jalan',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '1999-01-01',
                'jenis_kelamin' => 'laki-laki',
                'program_studies_id' => 1,
                'foto' => 'photo',
                'status' => 'aktif',
                'agama' => 'islam',
                'tahun_masuk' => '2019',
                'nama_ayah' => 'Bapak',
                'nama_ibu' => 'Ibu',
                'pekerjaan_ayah' => 'PNS',
                'pekerjaan_ibu' => 'Ibu Rumah Tangga',
                'no_hp_ortu' => '08123456789',
                'alamat_ortu' => 'Jl. Jalan',
                'asal_sekolah' => 'SMA',
                'tahun_academics_id' => 1,
            ]);
        }
    }
}
