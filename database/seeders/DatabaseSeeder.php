<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\DosenSeeder;
use Database\Seeders\RolesSeeder;
use Database\Seeders\UsersSeeder;
use Database\Seeders\JabatanSeeder;
use Database\Seeders\JadwalPmbSeeder;
use Database\Seeders\MahasiswaSeeder;
use Database\Seeders\PendaftarSeeder;
use Database\Seeders\PembayaranSeeder;
use Database\Seeders\DosenJabatanSeeder;
use Database\Seeders\ProgramStuiesSeeder;
use Database\Seeders\TahunAcademicsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            RolesSeeder::class,
            UsersSeeder::class,
            ProgramStuiesSeeder::class,
            TahunAcademicsSeeder::class,
            MahasiswaSeeder::class,
            DosenSeeder::class,
            JabatanSeeder::class,
            DosenJabatanSeeder::class,
            JadwalPmbSeeder::class,
            PendaftarSeeder::class,
            PembayaranSeeder::class,
        ]);
    }
}
