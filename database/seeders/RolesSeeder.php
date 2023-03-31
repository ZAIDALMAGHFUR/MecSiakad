<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        {
            Role::create([
                'name' => 'admin',
            ]);
            Role::create([
                'name' => 'dosen',
            ]);
            Role::create([
                'name' => 'mahasiswa',
            ]);
            Role::create([
                'name' => 'calon',
            ]);
        }
    }
}
