<?php

namespace Database\Seeders;

use App\Models\selectedktms;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ktmSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        selectedktms::create([
            'ktm_selected' => 1,
        ]);
    }
}
