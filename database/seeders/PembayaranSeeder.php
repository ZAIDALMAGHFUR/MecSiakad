<?php

namespace Database\Seeders;

use App\Models\Pembayaran;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pembayaran::create([
            'id_pembayaran' => 'PMB-0001',
            'bukti_pembayaran' => 'PMB-0002',
            'status' => '0',
            'verifikasi' => '0',
            'tgl_pembayaran' => '2021-01-01',
            'id_pendaftaran' => '1'
        ]);
    }
}
