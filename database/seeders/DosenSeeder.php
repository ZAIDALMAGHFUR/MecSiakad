<?php

namespace Database\Seeders;

use App\Models\Dosen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Dosen::create([
            'nama_dosen' => 'dosen',
            'nidn' => '123456789',
            'email' => 'dsn@gmail.com',
            'no_hp' => '08123456789',
            'alamat' => 'Jl. Jalan',
            'status' => 'Aktif',
            'users_id' => 2,
            'program_studies_id' => 1,
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '2000-01-01',
            'jenis_kelamin' => 'Laki-laki',
            'pendidikan_terakhir' => 'S3',
            'photo' => 'photo',
            'agama' => 'Islam',
        ]);
    }
}
