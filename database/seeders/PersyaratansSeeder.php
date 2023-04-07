<?php

namespace Database\Seeders;

use App\Models\Persyaratans;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PersyaratansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Persyaratans::create([
            'jalur_prestasi' => '
            1. Fotocopy Ijazah SMA/SMK/MA
            2. Fotocopy SKHUN
            3. Fotocopy KTP Orang Tua
            4. Fotocopy Kartu Keluarga
            5. Fotocopy Akte Kelahiran
            6. Fotocopy Surat Keterangan Sehat dari Dokter
            7. Fotocopy Surat Keterangan Lulus dari Sekolah',
            'jalur_beasiswa' => '1. Fotocopy Ijazah SMA/SMK/MA',
            'jalur_pindahan' => '1. Fotocopy Ijazah SMA/SMK/MA',
            'jalur_reguler' => '1. Fotocopy Ijazah SMA/SMK/MA',
        ]);
    }
}
