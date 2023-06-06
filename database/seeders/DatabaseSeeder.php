<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Page;
use App\Models\Berita;
use App\Models\Jurnal;
use App\Models\Gallery;
use Illuminate\Database\Seeder;
use Database\Seeders\ktmSeeders;
use Database\Seeders\DosenSeeder;
use Database\Seeders\RolesSeeder;
use Database\Seeders\UsersSeeder;
use Illuminate\Support\Facades\DB;
use Database\Seeders\JabatanSeeder;
use Database\Seeders\JadwalPmbSeeder;
use Database\Seeders\MahasiswaSeeder;
use Database\Seeders\PendaftarSeeder;
use Database\Seeders\PengajuanSeeder;
use Database\Seeders\MataKuliahSeeder;
use Database\Seeders\PembayaranSeeder;
use Database\Seeders\PengugumanSeeder;
use Illuminate\Support\Facades\Schema;
use Database\Seeders\DosenJabatanSeeder;
use Database\Seeders\PersyaratansSeeder;
use Database\Seeders\RentangNilaiSeeder;
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
            MataKuliahSeeder::class,
            DosenSeeder::class,
            JabatanSeeder::class,
            DosenJabatanSeeder::class,
            JadwalPmbSeeder::class,
            //PendaftarSeeder::class,
            //PembayaranSeeder::class,
            //PengugumanSeeder::class,
            PersyaratansSeeder::class,
            PengajuanSeeder::class,
            RentangNilaiSeeder::class,
            ktmSeeders::class,
        ]);

        foreach (['jurnals', 'pages', 'galleries', 'beritas'] as $table) {
            Schema::disableForeignKeyConstraints();
            DB::table($table)->truncate();
            Schema::enableForeignKeyConstraints();
        }


        Jurnal::factory(40)->create();
        Page::factory(5)->create();
        Gallery::factory(40)->create();
        Berita::factory(40)->create();
    }
}
