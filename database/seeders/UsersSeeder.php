<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'roles_id' => 1,
        ]);

        User::create([
            'username' => 'Dosen',
            'email' => 'dosen@gmail.com',
            'password' => bcrypt('password'),
            'roles_id' => 2,
        ]);

        User::create([
            'username' => 'Mahasiswa',
            'email' => 'mahasiswa@gmail.com',
            'password' => bcrypt('password'),
            'roles_id' => 3,
        ]);
    }
}
