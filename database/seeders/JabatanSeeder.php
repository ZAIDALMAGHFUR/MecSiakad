<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Jabatan::create([
            'nama_jabatan' => 'Ketua Prodi',
            'kode_jabatan' => 'KP',
        ]);
        Jabatan::create([
            'nama_jabatan' => 'Dosen Tidak Tetap',
            'kode_jabatan' => 'DTT',
        ]);

        DB::table('str_jabatans')->insert([
            [
                'name' => 'Yayasan Fadira Alam Mandiri',
                'child_of' => 0,
                'hierarki' => 1,
            ],
            [
                'name' => 'Badan Pembina Harian (BPH)',
                'child_of' => 1,
                'hierarki' => 2,
            ],
            [
                'name' => 'Direktur',
                'child_of' => 1,
                'hierarki' => 2,
            ],
            [
                'name' => 'Unit Penjaminan Mutu (UPM)',
                'child_of' => 1,
                'hierarki' => 2,
            ],
            [
                'name' => 'Unit Penelitian Pengabdian Kepada Masyarakat (UPPM)',
                'child_of' => 1,
                'hierarki' => 2,
            ],
            [
                'name' => 'Wakil Direktur I',
                'child_of' => 3,
                'hierarki' => 3,
            ],
            [
                'name' => 'Wakil Direktur II',
                'child_of' => 3,
                'hierarki' => 3,
            ],
            [
                'name' => 'Wakil Direktur III',
                'child_of' => 3,
                'hierarki' => 3,
            ],
            [
                'name' => 'Kepala Biro Akademik',
                'child_of' => 6,
                'hierarki' => 4,
            ],
            [
                'name' => 'Ketua Program Studi Manajemen Industri',
                'child_of' => 6,
                'hierarki' => 4,
            ],
            [
                'name' => 'Ketua Program Studi Teknik Kimia',
                'child_of' => 6,
                'hierarki' => 4,
            ],
            [
                'name' => 'Kepala Biro Administrasi Umum & Keuangan',
                'child_of' => 7,
                'hierarki' => 4,
            ],
            [
                'name' => 'kepala Biro Kerjasama & Kemahasiswaan',
                'child_of' => 8,
                'hierarki' => 4,
            ],
            [
                'name' => 'Sekretaris Prodi Manajemen Industri',
                'child_of' => 10,
                'hierarki' => 5,
            ],
            [
                'name' => 'Sekretaris Prodi Teknik Kimia',
                'child_of' => 11,
                'hierarki' => 5,
            ],
            [
                'name' => 'LAB Manajemen Industri',
                'child_of' => 14,
                'hierarki' => 6,
            ],
            [
                'name' => 'LAB Teknik Kimia',
                'child_of' => 15,
                'hierarki' => 6,
            ],
        ]);

        DB::table('struktur_kepemimpinans')->insert([
            [
                'name' => 'Ir. M. jairi Tavip',
                'pas_foto' => 'pas_fotos/stock.jpg',
                'description' => '',
                'jabatan_id' => 2,
            ],
            [
                'name' => 'Prof. Dr. Ir Ilmi, M.Sc',
                'pas_foto' => 'pas_fotos/stock.jpg',
                'description' => '',
                'jabatan_id' => 2,
            ],
            [
                'name' => 'Zainal, S.E, M.M',
                'pas_foto' => 'pas_fotos/stock.jpg',
                'description' => '',
                'jabatan_id' => 3,
            ],
            [
                'name' => 'Marnida Yusfiani, S.Pd, M.Pd',
                'pas_foto' => 'pas_fotos/stock.jpg',
                'description' => '',
                'jabatan_id' => 4,
            ],
            [
                'name' => 'Dr. Indra Utama, S.E, M.Si',
                'pas_foto' => 'pas_fotos/stock.jpg',
                'description' => '',
                'jabatan_id' => 5,
            ],
            [
                'name' => 'Suherman, S.T, M.T',
                'pas_foto' => 'pas_fotos/stock.jpg',
                'description' => '',
                'jabatan_id' => 6,
            ],
            [
                'name' => 'Romylie Dian Prasetyo, S.E, M.Pd',
                'pas_foto' => 'pas_fotos/stock.jpg',
                'description' => '',
                'jabatan_id' => 7,
            ],
            [
                'name' => 'Rismaja Putra, SS, MM',
                'pas_foto' => 'pas_fotos/stock.jpg',
                'description' => '',
                'jabatan_id' => 8,
            ],
            [
                'name' => 'Fauzan Azim, SE, MM',
                'pas_foto' => 'pas_fotos/stock.jpg',
                'description' => '',
                'jabatan_id' => 10,
            ],
            [
                'name' => 'Ir. Ramayana, M.Si',
                'pas_foto' => 'pas_fotos/stock.jpg',
                'description' => '',
                'jabatan_id' => 11,
            ],
            [
                'name' => 'Erinsyah Maulia R, S.T, M.T',
                'pas_foto' => 'pas_fotos/stock.jpg',
                'description' => '',
                'jabatan_id' => 14,
            ],
            [
                'name' => 'Eva Fadillah, ST, M.Pd',
                'pas_foto' => 'pas_fotos/stock.jpg',
                'description' => '',
                'jabatan_id' => 15,
            ],
        ]);
    }
}
